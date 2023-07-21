<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;


class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }

    public function create()
    {
        {
            return view('admin.slider.add',[
                'title' => 'Thêm Slider Mới',
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required',
        ]);
        $this->slider->create($request);
        return redirect()->back();
    }

    public function index()
    {
        return view('admin.slider.list',[
            'title' => 'Danh Sách Slider',
            'sliders' => $this->slider->getAllSlider()
            ]);
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit',[
            'title' => 'Chỉnh Sửa Slider '. $slider->name,
            'slider' => $slider,
        ]);
    }

    public function update(Slider $slider, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'url' => 'required',
            'sort_by' => 'required'
        ]);
        $this->slider->update($slider, $request);
        return redirect('admin/sliders/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->destroy($request);
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
