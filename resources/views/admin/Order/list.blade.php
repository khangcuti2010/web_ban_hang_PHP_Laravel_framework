
@extends('admin.main')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Note</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Order Detail</th>
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
                <td><a class="btn btn-primary btn-sm" href="/admin/order/detail/{{$order->id}}">
                        <i class="fa-solid fa-circle-info"></i>
                    </a>
                </td>
                <td><a class="btn btn-primary btn-sm" href="/admin/order/edit/{{$order->id}}">
                        <i class="fas fa-edit" style="color: #344379;"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $orders->links() !!}
@endsection

