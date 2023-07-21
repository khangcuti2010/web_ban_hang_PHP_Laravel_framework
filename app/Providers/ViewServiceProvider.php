<?php
// phải đưa vào config\app.php
namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\MenuComposer;
use App\View\Composers\UserNameComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Facades\View::composer('main',MenuComposer::class);
        Facades\View::composer('category',MenuComposer::class);
        Facades\View::composer('search',MenuComposer::class);
        Facades\View::composer('product-detail',MenuComposer::class);
        Facades\View::composer('cart',MenuComposer::class);
        Facades\View::composer('checkout',MenuComposer::class);
        Facades\View::composer('register',MenuComposer::class);
        Facades\View::composer('login',MenuComposer::class);
        Facades\View::composer('verify-email',MenuComposer::class);

        Facades\View::composer('top-bar',CartComposer::class);
        Facades\View::composer('checkout',CartComposer::class);
    }
}

