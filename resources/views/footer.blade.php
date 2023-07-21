<section id="footer-bar">
    <div class="row">
        <div class="span3">
            <h4>Navigation</h4>
            <ul class="nav">
                <li><a href="./">Homepage</a></li>
                <li><a href="./about.html">About Us</a></li>
                <li><a href="./contact.html">Contac Us</a></li>
                <li><a href="/cart">Your Cart</a></li>
                @guest()
                    <li><a href="/login">Login</a></li>
                @endguest
                @auth()
                    <li><a href="/logout">Logout</a></li>
                @endauth
            </ul>
        </div>
        <div class="span4">
            <h4>My Account</h4>
            <ul class="nav">
                <li><a href="#">My Account</a></li>
                <li><a href="#">Order History</a></li>
                <li><a href="#">Wish List</a></li>
                <li><a href="#">Newsletter</a></li>
            </ul>
        </div>
        <div class="span5">
            <p class="logo"><img src="/template/themes/images/logo.png" class="site_logo" alt=""></p>
            <p>"Stay stylish with our latest fashion trends and make a statement wherever you go."
                "Experience exceptional customer service and hassle-free shopping with our dedicated support team."</p>
            <br/>
            <span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
        </div>
    </div>
</section>
<section id="copyright">
    <span>All rights reserved. @ HUY HUNG 2023</span>
</section>
<script src="/template/themes/js/common.js"></script>
<script src="/template/themes/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
    $(function() {
        $(document).ready(function() {
            $('.flexslider').flexslider({
                animation: "fade",
                slideshowSpeed: 4000,
                animationSpeed: 600,
                controlNav: false,
                directionNav: true,
                controlsContainer: ".flex-container" // the container that holds the flexslider
            });
        });
    });
</script>
