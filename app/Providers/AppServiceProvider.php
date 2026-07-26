<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Brand;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer(['client.*'], function ($view) {
            $view->with('categories', Category::where('status', 1)->orderBy('catename')->get());
            $view->with('brands', Brand::where('status', 1)->orderBy('brandname')->get());
        });
    }
}