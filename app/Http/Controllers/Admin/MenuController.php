<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Requests\Menu\UpdateFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;


class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function create()
    {
        return view('admin.menu.add',[
            'title' => 'Thêm Danh Mục Mới',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)//dùng CreateFormRequest để validate data
    {
        $this->menuService->create($request);//thực thi function create trong MenuService.php
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.menu.list',[
            'title' => 'Danh Sách danh Mục Mới Nhất',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function show( Menu $id)//kiểm tra id trên url có tồn tại hay không
    {
        return view('admin.menu.edit',[
            'title' => 'Chỉnh Sửa Danh Mục '. $id->name,
            'id' => $id,
            'parent' => $this->menuService->getParent()
        ]);

    }

    public function update( Menu $id, UpdateFormRequest $request)
    {
        $this->menuService->update($id, $request);
        return redirect('admin/menus/list');
    }

    public function destroy(Request $request)
    {
          $result = $this->menuService->destroy($request);
          if($result==true){
              return response()->json([
                'error' => false,
                  'message' => 'Xoá thành công danh mục'
              ]);
          }

              return response()->json([
                'error' => true
              ]);

    }
}
