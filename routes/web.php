<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('types', TypeController::class);
    Route::resource('products', ProductController::class);
    Route::get('fetch-products/{id}/', [ProductController::class, 'fetchById'])->name('products.fetch');
    Route::resource('variants', VariantController::class)->except('show', 'index');
    Route::get('fetch-variant/{id}/', [VariantController::class, 'fetchVariant']);
    Route::resource('roles', RoleController::class);
    Route::resource('files', DocumentController::class);
    Route::get('fetch-documents/{id}/', [DocumentController::class, 'fetchDocuments'])->name('documents.fetch');;
    Route::post('document/store', [DocumentController::class, 'store'])->name('document.store');
    Route::put('update-document/{id}', [DocumentController::class, 'update'])->name('document.update');
    Route::delete('destroy-document/{id}', [DocumentController::class, 'destroy'])->name('document.destroy');
});
