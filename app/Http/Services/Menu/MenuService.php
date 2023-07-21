<?php

namespace App\Http\Services\Menu;

use App\Http\Controllers\Admin\MenuController;
use App\Models\Menu;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Session;

class MenuService
{
    //Hàm lấy danh mục cha
    public function getParent()
    {
        return Menu::where('parent_id',0)->get();
    }

    //Hàm lấy tất cả
    public function getAll()
    {
        return Menu::orderbyDesc('name')->where('active',1)->paginate(20);// sắp xếp giảm dần theo id và phân trang
    }

    public function getAllMenuIdAndName()
    {
        return Menu::select('id','name','parent_id')->where('active', 1)->orderBy('id','asc')->get();// sắp xếp giảm dần theo id và phân trang
    }
    //Hàm Insert dữ liệu
    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active')
            ]);
            //Thông báo tạo thành công
            Session::flash('success','Tạo Danh Mục thành công');
        }catch (\Exception $err){
            //Thông báo tạo bị lỗi
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
    //Hàm Update dữ liệu
    public function update($id, $request)
    {
        try {
            if($request->input('parent_id') !== $id->id )
            { // cập nhật parent_id không được trùng với id hiện tại
                $id->parent_id = (int) $request->input('parent_id');
            }
                $id->name = (string) $request->input('name');
                $id->description = (string) $request->input('description');
                $id->content = (string) $request->input('content');
                $id->active = (string) $request->input('active');
                $id->save();
                Session::flash('success', 'Cập Nhật Danh Mục thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    //hàm xoá dữ liệu
    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if($menu){
             return Menu::where('id', $id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }
}
