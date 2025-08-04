<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

(new OpenAdmin\Admin\Admin)->routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('books', BookController::class);
    $router->resource('book-categories', BookCategoryController::class);
    $router->resource('chapters', ChapterController::class);
    $router->resource('categories', CategoryController::class);


});
