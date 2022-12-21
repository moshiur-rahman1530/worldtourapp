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

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', [App\Http\Controllers\UserhomeController::class, 'index']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.route')->middleware('admin');


// admin category controller

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('admin');
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->middleware('admin');
Route::get('/allcategory', [App\Http\Controllers\CategoryController::class, 'allcategory'])->middleware('admin');
Route::post('/categoryDelete', [App\Http\Controllers\CategoryController::class, 'categoryDelete'])->middleware('admin');

Route::get('/catbyproduct', [App\Http\Controllers\CategoryController::class, 'catbyproduct'])->middleware('admin');
Route::post('/categoryDetails',[App\Http\Controllers\CategoryController::class, 'categoryDetails'])->middleware('admin');
Route::post('/updateCategory',[App\Http\Controllers\CategoryController::class, 'updateCategory'])->middleware('admin');

// change status
Route::post('/categoryStatus',[App\Http\Controllers\CategoryController::class, 'catStatus'])->middleware('admin');


// admin tour controller

Route::get('/admin/tour', [App\Http\Controllers\TourController::class, 'index'])->middleware('admin');
Route::post('/admin/tour', [App\Http\Controllers\TourController::class, 'store'])->middleware('admin');
Route::get('/alltour', [App\Http\Controllers\TourController::class, 'alltour'])->middleware('admin');
Route::post('/tourDelete', [App\Http\Controllers\TourController::class, 'tourDelete'])->middleware('admin');

Route::get('/catbytour', [App\Http\Controllers\TourController::class, 'catbytour'])->middleware('admin');
Route::post('/tourDetails',[App\Http\Controllers\TourController::class, 'tourDetails'])->middleware('admin');
Route::post('/updateTour',[App\Http\Controllers\TourController::class, 'updateTour'])->middleware('admin');

// change status
Route::post('/tourStatus',[App\Http\Controllers\TourController::class, 'tourStatus']);
Route::post('/filterTour',[App\Http\Controllers\TourController::class, 'filterTour']);
Route::get('/tourpage/{id}',[App\Http\Controllers\TourController::class, 'userTourDetails'])->middleware('auth');
Route::get('/travel/{id}',[App\Http\Controllers\CategoryController::class, 'userCategoryDetails'])->middleware('auth');
// Route::get('/tourpage/{id}',[App\Http\Controllers\TourController::class, 'userTourDetails'])->middleware('auth');
Route::post('/contact',[App\Http\Controllers\ContactController::class, 'storeContact']);
Route::get('/bookTour/{id}',[App\Http\Controllers\BooktourController::class, 'bookTour'])->middleware('auth');
Route::get('/all-tours',[App\Http\Controllers\UserhomeController::class, 'AllTourPackage']);
Route::get('/about',[App\Http\Controllers\UserhomeController::class, 'AboutUs']);
Route::get('/admin/manage-tour',[App\Http\Controllers\TourController::class, 'manageTourPage'])->middleware('admin');
Route::get('/managetourbook',[App\Http\Controllers\TourController::class, 'manageTour'])->middleware('admin');
Route::post('/tourBookStatus',[App\Http\Controllers\TourController::class, 'tourBookStatus'])->middleware('admin');
Route::post('/bookTourDelete',[App\Http\Controllers\TourController::class, 'bookTourDelete'])->middleware('admin');