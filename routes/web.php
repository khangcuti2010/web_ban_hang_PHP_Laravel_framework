<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use \App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderHistoryController;
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
//route login
Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

//route trang admin có middleware kiểm tra
route::middleware(['auth','admin'])->group(function (){
    Route::prefix('admin')->group(function (){

        Route::get('/',[\App\Http\Controllers\Admin\MainController::class, 'index'])->name('main');
        Route::get('main',[\App\Http\Controllers\Admin\MainController::class, 'index']);

        //route Menu
        Route::prefix('menus')->group(function (){
                Route::get('add',[MenuController::class,'create']);
                Route::post('add',[MenuController::class,'store']);
                Route::get('list',[MenuController::class,'index']);
                Route::get('edit/{id}',[MenuController::class,'show']);
                Route::post('edit/{id}',[MenuController::class,'update']);
                Route::delete('destroy',[MenuController::class,'destroy']);
        });

        //route Product
        Route::prefix('product')->group(function (){
                Route::get('add',[ProductController::class,'create']);
                Route::post('add',[ProductController::class,'store']);
                Route::get('list',[ProductController::class,'index']);
                Route::get('edit/{id}',[ProductController::class,'show']);
                Route::post('edit/{id}',[ProductController::class,'update']);
                Route::delete('destroy',[ProductController::class,'destroy']);
        });

        //route Slider
        Route::prefix('sliders')->group(function (){
            Route::get('add',[SliderController::class,'create']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('list',[SliderController::class,'index']);
            Route::get('edit/{slider}',[SliderController::class,'show']);
            Route::post('edit/{slider}',[SliderController::class,'update']);
            Route::delete('destroy',[SliderController::class,'destroy']);
        });

        //route Upload
        Route::post('upload/services',[UploadController::class,'store']);
    });
});
Route::get('/',[MainController::class,'index'])->name('dashboard');

//Route đăng ký và xác nhận mail
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('web')->name('register.form');
Route::get('/verify-email', function () {
    return view('verify-email',[
        'title' => 'Xác Nhận Email'
    ]);
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/')->with('verified','Xác nhận Email thành công');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('category/{menu_id}',[ProductController::class,'showByCategory'])->name('products.category');
Route::get('/search/{keyword?}',[ProductController::class,'searchByKeyword'])->name('products.search');
Route::get('product-detail/{id}',[ProductDetailController::class,'index']);
Route::post('cart',[CartController::class,'index']);
Route::get('cart',[CartController::class,'show'])->name('cart');
Route::get('cart/delete/{id}',[CartController::class,'remove']);
Route::post('update-cart',[CartController::class,'update']);
Route::get('checkout',[CheckOutController::class,'index']);
Route::post('checkout',[CheckOutController::class,'addCart'])
    ->middleware('auth')->name('checkout.form');
Route::get('logout',[LogoutController::class,'index']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/order-history', [OrderHistoryController::class, 'index']);





