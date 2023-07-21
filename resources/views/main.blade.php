<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body>
@include('top-bar')
<div id="wrapper" class="container">
    @if (session('verified'))
        <div class="alert alert-success" role="alert">
            {{ session('verified') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('checkout'))
            <div class="alert alert-success" role="alert">
                {{ session('checkout') }}
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
    <section  class="homepage-slider" id="home-slider">
        <div class="flexslider">
            <ul class="slides">
                @foreach($sliders as $slider)
                <li>
                    <a href="{{$slider->url}}">
                        <img style="width: 1190px; height: 669px" src="/storage/sliderImg/{{ $slider->thumb }}" alt="" />
                    </a>
                    <div class="intro">
                        <h1>Mid season sale</h1>
                        <p><span>{{$slider->name}}</span></p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="header_text">
        Welcome to our trendy and dynamic online clothing store for young women!
        Discover the perfect fusion of style and energy in our fashionable collection.
        Designed specifically for the modern, active woman, our clothing range showcases the latest trends that
        capture a youthful spirit. From stylish tops and dresses to comfortable activewear and versatile accessories,
        we have everything you need to express your unique style. Explore our high-quality selection and elevate
        your wardrobe effortlessly. Shop now and embrace the vibrant fashion that defines you!
        <br/>Don't miss to use our high quality services and best quality of all clothing.
    </section>
    <section class="main-content">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span12">
                        <h4 class="title">
                            <span class="pull-left"><span class="text"><span class="line">Feature <strong>Category</strong></span></span></span>
                        </h4>
                        <div id="myCarousel" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails">
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>
                                                <p><a href="http://web-banhang.me/category/1"><img style="width: 270px; height: 270px" src="/storage/menuImg/Jeans.jpg" alt="" /></a></p>
                                                <a href="product_detail.html" class="title">Jeans</a><br/>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>
                                                <p><a href="http://web-banhang.me/category/2"><img style="width: 270px; height: 270px" src="/storage/menuImg/Skirt.png" alt="" /></a></p>
                                                <a href="product_detail.html" class="title">Skirt</a><br/>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="product-box">
                                                <p><a href="http://web-banhang.me/category/4"><img style="width: 270px; height: 270px" src="/storage/menuImg/Top.jpg" alt="" /></a></p>
                                                <a href="product_detail.html" class="title">Top</a><br/>
                                            </div>
                                        </li>
                                        <li class="span3">
                                            <div class="product-box">
                                                <p><a href="http://web-banhang.me/category/5"><img style="width: 270px; height: 270px" src="/storage/menuImg/Dress.png" alt="" /></a></p>
                                                <a href="product_detail.html" class="title">Dress</a><br/>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="span12">
                        <h4 class="title">
                            <span class="pull-left"><span class="text"><span class="line">Latest <strong>Products</strong></span></span></span>
                        </h4>
                        <div id="myCarousel-2" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails">
                                        @foreach($products as $product)
                                        <li class="span3">
                                            <div class="product-box">
                                                <span class="sale_tag"></span>
                                                <p><a href="/product-detail/{{$product->id}}"><img src="/storage/productImg/{{ $product->picture }}" alt="" /></a></p>
                                                <a href="/product-detail/{{$product->id}}" class="title">{{$product->name}}</a><br/>
                                                <a href="/product-detail/{{$product->id}}" class="category">{{$product->menu->name}}</a>
                                                <p class="price">{{$product->price}} đồng</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row feature_box">
                    <div class="span4">
                        <div class="service">
                            <div class="responsive">
                                <img src="/template/themes/images/feature_img_2.png" alt="" />
                                <h4>MODERN <strong>DESIGN</strong></h4>
                                <p>Discover our clothing line featuring Modern Design.
                                    Our collection offers a blend of contemporary styles that are both trendy and enduring.
                                    With a focus on clean lines, sleek cuts, and innovative details, our Modern Design garments
                                    are perfect for those seeking a sophisticated and effortlessly stylish look. We carefully
                                    craft each piece to ensure comfort, quality, and the latest fashion trends,
                                    allowing you to express your unique style with confidence. Whether you're getting ready
                                    for a special event or simply looking to elevate your everyday attire, our Modern Design
                                    collection has something for everyone. Browse through our range today and upgrade your wardrobe
                                    with modern elegance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="service">
                            <div class="customize">
                                <img src="/template/themes/images/feature_img_1.png" alt="" />
                                <h4>FREE <strong>SHIPPING</strong></h4>
                                <p>Welcome to our online clothing store! We are delighted to offer Free Shipping on all
                                    orders. Say goodbye to additional shipping costs and enjoy the convenience of having
                                    your favorite clothes delivered to your doorstep without any extra charges. Whether
                                    you 're looking for trendy fashion pieces or timeless classics, our Free Shipping policy
                                    ensures that you can shop with ease and make the most of your shopping experience.
                                    Shop now and take advantage of this fantastic offer, bringing you both exceptional style
                                    and savings. Hurry and browse our collection today!</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="service">
                            <div class="support">
                                <img src="/template/themes/images/feature_img_3.png" alt="" />
                                <h4>24/7 LIVE <strong>SUPPORT</strong></h4>
                                <p>We take customer satisfaction seriously, which is why we are proud to offer 24/7
                                    live support on our clothing website. Our dedicated team of experts is available
                                    round-the-clock to assist you with any queries or concerns you may have.
                                    Whether you need help with sizing, product information, or assistance with the ordering
                                    process, our knowledgeable and friendly support staff is just a click or call away.
                                    With our 24/7 live support, you can shop with confidence, knowing that help is always
                                    available whenever you need it. Experience exceptional customer service today and
                                    enjoy a hassle-free shopping experience. Contact us anytime and let us provide you
                                    with the assistance you deserve.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('footer')
</div>
</body>
</html>
