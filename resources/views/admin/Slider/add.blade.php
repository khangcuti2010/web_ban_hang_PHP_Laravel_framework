@extends('admin.main')

@section('content')
    <div class="card card-primary">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label>Tiêu Đề</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="slider" placeholder="Nhập Tiêu Đề">
                </div>

                <div class="form-group">
                    <label>Đường Dẫn</label>
                    <input type="text" name="url" value="{{old('url')}}" class="form-control">
                </div>

                <label>Thumbnail Slider</label>
                Select image to upload:
                <input type="file" name="thumb" id="thumb" accept="image/*"
                       onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                <div style="width: 300px; height: 300px; overflow: hidden;">
                    <img style="width: 100%; height: auto; object-fit: cover;" id="preview" src="#" alt="Preview Image">
                </div>

                <div class="form-group">
                    <label>Sắp Xếp</label>
                    <input type="number" name="sort_by" value="{{old('sort_by')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Kích Hoạt</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" name="add" class="btn btn-primary">Thêm Slider</button>
            </div>
            @csrf
        </form>
    </div>
@endsection



