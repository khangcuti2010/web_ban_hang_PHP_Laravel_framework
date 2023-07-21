<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;
    public function __construct(SliderService $slider, MenuService $menu, ProductService $product)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index()
    {
        return view('main',[
            'title' => 'Shop đồ cho nữ',
            'sliders' => $this->slider->getAllSliderIdAndName(),
            'menus' => $this->menu->getAllMenuIdAndName(),
            'products' => $this->product->getSomeProduct(),
        ]);
    }
}

