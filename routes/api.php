<?php
 
use App\Http\Controllers\Home\HomeController; 
use Illuminate\Support\Facades\Route; 
//search by ajax
Route::post('/search-keywords', [HomeController::class, 'SearchAjax'])->name('search-ajax');
  