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
        <?php if ($cB > 0) : ?>
        <!--Latest Blog-->
        <div class="latest-blog section pt-3 mb-5">
        	<div class="container">
            	<div class="row">
                	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        				<div class="section-header text-center">
                            <h2 class="h2">Lifestyle Blog</h2>
                            <p>Stay ahead of the curve with these latest finds before everyone else catches on!</p>
                        </div>
            		</div>
                </div>
            	<div class="row">
                	@foreach ($Blog as $B)
                	<div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
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
            </div>
        </div>
        <!--End Latest Blog-->
        <?php endif;?>
    </div>
    <!--End Body Content-->
</div>
@include('layouts.public.footer')
@include('layouts.public.script')
</div>
@endsection

<body class="template-index home2-default">
@yield('content')
</body>
</html>
