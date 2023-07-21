
@extends('admin.main')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Content</th>
            <th>Menu</th>
            <th>Price</th>
            <th>Price_Sale</th>
            <th>Image</th>
            <th>Active</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->content }}</td>
                <td>{{ $product->menu->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price_sale }}</td>
                <td>
                    <img width="100px" height="100px" src="/storage/productImg/{{ $product->picture }}">
                </td>
                <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                <td><a class="btn btn-primary btn-sm" href="/admin/product/edit/{{$product->id}}">
                        <i class="fas fa-edit" style="color: #344379;"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" href="#"
                       onclick="removeRow({{$product->id}},'/admin/product/destroy')">
                        <i class="fas fa-trash-alt"></i>
                    </a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {!! $products->links() !!}
@endsection

