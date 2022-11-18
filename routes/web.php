<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resources([
    'products' => ProductController::class,
    'services' => ServiceController::class,
]);
Route::get('/', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/card/{id}', [CatalogController::class, 'card'])->name('catalog.card');
Route::get('/add-service/{id}', [CatalogController::class, 'addService'])->name('catalog.add-service');
Route::get('/remove-service/{id}', [CatalogController::class, 'removeService'])->name('catalog.remove-service');
Route::get('/admin', [PanelController::class, 'index'])->name('admin');
Route::get('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
Route::get('admin/services', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.services.index');
//Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
//Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
//Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
//Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');

//Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

//Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.delete');
//Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.delete');

//Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
//Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
