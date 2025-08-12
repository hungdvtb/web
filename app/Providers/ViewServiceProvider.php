<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share categories with the nav partial
        View::composer('frontend.header', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
