
<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('top-bar')
<div id="wrapper" class="container">
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
        <h4 class="title"><h4>Danh Sách Sản Phẩm Theo Danh Mục <strong>{{$name->name}}</strong></h4></h4>
        <h4><span></span></h4>
    </section>
    <section class="main-content">
        <div id="myCarousel-2" class="myCarousel carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <ul class="thumbnails">
                        @foreach($products as $product)
                            <li class="span3">
                                <div class="product-box">
                                    <span class="sale_tag"></span>
                                    <div style="width: 270px; height: 384px" class="image-container">
                                    <p><a href="/product-detail/{{$product->id}}">
                                            <img src="/storage/productImg/{{ $product->picture }}" alt="" /></a>
                                    </p>
                                    </div>
                                    <a href="/product-detail/{{$product->id}}" class="title">{{ \Illuminate\Support\Str::limit($product->name, 32) }}</a><br/>
                                    <a href="/product-detail/{{$product->id}}" class="category">{{$product->menu_name}}</a>
                                    <p class="price">{{$product->price}} đồng</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="pagination pagination sm">{!! $products->onEachSide(2)->links() !!}</div>
                </div>
            </div>
    </section>
    @include('footer')
</div>
<script src="themes/js/common.js"></script>
</body>
</html>
