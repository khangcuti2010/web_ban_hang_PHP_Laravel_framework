
@extends('admin.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID Order</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Note</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->content }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            @php $productPrice =(float)$product->price @endphp
            <tr>
                <td>{{ $product->product_id }}</td>
                <td>{{ $product->product->name }}</td>
                <td>
                    <img width="100px" height="100px" src="/storage/productImg/{{ $product->product->picture }}">
                </td>
                <td>{{ $product->quantity }}</td>
                <td>{{number_format($productPrice,0,'','.')}} đồng</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


