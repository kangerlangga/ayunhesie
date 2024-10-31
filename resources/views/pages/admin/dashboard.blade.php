<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<div class="wrapper">
    <div class="main-header">
        @include('layouts.admin.nav')
    </div>
    @include('layouts.admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header" style="background: linear-gradient(to bottom right, #35A5B1, #2C8C9D)">
                <div class="page-inner">
                    <div class="mt-2 mb-4">
						<h2 class="text-white pb-2">Welcome back, {{ Auth::user()->nama }}!</h2>
						<h5 class="text-white op-7 mb-4">The journey to transformation starts with the self before it reaches the world.</h5>
					</div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="flaticon-box-2"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Products</p>
                                            <h4 class="card-title">{{ $cP }} Item</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="flaticon-box"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Stocks</p>
                                            <h4 class="card-title">{{ $cS }} (All)</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="flaticon-interface-6"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Blogs</p>
                                            <h4 class="card-title">{{ $cB }} Article</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="flaticon-chat-8"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Comments</p>
                                            <h4 class="card-title">{{ $cC }} Person</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #FF8C00">
                                            <i class="flaticon-stopwatch"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Pending</p>
                                            <h4 class="card-title">{{ $cOP }} Order</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #007BFF">
                                            <i class="flaticon-box-3"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Processing</p>
                                            <h4 class="card-title">{{ $cOPr }} Order</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #6A5ACD">
                                            <i class="flaticon-delivery-truck"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Shipped</p>
                                            <h4 class="card-title">{{ $cOS }} Order</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #228B22">
                                            <i class="flaticon-success"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Delivered</p>
                                            <h4 class="card-title">{{ $cOD }} Order</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->level == 'Super Admin')
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Visitor Statistics</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="visStatistics"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white" style="background: linear-gradient(to bottom right, #35A5B1, #2C8C9D)">
                            <div class="card-body">
                                <h4 class="mt-3 b-b1 pb-2 mb-3 fw-bold">Current Active Visitors</h4>
                                <h1 class="mb-4 fw-bold">{{ $cVO }}</h1>
                                @if ($cTP > 2)
                                <h4 class="mt-3 b-b1 pb-2 mb-3 fw-bold">Top Active Pages</h4>
                                <ul class="list-unstyled">
                                    @foreach ($topPages as $tp)
                                    <li class="d-flex justify-content-between pb-1 pt-1"><small>{{ $tp->url }}</small> <span>{{ $tp->visit_count }}</span></li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
<script>
    @if(session('successprof'))
        Swal.fire({
            icon: "success",
            title: "{{ session('successprof') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @elseif(session('successlog'))
        Swal.fire({
            icon: "success",
            title: "{{ session('successlog') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif
</script>
@include('layouts.admin.script')
<script>
    var visStatistics = document.getElementById('visStatistics').getContext('2d');

    async function fetchVisitorData() {
        const response = await fetch('/assets2/visitors-stats');
        return await response.json();
    }

    async function displayChart() {
        const visitorsData = await fetchVisitorData();
        const completeData = [];
        const labels = [];

        for (let i = 9; i >= 0; i--) {
            const date = new Date();
            date.setDate(date.getDate() - i);
            const formattedDate = date.toISOString().split('T')[0];
            const options = { month: 'short', day: 'numeric' };
            labels.push(date.toLocaleDateString('en-US', options));

            const visitCount = visitorsData.find(data => data.visit_date === formattedDate);
            completeData.push(visitCount ? visitCount.unique_visitors : 0);
        }

        var myVisChart = new Chart(visStatistics, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: "Visitors",
                    backgroundColor: '#35A5B1',
                    borderColor: '#35A5B1',
                    data: completeData,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
            }
        });
    }
    displayChart();
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
