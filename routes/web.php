<?php

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

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes for categories
Route::resource('categories', CategoryController::class)->except(['show']);
Route::put('/categories/{category}/status', [CategoryController::class, 'status'])->name('categories.status');
Route::put('/categories/{category}/featured', [CategoryController::class, 'featured'])->name('categories.featured');

// Routes for subcategories
Route::resource('subcategories', SubCategoryController::class)->except(['show']);
Route::put('/subcategories/{subcategory}/status', [SubCategoryController::class, 'status'])->name('subcategories.status');



//these routes will also work fine. 

// // Routes for categories
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
// Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
// Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
// Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
// Route::put('/categories/{category}/status', [CategoryController::class, 'status'])->name('categories.status');
// Route::put('/categories/{category}/featured', [CategoryController::class, 'featured'])->name('categories.featured');

// // Routes for subcategories
// Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
// Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
// Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
// Route::get('/subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
// Route::put('/subcategories/{subcategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');
// Route::delete('/subcategories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
// Route::put('/subcategories/{subcategory}/status', [SubCategoryController::class, 'status'])->name('subcategories.status');


