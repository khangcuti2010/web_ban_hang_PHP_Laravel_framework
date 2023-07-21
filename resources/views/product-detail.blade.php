

<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
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
        <h4><span>{{$product->name}}</span></h4>
    </section>
    <section class="main-content">
        <div class="row">
            <div class="span9">
                <div class="row">
                    <div class="span4">
                        <a href="/storage/productImg/{{ $product->picture }}" class="thumbnail" data-fancybox-group="group1" title="Description 1">
                            <img src="/storage/productImg/{{ $product->picture }}" alt="" /></a>
                        <!--<ul class="thumbnails small">
                            <li class="span1">
                                <a href="themes/images/ladies/2.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 2"><img src="themes/images/ladies/2.jpg" alt=""></a>
                            </li>
                            <li class="span1">
                                <a href="themes/images/ladies/3.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 3"><img src="themes/images/ladies/3.jpg" alt=""></a>
                            </li>
                            <li class="span1">
                                <a href="themes/images/ladies/4.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 4"><img src="themes/images/ladies/4.jpg" alt=""></a>
                            </li>
                            <li class="span1">
                                <a href="themes/images/ladies/5.jpg" class="thumbnail" data-fancybox-group="group1" title="Description 5"><img src="themes/images/ladies/5.jpg" alt=""></a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="span5">
                        <address>
                            <strong>Danh mục: <span>{{$product->menu->name}}</span></strong><br>
                            <strong>Tình trạng hàng:</strong>
                            <br><span>{!! \App\Helpers\Helper::available($product->active) !!}</span></br>
                            <strong>Giá gốc: {{$product->price}} đồng</strong><br>
                        </address>
                        <h4><strong>Giá giảm giá: {{$product->price_sale}} đồng</strong></h4>
                    </div>
                    <div class="span5">
                        <form action="{{ route('cart') }}" method="POST" class="form-inline">
                            <br/>
                            <p>&nbsp;</p>
                            <label>Qty:</label>
                            <input type="number" min="0" name="quantity" class="span1" placeholder="0">
                            <button class="btn btn-inverse" type="submit">Thêm vào giỏ hàng</button>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            @csrf
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="span9">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#home">Description</a></li>
                            <li class=""><a href="#profile">Additional Information</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">{{$product->description}}</div>
                            <div class="tab-pane" id="profile">
                                {!!$product->content!!}
                            </div>
                        </div>
                    </div>
                    <div class="span9">
                        <br>
                        <h4 class="title">
                            <span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
                            <span class="pull-right">
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
                        </h4>
                        <div id="myCarousel-1" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails listing-products">
                                        @foreach($collection1 as $relatives)
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>
                                                <a href="/product-detail/{{$relatives->id}}">
                                                    <img alt="" src="/storage/productImg/{{ $relatives->picture }}"></a><br/>
                                                <a href="/product-detail/{{$relatives->id}}" class="title">{{$relatives->name}}</a><br/>
                                                <a href="#" class="category">{{$relatives->menu->name}}</a>
                                                <p class="price">{{$relatives->price_sale}} đồng</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="item">
                                    <ul class="thumbnails listing-products">
                                        @foreach($collection2 as $relatives)
                                            <li class="span3">
                                                <div class="product-box">
                                                    <span class="sale_tag"></span>
                                                    <a href="/product-detail/{{$relatives->id}}">
                                                        <img alt="" src="/storage/productImg/{{ $relatives->picture }}"></a><br/>
                                                    <a href="/product-detail/{{$relatives->id}}" class="title">{{$relatives->name}}</a><br/>
                                                    <a href="#" class="category">{{$relatives->menu->name}}</a>
                                                    <p class="price">{{$relatives->price_sale}} đồng</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span3 col">
                <div class="block">
                    <h4 class="title">
                        <span class="pull-left"><span class="text">Randomize</span></span>
                    </h4>
                    <div id="myCarousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="active item">
                                <ul class="thumbnails listing-products">
                                    @foreach($random as $randoms)
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>
                                                <a href="/product-detail/{{$randoms->id}}">
                                                    <img alt="" src="/storage/productImg/{{ $randoms->picture }}"></a><br/>
                                                <a href="/product-detail/{{$randoms->id}}" class="title">{{$randoms->name}}</a><br/>
                                                <a href="#" class="category">{{$randoms->menu->name}}</a>
                                                <p class="price">{{$randoms->price_sale}} đồng</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</div>
<script src="/template/themes/js/common.js"></script>
<script>
    $(function () {
        $('#myTab a:first').tab('show');
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        })
    })
    $(document).ready(function() {
        $('.thumbnail').fancybox({
            openEffect  : 'none',
            closeEffect : 'none'
        });

        $('#myCarousel-2').carousel({
            interval: 2500
        });
    });
</script>
</body>
</html>
