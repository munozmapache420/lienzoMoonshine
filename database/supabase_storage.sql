-- Ejecutar UNA vez en Supabase > SQL Editor
-- 1) Bucket público para las imágenes de productos
insert into storage.buckets (id, name, public)
values ('productos', 'productos', true)
on conflict (id) do update set public = true;

-- 2) Permisos para la clave anon, limitados SOLO al bucket "productos"
drop policy if exists "productos_select" on storage.objects;
drop policy if exists "productos_insert" on storage.objects;
drop policy if exists "productos_update" on storage.objects;
drop policy if exists "productos_delete" on storage.objects;

create policy "productos_select" on storage.objects for select to anon
  using (bucket_id = 'productos');
create policy "productos_insert" on storage.objects for insert to anon
  with check (bucket_id = 'productos');
create policy "productos_update" on storage.objects for update to anon
  using (bucket_id = 'productos') with check (bucket_id = 'productos');
create policy "productos_delete" on storage.objects for delete to anon
  using (bucket_id = 'productos');
