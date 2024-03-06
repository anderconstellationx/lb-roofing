## PDF

https://github.com/barryvdh/laravel-dompdf

## Manejo de archivos excel

https://docs.laravel-excel.com/3.1/getting-started/installation.html

## Mantener actualizado

composer dumpautoload


## Comando para generar modelo

php artisan code:models --table=users


## CADA ACTUALIZACION EJECUTAR

php artisan cache:clear

php artisan config:clear


## GALERIA

- Aumentar post_max_size
- Aumentar upload_max_filesize

### Crear carpeta 

mkdir -p storage/app/gallery
mkdir -p storage/app/gallery_report

chmod -R 775 storage/app/gallery
chmod -R 775 storage/app/gallery_report

php artisan storage:link


## Manejo de archivos
https://kennyhorna.com/blog/file-storage-como-manejar-archivos-y-discos-en-laravel-0a85ea73-288d-4667-99f8-0f3d97c51a8d

## Remove XSS

https://github.com/stevebauman/purify?tab=readme-ov-file#usage

## Variables globales en view

https://laravel.com/docs/10.x/views#sharing-data-with-all-views

## Condicionar vistas

https://laravel.com/docs/10.x/blade#including-subviews


## Casos

cuando reinicio la libreria de galeria se "duplicaba" los eventos

https://stackoverflow.com/questions/652495/jquery-multiple-event-handlers-how-to-cancel
