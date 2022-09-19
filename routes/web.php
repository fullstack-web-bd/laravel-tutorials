<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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

Route::get('/', [ProductsController::class, 'index'])->name('index');
Route::get('/db-examples', [ProductsController::class, 'dbExamples'])->name('index.db');




Route::get('/category/{id}', [ProductsController::class, 'category'])->name('category.show');
Route::get('/tag/{id}', [ProductsController::class, 'tag'])->name('tag.show');
Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');