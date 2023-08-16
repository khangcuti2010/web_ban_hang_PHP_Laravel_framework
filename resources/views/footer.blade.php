<section id="footer-bar">
    <div class="row">
        <div class="span3">
            <h4>Navigation</h4>
            <ul class="nav">
                <li><a href="./">Homepage</a></li>
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
                <li><a href="/order-history">Order History</a></li>
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
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d244.90568438654645!2d106.65447399854042!3d10.850214150974537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529bdc0bfc441%3A0xe676893e9e0aec98!2zMjEvNCBQaOG6oW0gVsSDbiBDaGnDqnUsIFBoxrDhu51uZyA5LCBHw7IgVuG6pXAsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1692190652833!5m2!1sen!2s"
                width="100%" height="200" style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
