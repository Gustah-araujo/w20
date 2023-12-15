@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">

                        <div class="float-start">
                            <i class="fas fa-chart-area me-1"></i>
                            Saídas por mês
                        </div>

                        <div class="float-end">
                            <select class="form-select" id="sales-by-month-year">
                                <option value="{{ \Carbon\Carbon::now()->subYears(2)->year }}">{{ \Carbon\Carbon::now()->subYears(2)->year }}</option>
                                <option value="{{ \Carbon\Carbon::now()->subYear()->year }}">{{ \Carbon\Carbon::now()->subYear()->year }}</option>
                                <option selected value="{{ \Carbon\Carbon::now()->year }}">{{ \Carbon\Carbon::now()->year }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-body"><canvas id="sales-by-month" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <input type="hidden" id="salesByMonth" value="{{ $sales_by_month }}">

    <script>

        window.addEventListener('DOMContentLoaded', event => {

            const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

            document.getElementById('sales-by-month-year').addEventListener('change', event => {

                let year = event.target.value;

                $.ajax({
                    type: "GET",
                    url: route('dashboards.sales_by_month', {
                        year: year
                    }),
                    dataType: "json",
                    success: function (response) {

                        let chartConfig = {
                            type: 'line',
                            data: {
                                labels  : months,
                                datasets: response
                            }
                        };

                        topProductsChart.destroy();
                        topProductsChart = new Chart( $('#sales-by-month'), chartConfig );
                    }
                });

            });

            const salesByMonthDatasets = JSON.parse(document.getElementById('salesByMonth').value);

            const topProductsConfig = {
                type: 'line',
                data: {
                    labels: months,
                    datasets: salesByMonthDatasets
                },
            };

            var topProductsChart = new Chart( document.getElementById('sales-by-month'), topProductsConfig );

        });

    </script>
@endsection
