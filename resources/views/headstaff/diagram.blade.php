@extends('template.app')

@section('content-dinamis')
<h2 class="text-primary mb-4 text-center" style="font-size: 2.5rem;"><b>Diagram keluhan</b></h2>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="text-center" style="width: 100%; max-width: 80rem;">
        <!-- Chart Section -->
        <div id="chart" class="d-flex justify-content-center align-items-center" style="width: 100%; height: 500px;">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var options = {
        chart: {
            type: 'bar',
            background: '#f8f9fa', // Background chart with light color to match the theme
            toolbar: {
                show: false // Hide the toolbar
            },
            height: '100%' // Make chart fill the parent container height
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '50%', // Adjust bar thickness
            }
        },
        series: [{
            data: [{
                x: 'Report',
                y: {{ $report ?? 0 }}
            }, {
                x: 'Response',
                y: {{ $response ?? 0 }}
            }]
        }],
        colors: ['#007bff', '#0062cc'], // Primary blue theme
        dataLabels: {
            enabled: true,
            style: {
                colors: ['#fff'], // White text for data labels
                fontWeight: 'bold'
            }
        },
        xaxis: {
            labels: {
                style: {
                    colors: '#007bff', // Blue color for the x-axis labels
                }
            },
            title: {
                text: 'Category',
                style: {
                    color: '#007bff',
                    fontWeight: 'bold'
                }
            }
        },
        yaxis: {
            title: {
                text: 'Value',
                style: {
                    color: '#007bff',
                    fontWeight: 'bold'
                }
            },
        },
        grid: {
            borderColor: '#ddd',
            strokeDashArray: 5
        },
        tooltip: {
            theme: 'dark',
            style: {
                fontSize: '12px',
                fontFamily: 'Arial'
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
</script>
@endsection