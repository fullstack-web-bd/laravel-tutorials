<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\TodosController;

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

Route::get('/', [TestController::class, 'index'])->name('index');
Route::get('/hello', [TestController::class, 'hello'])->name('tests.hello');
Route::get('show/{id}', [TestController::class, 'show'])->name('tests.show');

Route::view('/welcome', 'welcome')->name('welcome.index');

// Route::prefix('todos')->controller(TodosController::class)->name('todos.')->group(function () {
//     Route::get('', 'index')->name('index');
//     Route::get('{slug}', 'show')->name('show');
//     Route::get('edit/{slug}', 'edit')->name('edit');
// });

Route::resource('todos', TodosController::class);

// Route::redirect('/', '/todos');


// Route::get('/portfolios', function() {
//     return "Portfolios";
// });

// Route::get('/portfolios/1', function() {
//     return "Portfolio Details";
// });

// Route::get('/portfolios/{id}/{slug}', function($id, $slug) {
//     return "Portfolios:: " . $id . " SLUG::" . $slug;
// });