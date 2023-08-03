
<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
@include('top-bar')
<div id="wrapper" class="container">
    @if (session('err'))
        <div class="alert alert-success" role="alert">
            {{ session('err') }}
        </div>
    @endif
    <section class="navbar main-menu">
        <div class="navbar-inner main-menu">
            <a href="http://web-banhang.me/" class="logo pull-left"><img src="/template/themes/images/logo.png" class="site_logo" alt=""></a>
            <nav id="menu" class="pull-right">
                <ul>
                    {!! \App\Helpers\Helper::menu($menus) !!}
                </ul>
            </nav>
        </div>
    </section>
    <section class="header_text sub">
        <img class="pageBanner" src="/template/themes/images/pageBanner.png" alt="New products" >
        <h4><span>Order History</span></h4>
    </section>
    <section class="main-content">
        <form method="POST" action="/checkout">
            <div class="row">
                <div class="span9">
                    @php $total = 0; @endphp
                    <h4 class="title"><span class="text"><strong>Your</strong> Order History</span></h4>
                    @if(isset($orders))
                    @foreach($orders as $key => $order)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Note</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->content}}</td>
                                        <td>{{$order->total_price}}</td>
                                        <td>{{$order->status}}</td>
                                    </tr>
                            <tbody>
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                </thead>
                            @foreach($orderDetails as $orderDetail)
                                @php $orderPrice =(float)$orderDetail->price @endphp
                                <tr>
                                    <td>{{$orderDetail->product->name}}</td>
                                    <td><a href="/product-detail/{{$orderDetail->product->picture}}">
                                            <div style="width: 60px; height: 90px" class="image-container">
                                                <img alt="" src="/storage/productImg/{{$orderDetail->product->picture}}">
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$orderDetail->quantity}}</td>
                                    <td>{{number_format($orderPrice,0,'','.')}} đồng</td>
                                    <!-- Hiển thị các thông tin khác của sản phẩm nếu có -->
                                </tr>
                            @endforeach
                            </tbody>
                </table>
            @endforeach
            @endif
            @csrf
        </form>
    </section>
    @include('footer')
</div>
<script src="/template/themes/js/common.js"></script>
<script>
    $(document).ready(function() {
        $('#checkout').click(function (e) {
            document.location.href = "checkout.html";
        })
    });
</script>
</body>
</html>

