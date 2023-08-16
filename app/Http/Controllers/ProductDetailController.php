<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ProductDetailController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id)
    {
        $product = $this->productService->showDetail($id);
        $relativeProduct = $this->productService->relativeProduct($id);
        $random = $this->productService->getRandomProduct();
        $comment = $this->productService->getComment($id);
        return view('product-detail',[
            'title' => $product->name,
            'product' => $product,
            'random' => $random,
            'collection1' => $relativeProduct['collection1']?? [],
            'collection2' => $relativeProduct['collection2']?? [],
            'comments' => $comment
        ]);
    }

    public function show()
    {
        $comment = $this->productService->getAllComment();
        return view('admin.comment.list',[
            'title' => 'Danh Sách Bình Luận',
            'comments' => $comment
        ]);
    }
}
