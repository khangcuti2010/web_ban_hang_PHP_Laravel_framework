<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Requests\Product\ProductUpdateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $menuService;
    protected $productService;
    public function __construct(ProductService $productService, MenuService $menuService)
    {
        $this->productService = $productService;
        $this->menuService = $menuService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.list',[
            'title' => 'Danh Sách Sản Phẩm Mới Nhất',
            'products' => $this->productService->getAllProduct(),
        ]);
    }

    public function showByCategory($menu_id)
    {
        $menu = Menu::find($menu_id);
        if ($menu && $menu->parent_id != 0) { //id menu là menu con
            $product = Product::where('menu_id', $menu_id)->paginate(8);
        } else { // Nếu id menu là menu cha thì xuất tất cả các sản phẩm con
            $product = DB::table('products')
                ->join('menus', 'menus.id', '=', 'products.menu_id')
                ->select('products.*', 'menus.name as menu_name')
                ->where('menus.parent_id', $menu_id)
                ->paginate(8);
        }
        return view('category',[
            'title' => 'Danh Sách Sản Phẩm Theo Danh Mục '.$menu->name,
            'products' => $product,
            'name' => $menu,
        ]);
    }

    public function searchByKeyword(Request $request)
    {
        $keyword = $request->input('keyword');
        if ($keyword) {
            $products = Product::where('name', 'like', '%' . $keyword . '%')->paginate(9);
        } else {
            $products = collect(); // Tạo một collection rỗng nếu không có từ khóa
        }
        return view('search',[
            'title' => 'Danh Sách Tìm Kiếm',
            'products' => $products,
            'keyword' => $keyword
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            return view('admin.product.add',[
                'title' => 'Thêm Sản Phẩm Mới',
                'menus' => $this->productService->getAllMenu(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFormRequest $request)
    {
        if($request->has('add')) {
            $this->productService->create($request);//thực thi function create trong ProductService.php
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {
        return view('admin.product.edit',[
            'title' => 'Chỉnh Sửa Sản Phẩm '. $id->name,
            'id' => $id,
            'menus' => $this->productService->getAllMenu(),
            'oldMenu' => $id->menu_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $id, ProductUpdateFormRequest $request)
    {
        $this->productService->update($id, $request);
        return redirect('admin/product/list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if($result==true){
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công Sản Phẩm'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
