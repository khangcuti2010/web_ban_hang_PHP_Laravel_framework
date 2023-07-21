@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label>Tên Sản Phẩm</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="product" placeholder="Nhập Tên Sản Phẩm">
                </div>

                <div class="form-group">
                    <label>Danh Mục Sản phẩm</label>
                    <select class="form-control" name="menu_id">
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea class="form-control" name="description">{{old('description')}}</textarea>
                </div>

                <div class="form-group">
                    <label>Nội Dung Chi Tiết</label>
                    <textarea class="form-control" id="content" name="content">{{old('content')}}</textarea>
                </div>

                <div class="form-group">
                    <label>Giá Tiền</label>
                    <input type="number" name="price" class="form-control" id="price" value="{{old('price')}}">
                </div>

                <div class="form-group">
                    <label>Giá Tiền Giảm Giá</label>
                    <input type="number" name="price_sale" class="form-control" id="price_sale" value="{{old('price_sale')}}">
                </div>

                    <label>Ảnh Sảm Phẩm</label>
                    Select image to upload:
                    <input type="file" name="picture" id="picture" accept="image/*"
                           onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                    <div style="width: 300px; height: 300px; overflow: hidden;">
                        <img style="width: 100%; height: auto; object-fit: cover;" id="preview" src="#" alt="Preview Image">
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
                <button type="submit" name="add" class="btn btn-primary">Tạo Sản Phẩm</button>
            </div>
            @csrf
        </form>
    </div>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection

