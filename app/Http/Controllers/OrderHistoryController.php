<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\OrderHistoryService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;
    protected $cart;
    protected $orders;
    public function __construct(SliderService $slider, MenuService $menu, ProductService $product, CartService $cart, OrderHistoryService $orders)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
        $this->cart = $cart;
        $this->orders = $orders;
    }

    public function index()
    {
        $orders = $this->orders->getCart();
        $orderDetails = [];
        foreach ($orders as $order) {
            $orderDetail = $this->orders->getOrderDetail($order->id);

            if ($orderDetail) {
                $orderDetails[$order->id] = $orderDetail;
            }
        }
        return view('order-history',[
            'title' => 'Lịch Sủ Mua Hàng',
            'orders' => $orders,
            'orderDetails' => $orderDetails,
        ]);
    }
}
