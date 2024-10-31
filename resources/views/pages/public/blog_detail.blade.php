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
        <div class="container">
            <div class="row mt-3">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                    <div class="text-center mb-4">
                        <h2 class="h2">{{ $DetailBlog->title_blog }}</h2>
                    </div>
                </div>
            </div>
            <div class="row text-center mb-4">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                    <img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/Blog/{{ $DetailBlog->thumbnail_blog }}" src="{{ url('') }}/assets1/img/Blog/{{ $DetailBlog->thumbnail_blog }}" alt="About Us" style="max-height: 70vh"/>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-5" style="text-align: justify">
                    <?= $DetailBlog['content_blog']; ?>
                </div>
            </div>
        </div>
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
