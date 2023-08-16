
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
        <img class="pageBanner" src="template/themes/images/pageBanner.png" alt="New products" >
        <h4><span>Login</span></h4>
    </section>
    <section class="main-content">
        <div class="row">
            <div class="span5">
                <h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
                <form action="{{route('login')}}" method="POST">
                    <input type="hidden" name="next" value="/">
                    <fieldset>
                        @if ($errors->any())
                            <div>
                                <strong>Lỗi:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color: red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="control-group">
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <input type="text" required placeholder="Enter your email" name="email" id="username" class="input-xlarge">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password</label>
                            <div class="controls">
                                <input type="password" required placeholder="Enter your password" name="password" id="password" class="input-xlarge">
                            </div>
                        </div>
                        <div class="control-group">
                            <input tabindex="3" class="btn btn-inverse large" type="submit" name="login" value="Sign into your account">
                            <hr>
                            <p class="reset">Recover your <a tabindex="4" href="/forgot-password" title="Recover your username or password">username or password</a></p>
                        </div>
                    </fieldset>
                    @csrf
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

