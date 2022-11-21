<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Admin\PanelController;

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
Route::get('/', [CatalogController::class, 'index']);
Route::get('/card/{id}', [CatalogController::class, 'card'])->name('catalog.card');
Route::get('/add-service/{id}', [CatalogController::class, 'addService'])->name('catalog.add-service');
Route::get('/remove-service/{id}', [CatalogController::class, 'removeService'])->name('catalog.remove-service');
Route::get('/admin', [PanelController::class, 'index'])->name('admin')->middleware('auth');
Route::get('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index')->middleware('auth');
Route::get('admin/services', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('admin.services.index')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
