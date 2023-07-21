<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;
    protected $cart;
    public function __construct(SliderService $slider, MenuService $menu, ProductService $product, CartService $cart)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
        $this->cart = $cart;
    }

    public function index()
    {
        return view('checkout',[
            'title' => 'Thông Tin Thanh Toán Của Bạn',
            'carts' => Session::get('carts'),
        ]);
    }

    public function addCart(Request $request)
    {
        $result = $this->cart->addCart($request);
        if($result == true)
        {
            return redirect()->route('dashboard')->with('checkout', 'Checkout giỏ hàng thành công');
        }else{
            return redirect()->route('dashboard')->with('checkout', 'Checkout giỏ hàng không thành công');
        }
    }
}
