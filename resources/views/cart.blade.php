
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
        <h4><span>Shopping Cart</span></h4>
    </section>
    <section class="main-content">
        <div class="row">
            <div class="span9">
                @php $total = 0; @endphp
                <h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
                @if(count($products) > 0)
                    <form method="POST">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Remove</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        @php
                        $price = $product->price_sale;
                        $priceEnd = $price * $carts[$product->id];
                        $total += $priceEnd;
                        @endphp
                    <tr>
                        <td><a class="btn btn-danger" href="/cart/delete/{{$product->id}}"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class="fas fa-trash-alt"></i></a></td>
                        <td><a href="/product-detail/{{$product->id}}">
                                <div style="width: 120px; height: 180px" class="image-container">
                                    <img alt="" src="/storage/productImg/{{$product->picture}}">
                                </div>
                            </a>
                        </td>
                        <td><b>{{$product->name}}</b></td>
                        <td><input type="number" min="0" name="num_product[{{$product->id}}]" value="{{$carts[$product->id]}}" class="quantity-input input-mini"></td>
                        <td style="font-weight: bold" data-product-id="{{$product->id}}" class="price">{{number_format($price,0,'','.')}} đồng</td>
                        <td style="font-weight: bold" data-product-id="{{$product->id}}" class="total-unit">{{number_format($priceEnd,0,'','.')}} đồng</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td id="total-price"><strong>{{number_format($total,0,'','.')}} đồng</strong></td>
                    </tr>
                    </tbody>
                </table>
                    <p class="buttons center">
                    <input type="submit" id="updateBtn" formaction="/update-cart" class="btn" value="Update Cart">
                    <a href="/checkout"><button class="btn btn-inverse" type="button" id="checkout">Go To Checkout Page</button></a>
                </p>
                    @csrf
                </form>
            </div>
        </div>
        @else
            <div class="text-center"><b> Giỏ hàng trống</b></div>
        @endif
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




    // Hàm tính tổng giá trị của giỏ hàng
   /** function calculateTotal() {
        // Lấy tất cả các phần tử có class "total-unit"
        const totalUnitElements = document.querySelectorAll('.total-unit');

        // Khởi tạo tổng giá trị ban đầu
        let total = 0;

        // Lặp qua tất cả các phần tử "total-unit" và cộng dồn giá trị
        totalUnitElements.forEach(function(totalUnitElement) {
            // Lấy giá trị từ phần tử
            const totalPrice = parseInt(totalUnitElement.textContent);

            // Kiểm tra xem giá trị có hợp lệ hay không
            if (!isNaN(totalPrice)) {
                // Cộng dồn giá trị vào tổng
                total += totalPrice;
            }
        });

        // Hiển thị tổng giá trị vào phần tử <strong> trong thẻ <td>
        const totalPriceElement = document.getElementById('total-price');
        const strongElement = totalPriceElement.querySelector('strong');
        strongElement.textContent = total + ' đồng';
    }

    // Lắng nghe sự kiện thay đổi giá trị của input số lượng
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(function(quantityInput) {
        quantityInput.addEventListener('change', function(event) {
            // Lấy phần tử cha <tr> chứa input số lượng
            const trElement = event.target.closest('tr');

            // Lấy giá trị mới của số lượng từ input
            const newQuantity = parseInt(event.target.value, 10);

            // Kiểm tra xem số lượng có hợp lệ hay không
            if (!isNaN(newQuantity) && newQuantity >= 0) {
                // Tìm phần tử chứa giá trị giá bán và tổng tiền tương ứng với sản phẩm
                const priceElement = trElement.querySelector('.price');
                const totalElement = trElement.querySelector('.total-unit');

                // Lấy giá trị giá bán từ phần tử tìm thấy
                const price = parseInt(priceElement.innerText);

                // Tính tổng tiền
                const total = newQuantity * price;

                // Hiển thị tổng tiền
                totalElement.textContent = total + ' đồng';

                // Tính lại tổng giá trị của giỏ hàng
                calculateTotal();
            }
        });
    });

    // Tính tổng giá trị của giỏ hàng khi trang được tải lại
    window.addEventListener('load', function() {
        calculateTotal();
    });


</script>
</body>
</html>
