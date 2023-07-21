<?php
namespace App\Http\Services\Slider;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderService
{
    public function create($request)
    {
        try {
            if ($request->hasFile('thumb')) {
                // Kiểm tra và lưu trữ tệp tải lên
                $file = $request->file('thumb');
                // dùng hàm random tạo tên file duy nhất
                $fileName = Str::random(5) . '_' . $file->getClientOriginalName();
                // Lưu trữ tệp vào thư mục 'storage/app/public/productImg'
                $file->storeAs('sliderImg', $fileName, 'storage');
                $slider = new Slider();
                $slider->name = $request->input('name');
                $slider->url = $request->input('url');
                $slider->thumb = $fileName;
                $slider->sort_by = $request->input('sort_by');
                $slider->active = $request->input('active');

                $slider->save();
                Session::flash('success', 'Tạo Sản Phẩm thành công');
            }else{
                Session::flash('success', 'Phải có Thumbnail');
                return redirect()->back()->withInput();
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return redirect()->back()->withInput();
        }
        return true;
    }

    public function getAllSlider()
    {
        return Slider::orderbyDesc('created_at')->paginate(20);// sắp xếp giảm dần theo id và phân trang

    }

    public function getAllSliderIdAndName()
    {
        return Slider::where('active', 1)->orderbyDesc('sort_by')->get();// sắp xếp giảm dần theo id và phân trang
    }

    public function update($slider, $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('thumb')) {
                $file = $request->file('thumb');
                // dùng hàm random tạo tên file duy nhất
                $fileName = Str::random(5) . '_' . $file->getClientOriginalName();
                // Lưu trữ tệp vào thư mục 'storage/app/public/productImg'
                $file->storeAs('sliderImg', $fileName, 'storage');
            }else{
                $fileName = $slider->thumb; //Không có ảnh mới được tải lên, giữ nguyên tên file cũ từ cơ sở dữ liệu
            }
            $slider->name = (string)$request->input('name');
            $slider->url = (string)$request->input('url');
            $slider->thumb = $fileName; //Gán tên file mới hoặc giữ nguyên tên file cũ
            $slider->sort_by = (string)$request->input('sort_by');
            $slider->active = (string)$request->input('active');
            $slider->save();
            Session::flash('success', 'Cập Nhật Slider thành công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $slider = Slider::where('id', $id)->first();
        if ($slider) {
            Storage::disk('storage')->delete('/sliderImg/'.$slider->thumb);// xoá file ảnh trong storage
            return Slider::where('id', $id)->delete();
        }
        return false;
    }

}
