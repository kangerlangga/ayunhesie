<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<style>
.card-img-container {
    position: relative;
}

.card-img-container .img-1 {
    transition: opacity 0.5s ease-in-out;
}

.card-img-container .img-2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    z-index: 1;
}

.card-img-container:hover .img-2 {
    opacity: 1;
}

.card-img-container:hover .img-1 {
    opacity: 0;
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
                        <a href="{{ route('product.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #35A5B1">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Products
                        </a>
                    </ul>
                </div>
                <div class="row">
                    @foreach ($DataP as $P)
                    <div class="col-md-3">
                        <div class="card card-post card-round">
                            <div class="card-img-container position-relative">
                                <img class="card-img-top img-1" src="{{ url('') }}/assets1/img/Product/{{ $P->image_p_products }}" alt="{{ $P->name_products }}">
                                <img class="card-img-top img-2 position-absolute top-0 start-0 w-100 h-100" src="{{ url('') }}/assets1/img/Product/{{ $P->image_s_products }}" alt="{{ $P->name_products }}">
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="info-post ml-2">
                                        <p class="username">
                                            {{ $P->code_products }} | {{ $P->name_products }}
                                            (<span style="color: {{ $P->stock_products == 0 ? 'red' : 'inherit' }};">{{ $P->stock_products }}</span>)
                                        </p>
                                        <p class="date text-muted">Rp {{ number_format($P->price_products, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="separator-solid"></div>
                                <a href="{{ route('product.edit', $P->id_products) }}">
                                    <button type="button" class="btn btn-icon btn-round btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </a>
                                <a href="{{ route('product.delete', $P->id_products) }}" class="but-delete">
                                    <button type="button" class="btn btn-icon btn-round btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                                @if (Auth::user()->level == 'Super Admin')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-icon btn-round btn-success" data-toggle="modal" data-target="#{{ $P->id_products }}">
                                        <i class="fas fa-history"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ $P->id_products }}" tabindex="-1" role="dialog" aria-labelledby="{{ $P->id_products }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="{{ $P->id_products }}Label"><b>Activity History</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Created : <br>{{ $P->created_by }} <b>({{ $P->created_at }})</b></p>
                                                    <p>Last Modified : <br>{{ $P->modified_by }} <b>({{ $P->updated_at }})</b></p>
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
