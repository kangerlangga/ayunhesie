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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="POST" action="{{ route('product.update', $EditProduct->id_products) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @error('ImageP') has-error has-feedback @enderror">
                                            <label for="ImageP">
                                                Main Product Image (PNG, JPG, JPEG)
                                                <span class="d-sm-none"><br></span>
                                                <span style="color: red;">Max 3 MB</span>
                                                <span class="d-none d-sm-inline"> | </span>
                                                <span class="d-sm-none"><br></span>
                                                Standard Size 360px x 540px
                                            </label>
											<input type="file" class="form-control-file" id="ImageP" name="ImageP" accept=".png, .jpg, .jpeg">
                                            @error('ImageP')
                                            <small id="ImageP" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group @error('ImageS') has-error has-feedback @enderror">
                                            <label for="ImageS">
                                                Secondary Product Image (PNG, JPG, JPEG)
                                                <span class="d-sm-none"><br></span>
                                                <span style="color: red;">Max 3 MB</span>
                                                <span class="d-none d-sm-inline"> | </span>
                                                <span class="d-sm-none"><br></span>
                                                Standard Size 360px x 540px
                                            </label>
											<input type="file" class="form-control-file" id="ImageS" name="ImageS" accept=".png, .jpg, .jpeg">
                                            @error('ImageS')
                                            <small id="ImageS" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Name') has-error has-feedback @enderror">
                                            <label for="Name">Name Product</label>
                                            <input type="text" id="Name" name="Name" value="{{ old('Name', $EditProduct->name_products) }}" class="form-control" required>
                                            @error('Name')
                                            <small id="Name" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Code">Code Product</label>
                                            <input class="form-control" name="Code" value="{{ $EditProduct->code_products }}" id="Code" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Price') has-error has-feedback @enderror">
                                            <label for="Price">Price Product</label>
                                            <input type="number" id="Price" name="Price" min="0" value="{{ old('Price', $EditProduct->price_products) }}" class="form-control" required>
                                            @error('Price')
                                            <small id="Price" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Stock') has-error has-feedback @enderror">
                                            <label for="Stock">Stock Product</label>
                                            <input type="number" id="Stock" name="Stock" min="0" value="{{ old('Stock', $EditProduct->stock_products) }}" class="form-control" required>
                                            @error('Stock')
                                            <small id="Stock" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('product.data') }}" class="btn btn-warning fw-bold text-uppercase but-back">
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
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
