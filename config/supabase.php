<?php
/**
 * Cliente de Supabase Storage para Moonshine.
 * Usa la API REST de Storage mediante cURL.
 * La clave administrativa permanece únicamente en el servidor (.env).
 */
class SupabaseStorage
{
    private $url;
    private $key;
    private $bucket;
    private $verificarSsl = true;

    public function __construct()
    {
        $env = self::leerEnv(dirname(__DIR__) . '/.env');

        // URL del proyecto (NO es el endpoint S3).
        $this->url = rtrim($env['SUPABASE_URL'] ?? '', '/');

        // Clave del proyecto (JWT): anon (con políticas de Storage) o service_role.
        $this->key = trim($env['SUPABASE_KEY'] ?? ($env['SUPABASE_SERVICE_KEY'] ?? ''));

        // Solo el nombre del bucket, no una URL.
        $this->bucket = trim($env['SUPABASE_BUCKET'] ?? 'productos');

        // Verificación del certificado SSL. Déjala en true; ver nota en .env.
        $this->verificarSsl = strtolower(trim($env['SUPABASE_SSL_VERIFY'] ?? 'true')) !== 'false';

        if ($this->url === '' || $this->key === '') {
            throw new Exception('Faltan SUPABASE_URL o SUPABASE_KEY en .env.');
        }

        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            throw new Exception('SUPABASE_URL no es una URL válida.');
        }

        if (!function_exists('curl_init')) {
            throw new Exception('La extensión cURL de PHP no está habilitada.');
        }

        // Evita enviar por error una credencial S3 (UUID / access key) en lugar del JWT.
        $partes = explode('.', $this->key);
        if (count($partes) !== 3) {
            throw new Exception(
                'SUPABASE_KEY no tiene formato JWT (debe empezar por eyJ...). Usa la clave anon o service_role de Project Settings > API Keys, no una credencial S3.'
            );
        }

