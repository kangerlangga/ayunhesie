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
                    <ul class="breadcrumbs">
                        <a href="{{ route('stock.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #35A5B1">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Stocks
                        </a>
                    </ul>
                    <?php if ($cS > 0) : ?>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="{{ route('forecast.data') }}" class="btn btn-round btn-default ml-auto fw-bold">
                            <i class="fa fa-chart-line mr-1"></i>
                            Forecasting
                        </a>
                    </div>
                    <?php endif;?>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stock Product</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Product</th>
                                                <th>Stock</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($DataS as $s)
                                            <tr>
                                                <td>{{ $s->date_stocks }}</td>
                                                <td>{{ $s->product->name_products ?? 'N/A' }}</td>
                                                <td>{{ $s->monthly_stocks }}</td>
                                                <td>{{ $s->type_stocks }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('stock.edit', $s->id_stocks) }}">
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('stock.delete', $s->id_stocks) }}" class="but-delete">
                                                            <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

    $(document).ready(function() {
       $('#basic-datatables').DataTable({
            "columnDefs": [
                {
                    "targets": [0],
                    "type": "date"
                }
            ]
        });
    });
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
