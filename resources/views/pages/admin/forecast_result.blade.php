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
                        <a href="{{ route('forecast.data') }}" class="btn btn-round btn-default ml-auto fw-bold">
                            <i class="fa fa-chart-line mr-1"></i>
                            Back to Forecasting
                        </a>
                    </ul>
                </div>

                @foreach ($forecastData as $productCode => $productForecasts)
                    @php
                        $forecastCountAboveThree = 0;
                        foreach ($productForecasts['forecastData'] as $data) {
                            if ($data['forecast'] >= 5) {
                                $forecastCountAboveThree++;
                            }
                        }
                    @endphp
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product : <b>{{ $productForecasts['productName'] }}</b></h4>
                                </div>
                                <div class="card-body">
                                    @if ($forecastCountAboveThree >= 5)
                                    <div class="chart-container mb-3">
                                        <canvas id="multipleLineChart-{{ $productCode }}"></canvas>
                                    </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table id="basic-datatables-{{ $productCode }}" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Date</th>
                                                    <th>Actual Stock</th>
                                                    <th>Forecast</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                @foreach ($productForecasts['forecastData'] as $data)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($data['date'])->format('F Y') }}</td>
                                                        <td>{{ ($data['actual'] == 0 || !$data['actual']) ? '-' : $data['actual'] }}</td>
                                                        <td>{{ $data['forecast'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>

@include('layouts.admin.script')

<script>
    $(document).ready(function() {
        @foreach ($forecastData as $productCode => $productForecasts)
        $('#basic-datatables-{{ $productCode }}').DataTable();

        var ctx = document.getElementById('multipleLineChart-{{ $productCode }}').getContext('2d');
        var myMultipleLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData[$productCode]['labels']) !!},
                datasets: [{
                                label: "Forecast",
                                borderColor: "#FF5733",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#FF5733",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 2,
                                data: {!! json_encode($chartData[$productCode]['forecast']) !!}
                            }, {
                                label: "Actual",
                                borderColor: "#1E90FF",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#1E90FF",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 2,
                                data: {!! json_encode($chartData[$productCode]['actual']) !!}
                            }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'top',
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: { left: 15, right: 15, top: 15, bottom: 15 }
                }
            }
        });
        @endforeach
    });
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
