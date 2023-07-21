
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
        <h4><span>Regsiter</span></h4>
    </section>
    <section class="main-content">
        <div class="row">
            <div class="span7">
                <h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('register.form')}}" method="POST" class="form-stacked">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Name</label>
                            <div class="controls">
                                <input type="text" required placeholder="Enter your username" name="name" class="input-xlarge">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email address:</label>
                            <div class="controls">
                                <input type="text" required placeholder="Enter your email" name="email" class="input-xlarge">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password:</label>
                            <div class="controls">
                                <input type="password" required placeholder="Enter your password" name="password" class="input-xlarge">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password Confirmation:</label>
                            <div class="controls">
                                <input type="password" required placeholder="Enter your password" name="password_confirmation" class="input-xlarge">
                            </div>
                        </div>
                        <hr>
                        <div class="actions"><input tabindex="9" class="btn btn-inverse large" type="submit" name="register-form" value="Create your account"></div>
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
