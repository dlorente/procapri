@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de animais</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAnimals }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de cios</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCios }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de partos</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPartos }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    Total de partos x Total de cios
                </div>
                <div class="card-body">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    Highcharts.chart('container', {

        title: {
            text: 'Total de partos e cios por ano'
        },

        xAxis: {
            categories: @json($totalYears)
        },

        yAxis: {
            title: {
                text: 'Total'
            }
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        tooltip: {
            shared: true,
            crosshairs: true
        },

        series: [{
                name: 'Partos',
                lineWidth: 4,
                data: @json($serieParto['qties'])
            },
            {
                name: 'Cios',
                data: @json($serieCio['qties'])
            }
        ],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

        });
</script>
@endpush
