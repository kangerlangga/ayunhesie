<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<style>
@media (max-width: 768px) {
    .page-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
}
</style>
<div class="wrapper">
    <div class="main-header">
        @include('layouts.admin.nav')
    </div>
    @include('layouts.admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">{{ $judul }}</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="POST" action="#" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Name">Name Customer</label>
                                            <input class="form-control" name="Name" value="{{ $DetailOrder->name_orders }}" id="Name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input class="form-control" name="Email" value="{{ $DetailOrder->email_orders }}" id="Email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Phone">Phone Number</label>
                                            <input class="form-control" name="Phone" value="{{ $DetailOrder->phone_orders }}" id="Phone" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Address">Address</label>
                                            <input class="form-control" name="Address" value="{{ $DetailOrder->shipping_address }}" id="Address" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Product">Product</label>
                                            <input class="form-control" name="Product" value="{{ $DetailProduk->name_products }} ({{ $DetailProduk->code_products }})" id="Product" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Quantity">Quantity Product</label>
                                            <input class="form-control" name="Quantity" value="{{ $DetailOrder->qty_orders }}" id="Quantity" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Total">Total Payment</label>
                                            <input class="form-control" name="Total" value="Rp {{ number_format($DetailOrder->total_orders, 0, ',', '.') }}" id="Total" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="OrderStatus">Order Status</label>
                                            <input class="form-control" name="OrderStatus" value="{{ $DetailOrder->status_orders }}" id="OrderStatus" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Method">Payment Method</label>
                                            <input class="form-control" name="Method" value="{{ $DetailOrder->payment_method }}" id="Method" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="PaymentStatus">Payment Status</label>
                                            <input class="form-control" name="PaymentStatus" value="{{ $DetailOrder->payment_status }}" id="PaymentStatus" readonly>
                                        </div>
                                    </div>
                                    @if(!is_null($DetailOrder->proof_of_payment))
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="PaymentReceipt">Payment Receipt</label>
                                            <br>
                                            <a href="{{ asset('assets1/img/Payment/' . $DetailOrder->proof_of_payment) }}" class="btn btn-primary fw-bold" download>
                                                <i class="fas fa-download mr-2"></i> Download Receipt
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Tracking">Tracking Number</label>
                                            <input class="form-control" name="Tracking" value="{{ $DetailOrder->tracking_number }}" id="Tracking" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Notes">Notes</label>
                                            <input class="form-control" name="Notes" value="{{ $DetailOrder->notes }}" id="Notes" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <a href="{{ route('order.data') }}" class="btn btn-warning fw-bold text-uppercase">
                                                <i class="fas fa-chevron-circle-left mr-2"></i>Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.script')
@endsection

<body>
    @yield('content')
</body>
</html>
