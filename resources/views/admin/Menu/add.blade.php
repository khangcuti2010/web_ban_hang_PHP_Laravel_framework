@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="card card-primary">
        <form action="" method="POST">
            <div class="card-body">
                <div class="form-group">
                    <label>Tên Danh Mục</label>
                    <input type="text" name="name" class="form-control" id="menu" placeholder="Nhập Tên Danh Mục">
                </div>

                <div class="form-group">
                    <label>Danh Mục</label>
                    <select class="form-control" name="parent_id">
                        <option value="0">Danh Mục Cha</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Mô Tả</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label>Nội Dung Chi Tiết</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
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
                <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
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
