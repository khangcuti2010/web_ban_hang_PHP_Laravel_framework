<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
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

    public function index(Request $request )
    {
        $result = $this->cart->create($request);
        if($result == false)
        {
            return redirect()->back();
        }
        return redirect('/cart');
    }

    public function show()
    {
        $product = $this->cart->getProduct();
        return view('cart',[
            'title' => 'Giỏ Hàng Của Bạn',
            'products' => $product,
            'carts' => Session::get('carts'),

        ]);
    }

    public function update(Request $request)
    {
        $this->cart->update($request);
        return redirect('/cart');
    }

    public function remove($id)
    {
        $this->cart->remove($id);
        return redirect('/cart');
    }
}