        $payload = json_decode(self::base64UrlDecode($partes[1]), true);
        $rol = is_array($payload) ? ($payload['role'] ?? '') : '';
        if ($rol !== 'anon' && $rol !== 'service_role') {
            throw new Exception('La clave configurada no es una clave válida de Supabase (anon o service_role).');
        }
    }

    private static function leerEnv($ruta)
    {
        $datos = [];

        if (!is_readable($ruta)) {
            return $datos;
        }

        foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
            $linea = trim($linea);

            if ($linea === '' || $linea[0] === '#' || strpos($linea, '=') === false) {
                continue;
            }

            list($k, $v) = explode('=', $linea, 2);
            $datos[trim($k)] = trim($v, " \t\"'");
        }

        return $datos;
    }

    private static function base64UrlDecode($valor)
    {
        $valor = strtr($valor, '-_', '+/');
        $relleno = strlen($valor) % 4;
        if ($relleno) {
            $valor .= str_repeat('=', 4 - $relleno);
        }
        return base64_decode($valor);
    }

    // Codifica cada parte de la ruta, conservando las barras de las carpetas.
    private function codificarRuta($ruta)
    {
        $partes = explode('/', str_replace('\\', '/', $ruta));
        $partes = array_filter($partes, function ($parte) {
            return $parte !== '' && $parte !== '.' && $parte !== '..';
        });

        if (empty($partes)) {
            throw new Exception('La ruta del archivo no es válida.');
        }

        return implode('/', array_map('rawurlencode', $partes));
    }

    private function peticion($url, $metodo, $headers, $contenido = null)
    {
        $ch = curl_init($url);

        $opciones = [
            CURLOPT_CUSTOMREQUEST  => $metodo,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_HTTPHEADER     => $headers,
        ];

        if ($contenido !== null) {
            $opciones[CURLOPT_POSTFIELDS] = $contenido;
        }

        if ($this->verificarSsl) {
            $opciones[CURLOPT_SSL_VERIFYPEER] = true;
            $opciones[CURLOPT_SSL_VERIFYHOST] = 2;

            // Certificados raíz incluidos en el proyecto (XAMPP a veces no trae ninguno).
            $cacert = __DIR__ . '/cacert.pem';
            if (is_readable($cacert)) {
                $opciones[CURLOPT_CAINFO] = $cacert;
            }
            // En Windows también se usa el almacén del sistema (incluye el certificado
            // de antivirus/proxy que intercepta HTTPS). 16 = CURLSSLOPT_NATIVE_CA.
            if (PHP_OS_FAMILY === 'Windows') {
                $opciones[CURLOPT_SSL_OPTIONS] = 16;
            }
        } else {
            $opciones[CURLOPT_SSL_VERIFYPEER] = false;
            $opciones[CURLOPT_SSL_VERIFYHOST] = 0;
        }

        curl_setopt_array($ch, $opciones);

        $respuesta = curl_exec($ch);
        $numError = curl_errno($ch);
        $codigo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $errorCurl = curl_error($ch);
        curl_close($ch);

        if ($respuesta === false) {
            if ($numError === 60 || $numError === 77 || $numError === 35) {
                throw new Exception('Error de certificado SSL (' . $errorCurl . '). Un antivirus o proxy está interceptando HTTPS. En el .env pon SUPABASE_SSL_VERIFY=false (solo para desarrollo local).');
            }
            throw new Exception('No se pudo conectar con Supabase: ' . $errorCurl);
        }

        if ($codigo < 200 || $codigo >= 300) {
            if (stripos($respuesta, 'row-level security') !== false || $codigo === 403) {
                throw new Exception('Supabase negó el permiso (' . $codigo . '). Ejecuta database/supabase_storage.sql en el SQL Editor de Supabase para habilitar el bucket.');
            }
            if (stripos($respuesta, 'Bucket not found') !== false) {
                throw new Exception('El bucket "' . $this->bucket . '" no existe en Supabase. Ejecuta database/supabase_storage.sql.');
            }
            throw new Exception('Supabase respondió ' . $codigo . ': ' . $respuesta);
        }

        return $respuesta;
    }

    private function encabezados($mime = null)
    {
        $headers = [
            'apikey: ' . $this->key,
            'Authorization: Bearer ' . $this->key,
        ];

        if ($mime !== null) {
            $headers[] = 'Content-Type: ' . $mime;
        }

        return $headers;
    }

    /**
     * Sube un archivo local al bucket y devuelve su URL pública.
     * El bucket "productos" debe estar configurado como público para usar esta URL.
     */
    public function subir($rutaLocal, $nombreObjeto, $mime)
    {
        if (!is_file($rutaLocal) || !is_readable($rutaLocal)) {
            throw new Exception('No se encuentra o no se puede leer el archivo de imagen.');
        }

        $permitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($mime, $permitidos, true)) {
            throw new Exception('Tipo de imagen no permitido.');
        }

        $contenido = file_get_contents($rutaLocal);
        if ($contenido === false) {
            throw new Exception('No se pudo leer el contenido de la imagen.');
        }

        $ruta = $this->codificarRuta($nombreObjeto);
        $endpoint = $this->url . '/storage/v1/object/' .
            rawurlencode($this->bucket) . '/' . $ruta;

        $this->peticion(
            $endpoint,
            'POST',
            $this->encabezados($mime),
            $contenido
        );

        return $this->url . '/storage/v1/object/public/' .
            rawurlencode($this->bucket) . '/' . $ruta;
    }

    /**
     * Elimina una imagen solamente si pertenece al bucket configurado.
     */
    public function borrarPorUrl($urlPublica)
    {
        $prefijo = $this->url . '/storage/v1/object/public/' .
            rawurlencode($this->bucket) . '/';

        if (!$urlPublica || strpos($urlPublica, $prefijo) !== 0) {
            return false;
        }

        $rutaOriginal = substr($urlPublica, strlen($prefijo));
        $ruta = $this->codificarRuta(rawurldecode($rutaOriginal));

        $endpoint = $this->url . '/storage/v1/object/' .
            rawurlencode($this->bucket) . '/' . $ruta;

        // Borrar la imagen anterior es opcional: si falla no debe romper la subida.
        try {
            $this->peticion($endpoint, 'DELETE', $this->encabezados());
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
