<!--Div where the WhatsApp will be rendered-->
<div id="myDiv"></div>
<script type="text/javascript">
$(function () {
    $('#myDiv').floatingWhatsApp({
    phone: '6282228220233',
    size: '70px',
    // popupMessage: 'Hai, Ada yang bisa saya bantu?',
    // showPopup: false,
    position: "right"
    });
});
</script>

<!--Footer-->
<footer id="footer" class="mt-0">
    {{-- <div class="newsletter-section">
        <div class="container">
            <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-7 w-100 d-flex justify-content-start align-items-center">
                        <div class="display-table">
                            <div class="display-table-cell footer-newsletter">
                                <div class="section-header text-center">
                                    <label class="h2"><span>sign up for </span>newsletter</label>
                                </div>
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <input type="email" class="input-group__field newsletter__input" name="EMAIL" value="" placeholder="Email address" required="">
                                        <span class="input-group__btn">
                                            <button type="submit" class="btn newsletter__submit" name="commit" id="Subscribe"><span class="newsletter__submit-text--large">Subscribe</span></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-5 d-flex justify-content-end align-items-center">
                        <div class="footer-social">
                            <ul class="list--inline site-footer__social-icons social-icons">
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Facebook"><i class="icon icon-facebook"></i></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Twitter"><i class="icon icon-twitter"></i> <span class="icon__fallback-text">Twitter</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Pinterest"><i class="icon icon-pinterest"></i> <span class="icon__fallback-text">Pinterest</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Instagram"><i class="icon icon-instagram"></i> <span class="icon__fallback-text">Instagram</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Tumblr"><i class="icon icon-tumblr-alt"></i> <span class="icon__fallback-text">Tumblr</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on YouTube"><i class="icon icon-youtube"></i> <span class="icon__fallback-text">YouTube</span></a></li>
                                <li><a class="social-icons__link" href="#" target="_blank" title="Belle Multipurpose Bootstrap 4 Template on Vimeo"><i class="icon icon-vimeo-alt"></i> <span class="icon__fallback-text">Vimeo</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div> --}}
    <div class="site-footer" style="background-color: #35A5B1">
        <div class="container">
             <!--Footer Links-->
            <div class="footer-top">
                <div class="row">
                    {{-- <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                        <h4 class="h4">Quick Shop</h4>
                        <ul>
                            <li><a href="#">Women</a></li>
                            <li><a href="#">Men</a></li>
                            <li><a href="#">Kids</a></li>
                            <li><a href="#">Sportswear</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div> --}}
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 footer-links">
                        <h4 class="h4">Menu</h4>
                        <ul>
                            <li><a href="{{ route('home.publik') }}">Home</a></li>
                            <li><a href="{{ route('about.publik') }}">About Us</a></li>
                            <li><a href="{{ route('collection.publik') }}">Collection</a></li>
                            <li><a href="{{ route('blog.publik') }}">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 footer-links">
                        <h4 class="h4">Social Media</h4>
                        <ul>
                            <li><a href="https://instagram.com/ayunhe.id">Instagram</a></li>
                            <li><a href="https://www.tiktok.com/@ayunhe_bintang_indonesia">Tiktok</a></li>
                            <li><a href="#">Whatsapp</a></li>
                            <li><a href="#">Email</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 contact-box">
                        <h4 class="h4">Contact Us</h4>
                        <ul class="addressFooter">
                            <li><i class="icon anm anm-map-marker-al"></i><p>Wisma Tropodo,<br>Jl. Citarum Blok BH No. 21, Waru, Sidoarjo</p></li>
                            <li class="phone"><i class="icon anm anm-phone-s"></i><p>(+62) 822-2822-0233</p></li>
                            <li class="email"><i class="icon anm anm-envelope-l"></i><p>sales@ayunhescarves.com</p></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--End Footer Links-->
            <hr style="border: none; height: 1px; background-color: white;">
            <div class="footer-bottom">
                <div class="row">
                    <!--Footer Copyright-->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 order-1 order-md-0 order-lg-0 order-sm-1 copyright text-sm-center text-md-center text-lg-center"><span></span> <a href="#">© 2024 Ayunhe Official Website</a></div>
                    <!--End Footer Copyright-->
                    <!--Footer Payment Icon-->
                    {{-- <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-0 order-md-1 order-lg-1 order-sm-0 payment-icons text-right text-md-center">
                        <ul class="payment-icons list--inline">
                            <li><i class="icon fa fa-cc-visa" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-mastercard" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-discover" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-paypal" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-cc-amex" aria-hidden="true"></i></li>
                            <li><i class="icon fa fa-credit-card" aria-hidden="true"></i></li>
                        </ul>
                    </div> --}}
                    <!--End Footer Payment Icon-->
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End Footer-->
