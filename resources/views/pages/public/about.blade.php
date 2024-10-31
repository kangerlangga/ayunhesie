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
                        <h2 class="h2">Ayunhe Scarves</h2>
                        <div class="rte-setting">
                            <p><strong>Produk Berkualitas Harga Pantas</strong></p>
                            <p>Selamat datang di Ayunhe Hijab, platform yang didedikasikan untuk menghadirkan hijab berkualitas tinggi dengan desain yang elegan dan modern, namun tetap menjaga prinsip-prinsip syar’i. Kami percaya bahwa setiap wanita muslimah berhak untuk tampil anggun, percaya diri, dan nyaman dalam balutan hijab yang sesuai dengan gaya hidup mereka.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-4"><img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/About/A1.jpg" src="{{ url('') }}/assets1/img/About/A1.jpg" alt="About Us" /></div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-4"><img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/About/A2.jpg" src="{{ url('') }}/assets1/img/About/A2.jpg" alt="About Us" /></div>
                <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-4"><img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/About/A3.jpg" src="{{ url('') }}/assets1/img/About/A3.jpg" alt="About Us" /></div>
            </div>
            <div class="row">
                <div class="col-12 mb-5" style="text-align: justify">
                    <p>Ayunhe Hijab lahir dari keinginan untuk menyediakan lebih dari sekadar penutup kepala. Kami ingin menciptakan produk yang mampu menginspirasi dan mendukung para wanita muslimah dalam menjalani peran mereka di masyarakat, tanpa melupakan esensi nilai-nilai islami. Dengan semangat ini, kami terus merancang koleksi hijab yang tak hanya modis, tetapi juga memprioritaskan kenyamanan dan fungsi.</p>
                    <p>Dalam perjalanan kami, kami selalu berpegang teguh pada misi kami: memadukan antara fashion yang up-to-date dengan kebutuhan spiritual wanita muslimah masa kini. Kami memahami bahwa hijab adalah ekspresi pribadi yang mencerminkan identitas, keyakinan, dan kecantikan dalam kesederhanaan. Oleh karena itu, setiap produk yang kami hadirkan dirancang dengan penuh perhatian terhadap detail dan kualitas, mulai dari pemilihan bahan, pola, hingga pewarnaan.</p>
                    <p>Kami percaya bahwa hijab lebih dari sekadar fashion item. Di Ayunhe Hijab, kami memiliki komitmen untuk menghadirkan hijab yang tidak hanya indah dilihat, tetapi juga nyaman dikenakan dalam setiap aktivitas. Kami memastikan bahwa setiap produk kami terbuat dari bahan pilihan yang lembut, ringan, dan tetap menjaga privasi, sehingga cocok untuk dikenakan dalam berbagai cuaca dan kesempatan. Koleksi kami dirancang untuk menemani wanita muslimah dalam berbagai momen kehidupan — mulai dari kegiatan sehari-hari, bekerja, hingga acara-acara spesial. Dengan desain yang timeless dan penuh inovasi, kami berharap Ayunhe Hijab dapat menjadi pilihan utama bagi wanita yang ingin tampil anggun dan sederhana tanpa mengabaikan tren fashion masa kini.</p>
                    <p>Misi kami adalah untuk terus berkembang sebagai brand hijab yang menjadi inspirasi bagi para wanita muslimah di Indonesia dan dunia. Kami ingin membantu para muslimah untuk tetap tampil percaya diri dan fashionable, tanpa mengabaikan prinsip-prinsip agama. Ayunhe Hijab akan terus menghadirkan produk-produk hijab berkualitas yang memenuhi kebutuhan gaya hidup modern, namun tetap terikat erat dengan akar tradisi islami.</p>
                    <p>Kami merasa terhormat bisa menjadi bagian dari perjalanan berhijab Anda. Dengan dukungan Anda, kami akan terus tumbuh dan memberikan yang terbaik dalam setiap produk yang kami tawarkan. Terima kasih telah mempercayai Ayunhe Hijab sebagai pilihan hijab Anda.</p>
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
