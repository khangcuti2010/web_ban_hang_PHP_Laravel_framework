@extends('admin.main')

@section('content')
    <div class="card card-primary">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label>Tiêu Đề</label>
                    <input type="text" name="name" value="{{$slider->name}}" class="form-control" id="slider" placeholder="Nhập Tiêu Đề">
                </div>

                <div class="form-group">
                    <label>Đường Dẫn</label>
                    <input type="text" name="url" value="{{$slider->url}}" class="form-control">
                </div>

                <label>Thumbnail Slider</label>
                Select image to upload:
                <input type="file" name="thumb" id="thumb" accept="image/*"
                       onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                <div style="width: auto; height: auto; overflow: hidden; display: flex" >
                    <img title="Ảnh mới đang chọn" style="margin-right: 10px; width: 300px; height: 300px; object-fit: cover;" id="preview" src="#" alt="Preview Image">
                    <img title="Ảnh cũ đang sử dụng" style="width: 300px; height: 300px; object-fit: cover;" src="/storage/sliderImg/{{ $slider->thumb }}">
                </div>
                <input type="hidden" name="thumb" value="{{$slider->thumb}}" id="thumb">

                <div class="form-group">
                    <label>Sắp Xếp</label>
                    <input type="number" name="sort_by" value="{{$slider->sort_by}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Kích Hoạt</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                            {{$slider->active == 1 ? 'checked=""' : ''}}>
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                            {{$slider->active == 0 ? 'checked=""' : ''}}>
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" name="add" class="btn btn-primary">Cập Nhật Slider</button>
            </div>
            @csrf
        </form>
    </div>
@endsection



