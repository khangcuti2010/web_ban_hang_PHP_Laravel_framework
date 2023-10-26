<div id="top-bar" class="container">
    <div class="row">
        <div class="span4">
            <form method="GET" action="{{ route('products.search') }}" class="">
                <input type="text" name="keyword" class="input-block-level search-query" Placeholder="Tìm kiếm theo tên"
                       id="search" value="">
                <input class="btn btn-primary btn-lg" type="submit" name="" value="Search" />
                <br>
                <div id="search_list"></div>
            </form>
        </div>
        <div class="span8">
            <div class="account pull-right">
                @php $carts = \Illuminate\Support\Facades\Session::get('carts');
                    $user = \Illuminate\Support\Facades\Auth::user();
                if ($carts && is_array($carts))
                {
                        $cartCount = count($carts);
                } else {
                        $cartCount = 0;
                        }
                     @endphp
                <ul class="user-menu">
                    <li>
                        <span href="#"><i class="fa-solid fa-user"></i>
                            @if(\Illuminate\Support\Facades\Auth::user())
                            <span class="cart-count">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                            @endif
                            @if($user && $user->email_verified_at == null)
                            <a href="/verify-email"><span class="cart-count btn-danger">Xác Thực Email</span></a>
                            @else
                            @endif
                        </span>
                    </li>
                    <li>
                        <a href="/cart"><i class="fa-solid fa-cart-shopping"></i>
                            <span class="cart-count">{{$cartCount}}</span></a>
                    </li>
                    @guest()
                    <li><a href="/register">Register</a></li>
                    <li><a href="/login">Login</a></li>
                    @endguest
                    @if(\Illuminate\Support\Facades\Auth::user())
                        <li><a href="/order-history">Order History</a></li>
                        <li><a href="/logout">Logout</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    //Auto Complete Search Product
    var searchTerm = "";
    $("#search").on("keyup", function () {
        // Lấy nội dung trường tìm kiếm
        var newSearchTerm = $(this).val().trim();

        // Kiểm tra xem nội dung trường tìm kiếm đã thay đổi
        if (newSearchTerm !== searchTerm && newSearchTerm.length >= 3) {
            // Lưu lại nội dung trường tìm kiếm mới
            searchTerm = newSearchTerm;

            // Gọi yêu cầu AJAX để tải dữ liệu gợi ý
            $.ajax({
                method: "GET",
                url: "/suggestion",
                data: { search: searchTerm }, // Truyền dữ liệu tìm kiếm lên server
                success: function (response) {
                    // Cập nhật dữ liệu gợi ý với dữ liệu từ server
                    //console.log(response);
                    autoComplete(response);
                }
            });
        }
    });
        function autoComplete(availableTags)
        {
            $("#search").autocomplete({
                source: availableTags
            });
        }
</script>

