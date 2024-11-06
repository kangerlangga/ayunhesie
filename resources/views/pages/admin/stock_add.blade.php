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
                            <form method="POST" action="{{ route('stock.store') }}" enctype="multipart/form-data" id="order_add">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="DateStock">Select Date</label>
                                            <input type="date" class="form-control" id="DateStock" name="DateStock" max="{{ date('Y-m-d') }}" required>
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
                                        <div class="form-group @error('Stock') has-error has-feedback @enderror">
                                            <label for="Stock">Stock Product</label>
                                            <input type="number" id="Stock" name="Stock" min="1" value="{{ old('Stock') }}" class="form-control" required>
                                            @error('Stock')
                                            <small id="Stock" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Type">Stock Type</label>
                                            <input class="form-control" name="Type" value="Original" id="Type" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary fw-bold text-uppercase">
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
    document.querySelector('form').addEventListener('submit', function(e) {
        var productSelect = document.getElementById('Product');
        if (productSelect.value === "") {
            e.preventDefault();
            productSelect.focus();
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
