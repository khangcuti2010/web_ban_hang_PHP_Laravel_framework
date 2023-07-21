
@extends('admin.main')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Tiêu Đề</th>
            <th>Đường Dẫn</th>
            <th>Ảnh</th>
            <th>Trạng Thái</th>
            <th>Cập NHật</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $slider)
            <tr>
                <td>{{ $slider->name }}</td>
                <td>{{ $slider->url }}</td>
                <td>
                    <img width="100px" height="100px" src="/storage/sliderImg/{{ $slider->thumb }}">
                </td>
                <td>{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                <td>{{ $slider->created_at }}</td>
                <td><a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{$slider->id}}">
                        <i class="fas fa-edit" style="color: #344379;"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$slider->id}},'/admin/sliders/destroy')">
                        <i class="fas fa-trash-alt"></i>
                    </a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {!! $sliders->links() !!}
@endsection


