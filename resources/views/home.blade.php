@extends('welcome')

@section('content')
<section id="page-title">
    <div class="container">
        <div class="page-title">
            <h1>Статистика и аналитика</h1>
        </div>
    </div>
</section>
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                <h4>Количество зарегистрированных пользователей за последние 12 месяцев</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <canvas id="chart-area-2"></canvas>
                    </div>
                </div>
                <h4 class="mt-5">Средняя стоимость монет в категории за последние 12 месяцев + 2 месяца прогноза</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list list-legend">
                            @foreach($dataForCategoryPriceGraphicsLineNames as $configuration)
                                <li><span style="background-color:{{ $colorsConfiguration[$loop->iteration - 1] }}"></span>{{ $configuration['name'] }}</li>
                            @endforeach
                        </ul>
                        <div id="first_graphic"></div>
                    </div>
                </div>
                <h4 class="mt-5">Количество объявлений каждый месяц (за последние года)</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <canvas id="chart-area-1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/chartjs/chart.min.js')}}"></script>
<script src="{{asset('js/chartjs/utils.js')}}"></script>
<script src="{{asset('js/moment/moment.min.js')}}"></script>
<script src="{{asset('js/morrisjs/raphael.min.js')}}"></script>
<script src="{{asset('js/morrisjs/morris.min.js')}}"></script>
<script>
    var colorsConfiguration = {!! json_encode(array_values($colorsConfiguration)) !!};

    var dataForCategoryPriceGraphics = {!! json_encode(array_values($dataForCategoryPriceGraphicsData)) !!};
    var lineNames = {!! json_encode(array_values($dataForCategoryPriceGraphicsLineNames)) !!};
    var lineNameConfigurationForCategoryPriceGraphics = [];

    for(let i = 0; i < lineNames.length; i++) {
        lineNameConfigurationForCategoryPriceGraphics.push(lineNames[i].name);
    }

    jQuery(document).ready(function () {
        new Morris.Line({
            element: "first_graphic",
            data: dataForCategoryPriceGraphics,
            xkey: "y",
            ykeys: lineNameConfigurationForCategoryPriceGraphics,
            labels: lineNameConfigurationForCategoryPriceGraphics,
            pointStrokeColors: colorsConfiguration,
            gridLineColor: "#e3e3e3",
            behaveLikeLine: !0,
            numLines: 6,
            gridtextSize: 14,
            lineWidth: 3,
            hideHover: "auto",
            lineColors: colorsConfiguration
        });
    });
</script>
<script>
    var dataForAdsMonthGraphics = {!! json_encode(array_values($dataForAdsMonthGraphicsData)) !!};

    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100);
    };

    var config1 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: dataForAdsMonthGraphics,
                backgroundColor: colorsConfiguration,
                label: 'Dataset 1'
            }],
            labels: [
                'Январь',
                'Февраль',
                'Март',
                'Апрель',
                'Май',
                'Июнь',
                'Июль',
                'Август',
                'Сентябрь',
                'Октябрь',
                'Ноябрь',
                'Декабрь'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: ''
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var dataForFourthGraphics = {!! json_encode(array_values($dataForFourthGraphicsData)) !!};

    var config2 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: dataForFourthGraphics,
                backgroundColor: colorsConfiguration,
                label: 'Dataset 1'
            }],
            labels: [
                'Январь',
                'Февраль',
                'Март',
                'Апрель',
                'Май',
                'Июнь',
                'Июль',
                'Август',
                'Сентябрь',
                'Октябрь',
                'Ноябрь',
                'Декабрь'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: ''
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    window.onload = function () {
        var ctx1 = document.getElementById('chart-area-1').getContext('2d');
        window.myDoughnut = new Chart(ctx1, config1);

        var ctx2 = document.getElementById('chart-area-2').getContext('2d');
        window.myLine = new Chart(ctx2, config2);
    };
</script>
