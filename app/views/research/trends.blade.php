@extends('clients')
@section('content') 
<script src="{{URL::asset('js/charts/highcharts.js')}}"></script>

 
<h2>Trends</h2>

<div class="row">
    <div id="mx15-score" style="width:100%; height:400px;"></div>
</div>
<div class="row">
    <div id="alexa-rank" style="width:100%; height:400px;"></div>
</div>
<div class="row">
    <div id="google-rank" style="width:100%; height:400px;"></div>
</div>



<script>
$(function () {
        $('#mx15-score').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'MX15 Score'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Score'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f}'
            },
            credits: {
                enabled: false
            },

            series: [{{$mx15Series}}]
        });
    });
</script>
<script>
$(function () {
        $('#google-rank').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Google Page Rank'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Rank'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f}'
            },
            credits: {
                enabled: false
            },

            series: [{{$googleSeries}}]
        });
    });
</script>
<script>
$(function () {
        $('#alexa-rank').highcharts({
            chart: {
                type: 'spline',
                backgroundColor: '#f8f8f8'
            },
            title: {
                text: 'Alexa Traffic Rank',
                style: { 'weight': 'strong' }
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'Rank'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f}'
            },
            credits: {
                enabled: false
            },

            series: [{{$alexaSeries}}]
        });
    });
</script>
@stop