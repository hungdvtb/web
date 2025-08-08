<?php

use App\Http\Controllers\Admin\Book\BookController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Chapter\ChapterController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Upload\UploadController;
use App\Http\Controllers\UserController as ControllersUserController;
use FontLib\Table\Type\name;
use Illuminate\Routing\RouteGroup;
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

//login
// Route::get('admin/login', [LoginController::class, 'index'])->name('get-login');
// Route::post('admin/login', [LoginController::class, 'store'])->name('login-admin');
// Route::post('admin/log-out', [LoginController::class, 'logout'])->name('log-out');




// Route::middleware(['auth'])->group(function () {

//     Route::prefix('admin')->group(function () {
//         //dashboard
//         Route::get('/dashboard', [LoginController::class, 'show'])->name('dashboard');

//         Route::resource('/category', CategoryController::class);

//         Route::resource('/book', BookController::class);

//         Route::resource('/chapters', ChapterController::class);

//         Route::post('/storage/upload', [UploadController::class, 'store']);

//         Route::post('/featured-books', [BookController::class, 'featuredBooks'])->name('featured-books');
//     });

// });


//home

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{slug}.html', [HomeController::class, 'detail'])->name('detail');

Route::get('/danh-sach/{slug}.html', [HomeController::class, 'danhmuc'])->name('danh-muc');
Route::get('/{bookslug}/{slug}.html', [HomeController::class, 'chapter'])->name('chapter');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/search', [HomeController::class, 'ajaxsearch'])->name('ajaxsearch'); 

Route::post('/review', [HomeController::class, 'review'])->name('review'); 
//filter
Route::get('/filtered/{char}', [HomeController::class, 'filteredChar'])->name('filteredChar');
 

