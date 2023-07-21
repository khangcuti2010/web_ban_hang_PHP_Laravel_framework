
@extends('admin.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Parent ID</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>Active</th>
                    <th>Update</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->parentName() }}</td>
                <td>{{ $menu->description }}</td>
                <td>{{ $menu->content }}</td>
                <td>{!! \App\Helpers\Helper::active($menu->active) !!}</td>
                <td><a class="btn btn-primary btn-sm" href="/admin/menus/edit/{{$menu->id}}">
                        <i class="fas fa-edit" style="color: #344379;"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$menu->id}},'/admin/menus/destroy')">
                        <i class="fas fa-trash-alt"></i>
                    </a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    {!! $menus->links() !!}
@endsection
