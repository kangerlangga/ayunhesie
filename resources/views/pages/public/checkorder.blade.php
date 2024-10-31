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
                	<h2>Order Detail</h2>
                    <div id="status_message" class="
                        @if($DetailOrder->status_orders == 'Pending') status-pending
                        @elseif($DetailOrder->status_orders == 'Processing') status-processing
                        @elseif($DetailOrder->status_orders == 'Shipped') status-shipped
                        @elseif($DetailOrder->status_orders == 'Delivered') status-delivered
                        @elseif($DetailOrder->status_orders == 'Canceled') status-canceled
                        @endif">
                        <span class="status-icon">
                            @if($DetailOrder->status_orders == 'Pending')
                                <i class="fas fa-clock"></i>
                            @elseif($DetailOrder->status_orders == 'Processing')
                                <i class="fas fa-box-open"></i>
                            @elseif($DetailOrder->status_orders == 'Shipped')
                                <i class="fas fa-shipping-fast"></i>
                            @elseif($DetailOrder->status_orders == 'Delivered')
                                <i class="fas fa-check-circle"></i>
                            @elseif($DetailOrder->status_orders == 'Canceled')
                                <i class="fas fa-times-circle"></i>
                            @endif
                        </span>
                        {{ $DetailOrder->status_orders }}
                    </div>
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
                                <label for="Email">Email</label>
                                <input type="email" id="Email" name="Email" placeholder="Email" value="{{ $maskedEmail }}" readonly>
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
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="Total">Total Payment</label>
                                <input name="Total" value="Rp {{ number_format($DetailOrder->total_orders, 0, ',', '.') }}" id="Total" readonly style="cursor: not-allowed">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <a href="{{ route('check.receipt', $DetailOrder->order_number) }}" class="btn" style="background-color: #35A5B1; color: white;">Payment Status</a>
                            @if($DetailOrder->payment_status != 'Paid')
                            <a href="{{ route('edit.receipt', $DetailOrder->order_number) }}" class="btn" style="background-color: #35A5B1; color: white;">Upload Receipt</a>
                            @endif
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
@endsection

<body class="template-index home2-default">
@yield('content')
</body>
</html>
