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

        <?php if ($cHS > 0) : ?>
    	<!--Home slider-->
    	<div class="slideshow slideshow-wrapper pb-section">
        	<div class="home-slideshow">
                @foreach ($HomeSlider as $H)
            	<div class="slide">
                	<div class="blur-up lazyload">
                        <img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/HomeSlider/{{ $H->image_home_sliders }}" src="{{ url('') }}/assets1/img/HomeSlider/{{ $H->image_home_sliders }}" alt="Shop Our New Collection" title="Shop Our New Collection" />
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!--End Home slider-->
        <?php endif;?>
        <?php if ($cP > 0) : ?>
        <!--New Arrival Product-->
        <div class="product-rows section pt-0">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        				<div class="section-header text-center">
                            <h2 class="h2">New Arrivals</h2>
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
                            </div>
                            <!-- End product details -->
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                    	<div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        	<a href="{{ route('collection.publik') }}" style="background-color: #35A5B1" class="btn">View All</a>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!--End New Arrival Product-->
        <?php endif;?>

        <?php if ($cC > 0) : ?>
        <!--Testimonial Slider-->
        <div class="section testimonial-slider pt-0 pb-0" style="background-color: #e3e3e3">
        	<div class="container-fluid">
                <div class="quote-wraper" style="background-color: #e3e3e3">
                    <!--Testimonial Slider Title-->
                    <div class="section-header text-center">
                        <h2 class="h2">What They're Saying</h2>
                    </div>
                    <!--End Testimonial Slider Title-->
                    <!--Testimonial Slider Items-->
                    <div class="quotes-slider">
                        @foreach ($Comment as $C)
                    	<div class="quotes-slide">
                            <blockquote class="quotes-slider__text text-center">
                              <div class="rte-setting"><p><?= $C['content_comments']; ?></p></div>
                              <p class="authour">{{ $C->author_comments }}</span></p>
                            </blockquote>
                        </div>
                        @endforeach
                    </div>
                    <!--Testimonial Slider Items-->
                </div>
            </div>
        </div>
        <!--End Testimonial Slider-->
        <?php endif;?>

        <?php if ($cB > 0) : ?>
        <!--Latest Blog-->
        <div class="latest-blog section">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        				<div class="section-header text-center">
      						<h2 class="h2">Latest From our Blog</h2>
					    </div>
            		</div>
                </div>
            	<div class="row mt-2">
                    @foreach ($Blog as $B)
                	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    	<div class="wrap-blog">
                        	<a href="{{ route('blog.detail', $B->id_detail) }}" class="article__grid-image">
              					<img src="{{ url('') }}/assets1/img/Blog/{{ $B->thumbnail_blog }}" alt="{{ $B->title_blog }}" title="{{ $B->title_blog }}" class="blur-up lazyloaded"/>
				            </a>
                            <div class="article__grid-meta article__grid-meta--has-image">
                                <div class="wrap-blog-inner">
                                    <h2 class="h3 article__title">
                                      <a href="{{ route('blog.detail', $B->id_detail) }}">{{ $B->title_blog }}</a>
                                    </h2>
                                    <span class="article__date">{{ $B->created_at->format('F d, Y') }}</span>
                                    <div class="rte article__grid-excerpt">
                                        {!! Str::limit(strip_tags($B->content_blog, '<b><i><u><strong><em>'), 135, '...') !!}
                                    </div>
                                    <ul class="list--inline article__meta-buttons">
                                    	<li><a href="{{ route('blog.detail', $B->id_detail) }}">Read more</a></li>
                                    </ul>
                                </div>
							</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center mt-4">
                        <a href="{{ route('blog.publik') }}" style="background-color: #35A5B1" class="btn">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <!--End Latest Blog-->
        <?php endif;?>

        <!--Store Feature-->
        <div class="store-feature section" style="background-color: #e3e3e3">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    	<ul class="display-table store-info">
                        	<li class="display-table-cell">
                                <i class="icon anm anm-check-badge"></i>
                                <h5>Best Quality Materials</h5>
                                <span class="sub-text">Crafted from the finest fabrics for exceptional comfort</span>
                            </li>
                            <li class="display-table-cell">
                                <i class="icon anm anm-star"></i>
                                <h5>High Grade Craftsmanship</h5>
                                <span class="sub-text">Expertly designed to meet the highest standards</span>
                            </li>
                            <li class="display-table-cell">
                                <i class="icon anm anm-tag"></i>
                                <h5>Affordable Pricing</h5>
                                <span class="sub-text">Great value without compromising on quality</span>
                            </li>
                            <li class="display-table-cell">
                                <i class="icon anm anm-truck"></i>
                                <h5>Fast & Reliable Shipping</h5>
                                <span class="sub-text">Swift delivery with dependable service</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--End Store Feature-->
    </div>
    @include('layouts.public.footer')
    @include('layouts.public.script')
</div>
@endsection

<body class="template-index home2-default">
    @yield('content')
</body>
</html>
