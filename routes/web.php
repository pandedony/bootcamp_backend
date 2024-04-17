<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $nama = '<i> Pande Dony </i>';
    return view('welcome', ['nama' => $nama]);
});

Auth::routes();

Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/category/getjson', [CategoryController::class, 'getCategories'])->name('category.getall');
    Route::resource('category', CategoryController::class);

    Route::get('/product/getjson', [ProductController::class, 'getProducts'])->name('product.getall');
    Route::resource('product', ProductController::class);

    // Route::get('/product', [ProductController::class, 'index'])->name('product.index'); // 1
    // Route::post('/product', [ProductController::class, 'store'])->name('product.store'); // 3
    // Route::delete('/product', [ProductController::class, 'destroy'])->name('product.destroy'); // 3
    // Route::get('/product/edit', [ProductController::class, 'edit'])->name('product.edit'); // 3
    // Route::put('/product', [ProductController::class, 'update'])->name('product.update'); // 3
    // Route::get('/product/create', [ProductController::class, 'create'])->name('product.create'); //2 
    // Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show'); // 4
});
