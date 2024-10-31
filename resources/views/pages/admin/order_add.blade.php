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
                            <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data" id="order_add">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Name') has-error has-feedback @enderror">
                                            <label for="Name">Name Customer</label>
                                            <input type="text" id="Name" name="Name" value="{{ old('Name') }}" class="form-control" required>
                                            @error('Name')
                                            <small id="Name" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Email') has-error has-feedback @enderror">
                                            <label for="Email">Email</label>
                                            <input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" required>
                                            @error('Email')
                                            <small id="Email" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Phone') has-error has-feedback @enderror">
                                            <label for="Phone">Phone Number</label>
                                            <input type="tel" id="Phone" name="Phone" value="{{ old('Phone') }}" class="form-control" required>
                                            @error('Phone')
                                            <small id="Phone" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Address') has-error has-feedback @enderror">
                                            <label for="Address">Address</label>
                                            <input type="text" id="Address" name="Address" value="{{ old('Address') }}" class="form-control" required>
                                            @error('Address')
                                            <small id="Address" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Product') has-error has-feedback @enderror">
                                            <label for="Product">Product</label>
                                            <select class="form-control" id="Product" name="Product">
                                                <option name='Product' value="">Select Product</option>
                                                @foreach($ListP as $P)
                                                <option name='Product' value='{{ $P->code_products }}'>{{ $P->name_products }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Quantity') has-error has-feedback @enderror">
                                            <label for="Quantity">Quantity Product</label>
                                            <input type="number" id="Quantity" name="Quantity" min="1" value="{{ old('Quantity') }}" class="form-control" required>
                                            @error('Quantity')
                                            <small id="Quantity" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Total">Total Payment</label>
                                            <input class="form-control" name="Total" value="" id="Total" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="OrderStatus">Order Status</label>
                                            <select class="form-control" id="OrderStatus" name="OrderStatus">
                                                <option name='OrderStatus' value='Pending'>Pending</option>
                                                <option name='OrderStatus' value='Processing'>Processing</option>
                                                <option name='OrderStatus' value='Shipped'>Shipped</option>
                                                <option name='OrderStatus' value='Delivered'>Delivered</option>
                                                <option name='OrderStatus' value='Cancelled'>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Method') has-error has-feedback @enderror">
                                            <label for="Method">Payment Method [Optional]</label>
                                            <input type="text" id="Method" name="Method" value="{{ old('Method') }}" class="form-control">
                                            @error('Method')
                                            <small id="Method" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="PaymentStatus">Payment Status</label>
                                            <select class="form-control" id="PaymentStatus" name="PaymentStatus">
                                                <option name='PaymentStatus' value='Pending'>Pending</option>
                                                <option name='PaymentStatus' value='Paid'>Paid</option>
                                                <option name='PaymentStatus' value='Failed'>Failed</option>
                                                <option name='PaymentStatus' value='Refunded'>Refunded</option>
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
                                            <input type="text" id="Tracking" name="Tracking" value="{{ old('Tracking') }}" class="form-control">
                                            @error('Tracking')
                                            <small id="Tracking" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Notes') has-error has-feedback @enderror">
                                            <label for="Notes">Notes [Optional]</label>
                                            <input type="text" id="Notes" name="Notes" value="{{ old('Notes') }}" class="form-control">
                                            @error('Notes')
                                            <small id="Notes" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary fw-bold text-uppercase" id="sendAddButton">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <button type="reset" class="btn btn-warning fw-bold text-uppercase">
                                                <i class="fas fa-undo mr-2"></i>Reset
                                            </button>
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
<script>
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

    let productPrice = 0;
    let productStock = 0;

    document.getElementById('Product').addEventListener('change', function() {
        const productCode = this.value;

        if (productCode) {
            fetch(`/get-product-price/${productCode}`)
                .then(response => response.json())
                .then(data => {
                    productPrice = data.price;
                    productStock = data.stock;
                    updateTotal();
                    updateStock();
                });
        } else {
            productPrice = 0;
            productStock = 0;
            updateTotal();
            updateStock();
        }
    });

    document.getElementById('Quantity').addEventListener('input', function() {
        updateTotal();
    });

    function updateTotal() {
        const quantity = document.getElementById('Quantity').value;
        const total = productPrice * quantity;

        document.getElementById('Total').value = formatCurrency(total) || 0;
    }

    function updateStock() {
        const stock = productStock;
        document.getElementById('Quantity').setAttribute('max', stock);
    }

    function formatCurrency(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function removeDotsFromTotal() {
        const totalInput = document.getElementById('Total');
        totalInput.value = totalInput.value.replace(/\./g, '');
    }

    document.querySelector('form').addEventListener('submit', function(e) {
        var productSelect = document.getElementById('Product');
        if (productSelect.value === "") {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please select a product before submitting!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#35A5B1',
            });
        } else {
            if (this.checkValidity()) {
                e.preventDefault();
                Swal.fire({
                    title: 'Confirmation',
                    text: "Are you sure all the details are correct?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#35A5B1',
                    cancelButtonColor: '#AAA',
                    confirmButtonText: 'Yes, Save!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        removeDotsFromTotal();
                        this.submit();
                    }
                });
            } else {
                this.reportValidity();
            }
        }
    });
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
