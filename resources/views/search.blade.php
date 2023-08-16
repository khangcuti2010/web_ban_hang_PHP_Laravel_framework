
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
        <img class="pageBanner" src="/template/themes/images/pageBanner.png" alt="New products" >
        <h4><span></span></h4>
    </section>
    <section class="header_text sub">
        @if ($keyword)
        <h4 class="title"><h4>Danh Sách Sản Phẩm Theo Tìm Kiếm: <strong>{{$keyword}}</strong></h4></h4>
        <h4><span></span></h4>
    </section>
    <section class="main-content">

        <div class="row">
            <div class="span9">

                    @if ($products->isEmpty())
                        <span><strong>Không tìm thấy sản phẩm nào</strong></span>
                    @else
                        <ul class="thumbnails listing-products">
                    @foreach($products as $product)
                        <li class="span3">
                            <div class="product-box">
                                <span class="sale_tag"></span>
                                <div style="width: 270px; height: 384px" class="image-container">
                                <a href="/product-detail/{{$product->id}}"><img alt="" src="/storage/productImg/{{$product->picture}}"></a><br/>
                                </div>
                                <a href="/product-detail/{{$product->id}}" class="title">{{ \Illuminate\Support\Str::limit($product->name, 32) }}</a><br/>
                                <a href="#" class="category">{{$product->menu->name}}</a>
                                <p class="price">{{$product->price}} đồng</p>
                            </div>
                        </li>
                    @endforeach
                        </ul>
                        <div class="pagination pagination sm">{!! $products->appends(['keyword' => $keyword])->links() !!}</div>
                        @endif
                        @else
                            <p>Vui lòng nhập từ khóa để tìm kiếm</p>
                            @endif
                <hr>
            </div>
        </div>
    </section>
    @include('footer')
</div>
<script src="themes/js/common.js"></script>
</body>
</html>
