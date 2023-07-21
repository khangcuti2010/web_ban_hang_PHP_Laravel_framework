<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
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
        <img class="pageBanner" src="template/themes/images/pageBanner.png" alt="New products" >
        <h4><span>Email Verification</span></h4>
    </section>
    <section class="main-content">
        <div class="card">
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Một Email xác nhận đã được gửi đến email của bạn') }}
                    </div>
                @else
                        <div class="alert alert-success" role="alert">
                            {{ __('Một Email xác nhận đã được gửi đến email của bạn') }}
                        </div>
                @endif

                {{ __('Trước khi chọn gửi lại, vui lòng kiểm tra email của bạn,') }}
                {{ __('Nếu như bạn không nhận được email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click vào đây để gửi một email khác.') }}</button>.
                </form>
            </div>
        </div>
    </section>
    @include('footer')
</div>
<script src="template/themes/js/common.js"></script>
<script>
    $(document).ready(function() {
        $('#checkout').click(function (e) {
            document.location.href = "checkout.html";
        })
    });
</script>
</body>
</html>
