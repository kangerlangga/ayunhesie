<!--Promotion Bar-->
<div class="notification-bar mobilehide" style="background-color: #35A5B1">
    <a href="https://instagram.com/ayunhe.id" target="_blank" class="notification-bar__message">We are available on Instagram! Click here for Follow</a>
</div>
<!--End Promotion Bar-->
<!--Search Form Drawer-->
<div class="search">
    <div class="search__form">
        <form class="search-bar__form" action="#">
            <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
            <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
        </form>
        <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
    </div>
</div>
<!--End Search Form Drawer-->
<!--Header-->
<div class="header-wrap animated d-flex border-bottom">
    <div class="container-fluid">
        <div class="row align-items-center">
            <!--Desktop Logo-->
            <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                <a href="{{ route('home.publik') }}">
                    <img src="{{  url('') }}/assets1/logo/logo-nav.png" alt="Ayunhe" title="Ayunhe" height="45"/>
                </a>
            </div>
            <!--End Desktop Logo-->
            <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                <div class="d-block d-lg-none">
                    <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                        <i class="icon anm anm-times-l"></i>
                        <i class="anm anm-bars-r"></i>
                    </button>
                </div>
                <!--Desktop Menu-->
                <nav class="grid__item" id="AccessibleNav"><!-- for mobile -->
                    <ul id="siteNav" class="site-nav medium center hidearrow">
                    <li class="lvl1"><a href="{{ route('home.publik') }}">Home</a></li>
                    <li class="lvl1"><a href="{{ route('about.publik') }}">About Us</a></li>
                    <li class="lvl1"><a href="{{ route('collection.publik') }}">Collection</a></li>
                    <li class="lvl1"><a href="{{ route('blog.publik') }}">Blog</a></li>
                    <li class="lvl1"><a href="{{ route('collection.publik') }}"><b>Buy Now!</b> </a></li>
                  </ul>
                </nav>
                <!--End Desktop Menu-->
            </div>
            <!--Mobile Logo-->
            <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo mt-3">
                <div class="logo"></div>
            </div>
            <!--Mobile Logo-->
            <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                <div class="site-cart">
                    <a href="#" class="site-header__cart" title="Cart">
                        <i class="icon anm anm-bag-l"></i>
                    </a>
                    <!--Minicart Popup-->
                    <div id="header-cart" class="block block-cart">
                        <div class="total pt-3">
                            <div class="form-group">
                                <input type="text" id="orderID" name="orderID" class="form-control" placeholder="Enter your Order Number">
                            </div>
                            <div class="buttonSet text-center d-flex flex-column flex-md-row">
                                <a href="#" id="checkOrderBtn" class="btn btn--small w-100 mb-2 mb-md-0" style="background-color: #35A5B1">Check Order</a>
                                <a href="#" id="checkPaymentBtn" class="btn btn--small w-100" style="background-color: #35A5B1">Check Payment</a>
                            </div>
                        </div>
                    </div>
                    <!--End Minicart Popup-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Header-->

<!--Mobile Menu-->
<div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu"><i class="icon anm anm-times-l pull-right"></i> Close Menu</div>
    <ul id="MobileNav" class="mobile-nav">
        <li class="lvl1"><a href="{{ route('home.publik') }}">Home</a></li>
        <li class="lvl1"><a href="{{ route('about.publik') }}">About Us</a></li>
        <li class="lvl1"><a href="{{ route('collection.publik') }}">Collection</a></li>
        <li class="lvl1"><a href="{{ route('blog.publik') }}">Blog</a></li>
        <li class="lvl1"><a href="{{ route('collection.publik') }}"><b>Buy Now!</b></a></li>
  </ul>
</div>
<!--End Mobile Menu-->

<script>
    document.getElementById('checkOrderBtn').addEventListener('click', function(event) {
        event.preventDefault();
        const orderID = document.getElementById('orderID').value;
        if (orderID) {
            window.location.href = "{{ route('check.order', '') }}/" + orderID;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: 'Please enter your Order Number!',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });

    document.getElementById('checkPaymentBtn').addEventListener('click', function(event) {
        event.preventDefault();
        const orderID = document.getElementById('orderID').value;
        if (orderID) {
            window.location.href = "{{ route('check.receipt', '') }}/" + orderID;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: 'Please enter your Order Number!',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
</script>
