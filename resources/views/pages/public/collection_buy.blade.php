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
            <div class="row my-3">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
                	<h2>Order Form</h2>
                    <p>Please fill out the order form below to complete your purchase. Ensure all details are accurate for a smooth transaction process.</p>
                	<div class="formFeilds contact-form form-vertical">
                    <form method="POST" action="{{ route('buy.submit') }}" enctype="multipart/form-data" id="order_form" class="contact-form">
                        @csrf
                      <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        	<div class="form-group">
                                <input type="text" id="Name" name="Name" placeholder="Name" value="{{ old('Name') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        	<div class="form-group">
                                <input type="email" id="Email" name="Email" placeholder="Email" value="{{ old('Email') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="phone" id="Phone" name="Phone" placeholder="Phone Number" value="{{ old('Phone') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text" id="Address" name="Address" placeholder="Address" value="{{ old('Address') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="number" min="1" max="{{ $DetailProduct->stock_products }}" id="Quantity" name="Quantity" placeholder="Quantity" value="{{ old('Quantity') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text" id="Method" name="Method" placeholder="Payment Method" value="{{ old('Method') }}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <input type="text" id="Notes" name="Notes" placeholder="Notes" value="{{ old('Notes') }}">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="Total">Total Payment</label>
                                <input name="Total" value="" id="Total" readonly style="cursor: not-allowed">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="hidden" name="Product" value="{{ $DetailProduct->code_products }}">
                            <button type="submit" class="btn" style="background-color: #35A5B1; color: white;" id="sendOrderButton">Order Now</button>
                        </div>
                     </div>
                     </form>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <h2>Product Detail</h2>
                	<hr/>
                    <img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/Product/{{ $DetailProduct->image_p_products }}" src="{{ url('') }}/assets1/img/Product/{{ $DetailProduct->image_p_products }}" alt="Buy Now" style="max-height: 35vh"/>
                    <br class="d-sm-none">
                    <br class="d-sm-none">
                    <img class="blur-up lazyload" data-src="{{ url('') }}/assets1/img/Product/{{ $DetailProduct->image_s_products }}" src="{{ url('') }}/assets1/img/Product/{{ $DetailProduct->image_s_products }}" alt="Buy Now" style="max-height: 35vh"/>
                    <div class="open-hours mt-2">
                    	<strong>{{ $DetailProduct->name_products }} | {{ $DetailProduct->code_products }}</strong>
						<p>Rp {{ number_format($DetailProduct->price_products, 0, ',', '.') }}</p>
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
<script>
    let productPrice = 0;
    document.getElementById('Quantity').addEventListener('input', function() {
        const productCode = '{{ $DetailProduct->code_products }}';
        if (productCode) {
            fetch(`/get-product-price/${productCode}`)
                .then(response => response.json())
                .then(data => {
                    productPrice = data.price;
                    updateTotal();
                });
        } else {
            productPrice = 0;
            updateTotal();
        }
        updateTotal();
    });

    function updateTotal() {
        const quantity = document.getElementById('Quantity').value;
        const total = productPrice * quantity;
        document.getElementById('Total').value = formatCurrency(total) || 0;
    }

    function formatCurrency(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function removeDotsFromTotal() {
        const totalInput = document.getElementById('Total');
        totalInput.value = totalInput.value.replace(/\./g, '');
    }

    document.getElementById('sendOrderButton').addEventListener('click', function(e) {
        e.preventDefault();
        var form = document.getElementById('order_form');
        if (form.checkValidity()) {
            Swal.fire({
                title: 'Confirmation',
                text: "Are you sure your order details are correct? Once submitted, your order cannot be changed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#35A5B1',
                cancelButtonColor: '#AAA',
                confirmButtonText: 'Yes, Order!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    removeDotsFromTotal();
                    form.submit();
                }
            });
        } else {
            form.reportValidity();
        }
    });
</script>
@endsection

<body class="template-index home2-default">
@yield('content')
</body>
</html>
