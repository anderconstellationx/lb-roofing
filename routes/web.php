<?php

use App\Livewire\AgregarCotizacion;
use App\Livewire\FacturaDone;
use App\Livewire\FormsNuevaFactura;
use App\Livewire\FormsNuevaGaleria;
use App\Livewire\FormsNuevoProducto;
use App\Livewire\KanbanBoard;
use App\Livewire\Project\Gallery\Report;
use App\Livewire\SubirFotoGaleria;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'dashboard');

Route::view('dashboard', 'new-template.pages.escritorio')
    ->middleware(['auth', 'verified', 'allow_view_admin'])
    ->name('dashboard');

// View de usuarios
Route::view('sellers', 'new-template.pages.users.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('sellers');
Route::view('accountants', 'new-template.pages.users.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('accountants');
Route::view('administrators', 'new-template.pages.users.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('administrators');
Route::view('clients', 'new-template.pages.users.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('clients');

// View de productos
Route::view('products', 'new-template.pages.producto.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('products');

// Proveedores
Route::view('providers', 'new-template.pages.proveedor.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('providers');

// upload file excel product
Route::post('products/upload/file/', [FormsNuevoProducto::class, 'uploadFile'])->middleware(['auth', 'verified','allow_view_admin'])->name('products-upload-file');

// View de Proyectos
//Route::view('projects', 'new-template.pages.proyecto.index')->middleware(['auth', 'verified'])->name('projects');

// View de Proyectos
Route::view('view-project/{id}', 'new-template.pages.proyecto.index-detalle-proyecto')->middleware(['auth', 'verified'])->name('view-project');

// View all projects
Route::view('all-projects', 'new-template.pages.proyecto.index-all-proyecto')->middleware(['auth', 'verified'])->name('projects');

// view proyectos con cotizacion
Route::view('view-project/{id}/quote/{quote_id}', 'new-template.pages.proyecto.index-detalle-proyecto-cotizacion')->middleware(['auth', 'verified'])->name('view-project-quote');

// View de view-project-facture
Route::view('view-project/{id}/invoice/{invoice_id}', 'new-template.pages.proyecto.index-detalle-proyecto-factura')->middleware(['auth', 'verified'])->name('view-project-invoice');

// upload file to gallery
Route::post('view-project/upload/file/gallery', [SubirFotoGaleria::class, 'uploadFile'])->middleware(['auth', 'verified'])->name('view-project-upload-file-gallery');

// retrieve comment for
Route::get('view-project/gallery/retrieve-comment', [FormsNuevaGaleria::class, 'loadComment'])->name('view-project-gallery-retrieve-comment');
Route::post('view-project/gallery/save-comment', [FormsNuevaGaleria::class, 'saveComment'])->middleware(['auth', 'verified'])->name('view-project-gallery-save-comment');

// save quote-template in project
Route::post('save-quote-template-in-project/{project_id}', [AgregarCotizacion::class, 'saveQuoteTemplateInProject'])->middleware(['auth', 'verified'])->name('save-quote-template-in-project');

// show gallery
Route::get('/galleries/{id}', [FormsNuevaGaleria::class, 'showGallery'])->name('show-gallery');
Route::get('/galleries/items/{id}', [FormsNuevaGaleria::class, 'showGalleryItems'])->name('show-gallery-items');
Route::post('/save-edit-image-gallery', [FormsNuevaGaleria::class, 'updateImageGallery'])->name('save-edit-image-gallery');

// report Gallery
Route::view('report/gallery', 'new-template.pages.gallery.report')->middleware(['auth', 'verified', 'allow_view_admin'])->name('show-report-gallery');
Route::get('report/gallery/{uuid}', [Report::class, 'showReport'])->name('show-report-gallery-item');

// show quote
Route::get('/quote/{uuid}', [AgregarCotizacion::class, 'showQuote'])->name('show-quote');
Route::get('/quote/{uuid}/sent/{sent_uuid}', [AgregarCotizacion::class, 'showQuote'])->name('show-quote-client');
Route::post('/quote/{uuid}/sent/{sent_uuid}', [AgregarCotizacion::class, 'saveResponseClient'])->name('save-response-quote-client');

// quote template
Route::view('quote-template/{quote_template_id}', 'livewire.project.quoting-template')->middleware(['auth', 'verified'])->name('quote-template');
Route::view('quote-template-list', 'livewire.project.quoting-template-list')->middleware(['auth', 'verified', 'allow_view_admin'])->name('quote-template-list');

// template message
Route::view('template-message', 'livewire.project.quoting-template-message-list')->middleware(['auth', 'verified', 'allow_view_admin'])->name('template-message');
Route::view('template-message-view/{id}', 'livewire.project.quoting-template-message')->middleware(['auth', 'verified'])->name('template-message-view');


// all quotes
Route::view('all-quotes', 'new-template.pages.cotizacion.index')->middleware(['auth', 'verified'])->name('all-quotes');

// show invoice
Route::view('all-invoices','new-template.pages.factura.index')->middleware(['auth', 'verified'])->name('all-invoices');
Route::get('/invoice/{uuid}', [FacturaDone::class, 'showInvoice'])->name('show-invoice');

Route::view('reports', 'new-template.pages.report.index')->middleware(['auth', 'verified', 'allow_view_admin'])->name('reports');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
