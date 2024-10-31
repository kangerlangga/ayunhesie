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
                            <form method="POST" action="{{ route('order.update', $EditOrder->id_orders) }}" enctype="multipart/form-data" id="order_edit">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Name') has-error has-feedback @enderror">
                                            <label for="Name">Name Customer</label>
                                            <input type="text" id="Name" name="Name" value="{{ old('Name', $EditOrder->name_orders) }}" class="form-control" required>
                                            @error('Name')
                                            <small id="Name" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Email') has-error has-feedback @enderror">
                                            <label for="Email">Email</label>
                                            <input type="email" id="Email" name="Email" value="{{ old('Email', $EditOrder->email_orders) }}" class="form-control" required>
                                            @error('Email')
                                            <small id="Email" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Phone') has-error has-feedback @enderror">
                                            <label for="Phone">Phone Number</label>
                                            <input type="tel" id="Phone" name="Phone" value="{{ old('Phone', $EditOrder->phone_orders) }}" class="form-control" required>
                                            @error('Phone')
                                            <small id="Phone" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Address') has-error has-feedback @enderror">
                                            <label for="Address">Address</label>
                                            <input type="text" id="Address" name="Address" value="{{ old('Address', $EditOrder->shipping_address) }}" class="form-control" required>
                                            @error('Address')
                                            <small id="Address" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Product">Product</label>
                                            <input class="form-control" name="Product" value="{{ $DetailProduk->name_products }} ({{ $DetailProduk->code_products }})" id="Product" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Quantity">Quantity Product</label>
                                            <input class="form-control" name="Quantity" value="{{ $EditOrder->qty_orders }}" id="Quantity" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Total">Total Payment</label>
                                            <input class="form-control" name="Total" value="Rp {{ number_format($EditOrder->total_orders, 0, ',', '.') }}" id="Total" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="OrderStatus">Order Status</label>
                                            <select class="form-control" id="OrderStatus" name="OrderStatus">
                                                @if($EditOrder->status_orders == 'Pending')
                                                    <option value='Pending' selected>Pending</option>
                                                    <option value='Processing'>Processing</option>
                                                    <option value='Shipped'>Shipped</option>
                                                    <option value='Delivered'>Delivered</option>
                                                    <option value='Cancelled'>Cancelled</option>
                                                @elseif($EditOrder->status_orders == 'Processing')
                                                    <option value='Processing' selected>Processing</option>
                                                    <option value='Shipped'>Shipped</option>
                                                    <option value='Delivered'>Delivered</option>
                                                @elseif($EditOrder->status_orders == 'Shipped')
                                                    <option value='Shipped' selected>Shipped</option>
                                                    <option value='Delivered'>Delivered</option>
                                                @elseif($EditOrder->status_orders == 'Delivered')
                                                    <option value='Delivered' selected>Delivered</option>
                                                @elseif($EditOrder->status_orders == 'Cancelled')
                                                    <option value='Cancelled' selected>Cancelled</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Method') has-error has-feedback @enderror">
                                            <label for="Method">Payment Method [Optional]</label>
                                            <input type="text" id="Method" name="Method" value="{{ old('Method', $EditOrder->payment_method) }}" class="form-control">
                                            @error('Method')
                                            <small id="Method" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="PaymentStatus">Payment Status</label>
                                            <select class="form-control" id="PaymentStatus" name="PaymentStatus">
                                                @if($EditOrder->payment_status == 'Pending')
                                                    <option value='Pending' selected>Pending</option>
                                                    <option value='Paid'>Paid</option>
                                                    <option value='Failed'>Failed</option>
                                                @elseif($EditOrder->payment_status == 'Paid')
                                                    <option value='Paid' selected>Paid</option>
                                                    <option value='Refunded'>Refunded</option>
                                                @elseif($EditOrder->payment_status == 'Failed')
                                                    <option value='Failed' selected>Failed</option>
                                                    <option value='Pending'>Pending</option>
                                                @elseif($EditOrder->payment_status == 'Refunded')
                                                    <option value='Refunded' selected>Refunded</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group @error('ImageP') has-error has-feedback @enderror">
                                            <label for="ImageP">
                                                Payment Receipt (PNG, JPG, JPEG, PDF)
                                                <span class="d-none d-sm-inline"> | </span>
                                                <span class="d-sm-none"><br></span>
                                                <span style="color: red;">Max 3 MB</span>
                                                <span class="d-none d-sm-inline"> | </span>
                                                <span class="d-sm-none"><br></span>
                                                [Optional]
                                            </label>
											<input type="file" class="form-control-file" id="ImageP" name="ImageP" accept=".png, .jpg, .jpeg, .pdf">
                                            @error('ImageP')
                                            <small id="ImageP" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Tracking') has-error has-feedback @enderror">
                                            <label for="Tracking">Tracking Number [Optional]</label>
                                            <input type="text" id="Tracking" name="Tracking" value="{{ old('Tracking', $EditOrder->tracking_number) }}" class="form-control">
                                            @error('Tracking')
                                            <small id="Tracking" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Notes') has-error has-feedback @enderror">
                                            <label for="Notes">Notes [Optional]</label>
                                            <input type="text" id="Notes" name="Notes" value="{{ old('Notes', $EditOrder->notes) }}" class="form-control">
                                            @error('Notes')
                                            <small id="Notes" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase" id="sendEditButton">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('order.data') }}" class="btn btn-warning fw-bold text-uppercase but-back">
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
<script type="text/javascript">
    $(document).on('click','.but-back',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "Changes will not be Saved!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'BACK',
            cancelButtonText: 'CANCEL'
            }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        });
    });

    document.getElementById('sendEditButton').addEventListener('click', function(e) {
        var orderEditForm = document.getElementById('order_edit');
        if (orderEditForm.checkValidity()) {
            e.preventDefault();
            Swal.fire({
                title: 'Confirmation',
                text: "Are you sure all the details are correct?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#35A5B1',
                cancelButtonColor: '#AAA',
                confirmButtonText: 'Yes, Update!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    orderEditForm.submit();
                }
            });
        } else {
            orderEditForm.reportValidity();
        }
    });
</script>
<script>

</script>
@endsection

<body>
    @yield('content')
</body>
</html>
