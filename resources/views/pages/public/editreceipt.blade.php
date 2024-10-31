<?php
function maskData($data, $showLast = false) {
    $data = (string) $data;
    $length = strlen($data);
    if ($showLast && $length > 5) {
        $firstThree = substr($data, 0, 3);
        $lastTwo = substr($data, -2);
        return $firstThree . str_repeat('*', $length - 5) . $lastTwo;
    }
    if ($length > 3) {
        $firstThree = substr($data, 0, 3);
        return $firstThree . str_repeat('*', $length - 3);
    }
    return $data;
}
$maskedName = maskData($DetailOrder->name_orders);
$maskedEmail = maskData($DetailOrder->email_orders, true);
$maskedPhone = maskData($DetailOrder->phone_orders, true);
$maskedAddress = maskData($DetailOrder->shipping_address);
$maskedQuantity = maskData($DetailOrder->qty_orders);
$maskedMethod = maskData($DetailOrder->payment_method);
$maskedNotes = maskData($DetailOrder->notes);
?>
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
.status-pending {
    color: #FF8C00;
    border-color: #FF8C00;
}
.status-processing {
    color: #007BFF;
    border-color: #007BFF;
}
.status-shipped {
    color: #6A5ACD;
    border-color: #6A5ACD;
}
.status-delivered {
    color: #228B22;
    border-color: #228B22;
}
.status-canceled {
    color: #DC143C;
    border-color: #DC143C;
}
#status_message {
    font-size: 17px;
    font-weight: 500;
    text-align: center;
    padding: 5px 9px;
    margin-bottom: 15px;
    border: 1px dashed;
}
.status-icon {
    margin-right: 5px;
    font-size: 20px;
    vertical-align: middle;
}
.status-pending .status-icon {
    color: #FF8C00;
}
.status-processing .status-icon {
    color: #007BFF;
}
.status-shipped .status-icon {
    color: #6A5ACD;
}
.status-delivered .status-icon {
    color: #228B22;
}
.status-canceled .status-icon {
    color: #DC143C;
}
</style>
<div class="pageWrapper">
    @include('layouts.public.nav')
    <!--Body Content-->
    <div id="page-content">
        <div class="container">
            <div class="row my-3">
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
                	<h2>Payment Receipt</h2>
                    <p>Please upload your payment receipt below to confirm your order. Ensure the file is clear and all information is accurate to avoid any delays in processing.</p>
                	<div class="formFeilds contact-form form-vertical">
                    <form method="POST" action="{{ route('update.receipt', $DetailOrder->order_number) }}" enctype="multipart/form-data" id="receipt_form" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" id="Email" name="Email" placeholder="Input your Email" value="{{ old('Email') }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Total">Total Payment</label>
                                    <input name="Total" value="Rp {{ number_format($DetailOrder->total_orders, 0, ',', '.') }}" id="Total" readonly style="cursor: not-allowed">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ImageP">
                                        Payment Receipt (PNG, JPG, JPEG, PDF)
                                        <span class="d-none d-sm-inline"> | </span>
                                        <span class="d-sm-none"><br></span>
                                        <span style="color: red;">Max 3 MB</span>
                                    </label>
                                    <input type="file" id="ImageP" name="ImageP" accept=".png, .jpg, .jpeg, .pdf" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn" style="background-color: #35A5B1; color: white;" id="sendReceiptButton">Send Receipt</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <hr/>
                    <h2>Detail Order</h2>
                    <p>Please review the order details below. For privacy, only the first three characters of sensitive information are shown. Ensure all details are correct for a smooth and secure transaction process.</p>
                	<div class="formFeilds contact-form form-vertical">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Name">Name</label>
                                    <input type="text" id="Name" name="Name" placeholder="Name" value="{{ $maskedName }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Phone">Phone</label>
                                    <input type="text" id="Phone" name="Phone" placeholder="Phone Number" value="{{ $maskedPhone }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <input type="text" id="Address" name="Address" placeholder="Address" value="{{ $maskedAddress }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Quantity">Quantity</label>
                                    <input type="number" id="Quantity" name="Quantity" placeholder="Quantity" value="{{ $maskedQuantity }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Method">Payment Method</label>
                                    <input type="text" id="Method" name="Method" placeholder="Payment Method" value="{{ $maskedMethod }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="Notes">Notes</label>
                                    <input type="text" id="Notes" name="Notes" placeholder="Notes" value="{{ $maskedNotes }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('check.receipt', $DetailOrder->order_number) }}" class="btn" style="background-color: #35A5B1; color: white;">Payment Status</a>
                                <a href="{{ route('check.order', $DetailOrder->order_number) }}" class="btn" style="background-color: #35A5B1; color: white;">Order Status</a>
                            </div>
                        </div>
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
    document.getElementById('sendReceiptButton').addEventListener('click', function(e) {
        e.preventDefault();

        var form = document.getElementById('receipt_form');
        if (form.checkValidity()) {
            Swal.fire({
                title: 'Confirmation',
                text: "Are you sure your receipt details are correct?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#35A5B1',
                cancelButtonColor: '#AAA',
                confirmButtonText: 'Yes, Send Receipt!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
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
