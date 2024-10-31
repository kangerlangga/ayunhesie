<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.public.head')
</head>
@section('content')
<div id="preloader"></div>
<style>
#preloader {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 9999;
  overflow: hidden;
  background: #fff;
}
#preloader:before {
  content: "";
  position: fixed;
  top: calc(50% - 30px);
  left: calc(50% - 30px);
  border: 6px solid #35A5B1;
  border-top-color: #e7e4fe;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: animate-preloader 1s linear infinite;
}
@keyframes animate-preloader {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<div class="pageWrapper">
    @include('layouts.public.nav')
    <!--Body Content-->
    <div id="page-content">
        <?php if ($cP > 0) : ?>
        <!--Our Collection Product-->
        <div class="product-rows section pt-3">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        				<div class="section-header text-center">
                            <h2 class="h2">Our Collections</h2>
                            <p>Grab these new items before they are gone!</p>
                        </div>
            		</div>
                </div>
	            <div class="grid-products">
                	<div class="row">
                    	@foreach ($Product as $P)
                    	<div class="col-6 col-sm-2 col-md-3 col-lg-3 item">
                            <div class="product-image">
                                <!--start product image -->
                                <a href="#" class="grid-view-item__link">
                                    <!-- image -->
                                    <img class="primary blur-up lazyload" data-src="{{ url('') }}/assets1/img/Product/{{ $P->image_p_products }}" src="{{ url('') }}/assets1/img/Product/{{ $P->image_p_products }}" alt="{{ $P->name_products }}"/>
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="hover blur-up lazyload" data-src="{{ url('') }}/assets1/img/Product/{{ $P->image_s_products }}" src="{{ url('') }}/assets1/img/Product/{{ $P->image_s_products }}" alt="{{ $P->name_products }}"/>
                                    <!-- End hover image -->
                                </a>
                                <!-- end product image -->
                            </div>
                            <!--End start product image -->

                            <!--start product details -->
                            <div class="product-details text-center">
                                <!-- product name -->
                                <div class="product-name text-uppercase">
                                    <a href="#">{{ $P->code_products }} | {{ $P->name_products }}</a>
                                </div>
                                <!-- End product name -->
                                <!-- product price -->
                                <div class="product-price">
                                    <span class="price">Rp {{ number_format($P->price_products, 0, ',', '.') }}</span>
                                </div>
                                <!-- End product price -->
                                <a href="{{ route('collection.buy',$P->code_products) }}" class="btn" style="background-color: #35A5B1">Buy Now</a>
                            </div>
                            <!-- End product details -->
                        </div>
                        @endforeach
                    </div>
                </div>
           </div>
        </div>
        <!--End Our Collection Product-->
        <?php endif;?>
    </div>
    <!--End Body Content-->
</div>
@include('layouts.public.footer')
@include('layouts.public.script')
</div>
<script>
    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "{{ session('success') }}",
        text: "Order Number : {{ session('id') }} \nPlease save this Order Number to check your order status!",
        showConfirmButton: true,
        confirmButtonColor: '#35A5B1',
        confirmButtonText: 'OK'
    });
    @elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @endif
</script>
@endsection

<body class="template-index home2-default">
@yield('content')
</body>
</html>
