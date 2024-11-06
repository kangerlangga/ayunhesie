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
                            <form method="POST" action="{{ route('forecast.calculate') }}" enctype="multipart/form-data" id="order_add">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="DateStart">Select Start Date</label>
                                            <input type="date" class="form-control" id="DateStart" name="DateStart" max="{{ date('Y-m-d') }}" value="{{ old('DateStart') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="DateFinish">Select End Date</label>
                                            <input type="date" class="form-control" id="DateFinish" name="DateFinish" max="{{ date('Y-m-d') }}" value="{{ old('DateFinish') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Alpha">Enter Alpha Value (0-1)</label>
                                            <input type="number" class="form-control" id="Alpha" name="Alpha" step="0.01" min="0" max="1" placeholder="0.1" value="{{ old('Alpha') }}" required>
                                            <small class="form-text text-muted">Alpha is a smoothing factor used in forecasting (0.1, 0.5).</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="ForecastPeriod">Enter Forecast Period (1-12 Months)</label>
                                            <input type="number" class="form-control" id="ForecastPeriod" name="ForecastPeriod" min="1" max="12" placeholder="1 - 12" value="{{ old('ForecastPeriod') }}" required>
                                            <small class="form-text text-muted">Specify the number of months to forecast (1 to 12).</small>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary fw-bold text-uppercase">
                                                <i class="fas fa-calculator mr-2"></i>Calculate
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
