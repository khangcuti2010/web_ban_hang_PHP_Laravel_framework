

<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate > input {
            display: none;
        }

        .rate > label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate > label:before {
            content: '★ ';
        }

        .rate > input:checked ~ label,
        .rate > input:checked + label,
        .rate > label:hover {
            color: #ffc700;
        }

        .rate > label:hover,
        .rate > label:hover ~ label {
            color: #deb217;
        }
        .star-rating {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .star-rating i {
            font-size: 20px;
            color: #ffc107;
        }
    </style>
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
                        <div class="star-rating">
                            @for ($i = 1; $i <= $avg_rate; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = $avg_rate + 1; $i <= 5; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
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
        <div class="container">
            <h3>Ratings and Comments</h3>
            @if(isset($comments))
            <div class="row">
                <div class="span8">
                    @foreach($comments as $comment)
                        <div class="well">
                            <div class="rate">
                                <div class="star-rating">
                                    @for ($i = 1; $i <= $comment->rating; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for ($i = $comment->rating + 1; $i <= 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <h4>{{$comment->users->name}} <small class="text-muted"> {{$comment->created_at}}</small></h4>
                            <p>{{$comment->content}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="row">
                <div class="span8">
                    <form method="POST" action="">
                        <h3>Add Rating And Comment</h3>
                        <label for="comment">Rating:</label>
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5"  />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" checked />
                            <label for="star1" title="text">1 star</label>
                        </div>
                        <textarea id="comment" name="comment" class="span8" required></textarea>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @csrf
                    </form>
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
<script>
    $(':radio').change(function() {
        console.log('New star rating: ' + this.value);
    });
</script>
</body>
</html>
