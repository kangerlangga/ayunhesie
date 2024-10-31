<!DOCTYPE html>
<html lang="en">
<head>
        <!-- PRECONNECT -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        <link rel="dns-prefetch" href="https://unpkg.com">
        <link rel="preconnect" href="https://unpkg.com">
        <link rel="dns-prefetch" href="https://www.w3.org">
        <link rel="preconnect" href="https://www.w3.org">
        <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com">

        <!-- SIMPLE META -->
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="id-ID">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <meta name="google" content="notranslate">
        <meta name="googlebot" content="index,follow">
        <meta name="author" content="Ayunhe">
        <meta name="language" content="id">
        <meta name="geo.country" content="id">
        <meta name="geo.placename" content="Indonesia">
        <meta name="robots" content="all,index,follow">
        <meta NAME="Distribution" CONTENT="Global">
        <meta NAME="Rating" CONTENT="General">

        <!-- WEBSITE META -->
        <title>Page Not Found | Ayunhe Official Website</title>
        <meta name="keywords" content="Ayunhe, Ayunhe Official Website">
        <meta name="description" content="Ayunhe adalah sebuah perusahaan fashion yang berfokus pada produk hijab dan busana muslim.">
        <link rel="icon" type="image/png" href="{{  url('') }}/assets1/logo/logo.png">

        <!-- Plugins CSS -->
        <link rel="stylesheet" href="{{ url('') }}/assets1/css/plugins.css">
        <!-- Bootstap CSS -->
        <link rel="stylesheet" href="{{ url('') }}/assets1/css/bootstrap.min.css">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{ url('') }}/assets1/css/style.css">
        <link rel="stylesheet" href="{{ url('') }}/assets1/css/responsive.css">

        <!-- WAP -->
        <script type="text/javascript" src="{{  url('') }}/assets1/wap/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="{{  url('') }}/assets1/wap/floating-wpp.min.js"></script>
        <link rel="stylesheet" href="{{  url('') }}/assets1/wap/floating-wpp.min.css">
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

@media (min-width: 768px) {
    .hlmerr {
        min-height: 90vh;
    }
    .empty-page-content h1 {
        font-size: 60px;
        text-transform: uppercase;
        font-weight: bold;
    }
}
</style>
<div class="pageWrapper">
    @include('layouts.public.nav')
    <!--Body Content-->
    <div id="page-content">
        <div class="container hlmerr">
        	<div class="row">
            	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
        			<div class="empty-page-content text-center" style="">
                        <h1>404 Page Not Found</h1>
                        <p>The page you requested does not exist.</p>
                        <p><a href="{{ route('home.publik') }}" class="btn btn--has-icon-after" style="background-color: #35A5B1">Continue shopping <i class="fa fa-caret-right" aria-hidden="true"></i></a></p>
                    </div>
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
