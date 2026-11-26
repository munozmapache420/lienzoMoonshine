inputImagen.addEventListener("change", function () {
  limpiarVistaPrevia();
  const archivo = inputImagen.files[0];
  if (!archivo) return;
  vistaPreviaUrl = URL.createObjectURL(archivo);
  previewImagen.src = vistaPreviaUrl;
  previewImagen.hidden = false;
});
  const archivo = inputImagen.files[0];
  if (!archivo) {
    mostrarError(inputImagen, "errImagen", "Seleccione una imagen del producto.");
    valido = false;
  } else if (TIPOS_IMAGEN.indexOf(archivo.type) === -1) {
    mostrarError(inputImagen, "errImagen", "La imagen debe ser JPG, PNG, WEBP o GIF.");
    valido = false;
  } else if (archivo.size > MAX_IMAGEN) {
    mostrarError(inputImagen, "errImagen", "La imagen no puede superar 5 MB.");
    valido = false;
  } else {
    mostrarError(inputImagen, "errImagen", "");
  }

  return valido;