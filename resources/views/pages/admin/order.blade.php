<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<style>
.status-pending {
    color: #FF8C00;
}
.status-processing {
    color: #007BFF;
}
.status-shipped {
    color: #6A5ACD;
}
.status-delivered {
    color: #228B22;
}
.status-canceled {
    color: #DC143C;
}
.payment-pending {
    color: #FFA500;
}
.payment-paid {
    color: #32CD32;
}
.payment-failed {
    color: #FF4500;
}
.payment-refunded {
    color: #8B0000;
}
@media (max-width: 768px) {
    .page-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .breadcrumbs {
        padding-left: 0 !important;
        margin-left: 0 !important;
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
                    <ul class="breadcrumbs">
                        <a href="{{ route('order.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #35A5B1">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Orders
                        </a>
                    </ul>
                </div>
                <div class="row">
                    @foreach ($DataO as $O)
                    <div class="col-md-3 pl-md-0">
                        <div class="card card-pricing">
                            <div class="card-header p-0">
                                <h4 class="card-title fw-bold
                                    @if($O->status_orders == 'Pending') status-pending
                                    @elseif($O->status_orders == 'Processing') status-processing
                                    @elseif($O->status_orders == 'Shipped') status-shipped
                                    @elseif($O->status_orders == 'Delivered') status-delivered
                                    @elseif($O->status_orders == 'Canceled') status-canceled
                                    @endif">
                                    @if($O->status_orders == 'Pending')
                                        <i class="fas fa-clock"></i>
                                    @elseif($O->status_orders == 'Processing')
                                        <i class="fas fa-box-open"></i>
                                    @elseif($O->status_orders == 'Shipped')
                                        <i class="fas fa-shipping-fast"></i>
                                    @elseif($O->status_orders == 'Delivered')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($O->status_orders == 'Canceled')
                                        <i class="fas fa-times-circle"></i>
                                    @endif
                                    {{ $O->status_orders }}
                                </h4>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="specification-list">
                                    <li>
                                        <span class="name-specification">Order</span>
                                        <span class="status-specification fw-bold">{{ $O->order_number }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Name</span>
                                        <span class="status-specification fw-bold">{{ $O->name_orders }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Phone</span>
                                        <span class="status-specification fw-bold">{{ $O->phone_orders }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Product</span>
                                        <span class="status-specification fw-bold">{{ $O->name_products }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Quantity</span>
                                        <span class="status-specification fw-bold">{{ $O->qty_orders }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Total</span>
                                        <span class="status-specification fw-bold">Rp {{ number_format($O->total_orders, 0, ',', '.') }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Notes</span>
                                        <span class="status-specification fw-bold">{{ $O->notes }}</span>
                                    </li>
                                    <li>
                                        <span class="name-specification">Payment</span>
                                        <span class="status-specification fw-bold
                                        @if($O->payment_status == 'Pending') payment-pending
                                        @elseif($O->payment_status == 'Paid') payment-paid
                                        @elseif($O->payment_status == 'Failed') payment-failed
                                        @elseif($O->payment_status == 'Refunded') payment-refunded
                                        @endif">{{ $O->payment_status }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer pt-0">
                                <a href="{{ route('order.detail', $O->order_number) }}" class="btn btn-primary btn-block"><b>Detail</b></a>
                                <a href="{{ route('order.edit', $O->order_number) }}" class="btn btn-warning btn-block"><b>Edit</b></a>
                                @if (Auth::user()->level == 'Super Admin')
                                    <a href="{{ route('order.delete', $O->order_number) }}" class="but-delete btn btn-danger btn-block"><b>Delete</b></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#{{ $O->order_number }}">
                                        <b>History</b>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ $O->order_number }}" tabindex="-1" role="dialog" aria-labelledby="{{ $O->order_number }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="{{ $O->order_number }}Label"><b>Activity History</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="text-align: start">
                                                    <p>Created : <br>{{ $O->created_by }} <b>({{ $O->created_at }})</b></p>
                                                    <p>Last Modified : <br>{{ $O->modified_by }} <b>({{ $O->updated_at }})</b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.script')
<script>
    $(document).on('click','.but-delete',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "This data will be Permanently Deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'DELETE',
            cancelButtonText: 'CANCEL'
            }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        });
    });

    //message with sweetalert
    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @endif
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
