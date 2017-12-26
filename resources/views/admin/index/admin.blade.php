@extends('admin.master')
@section("content")
    <style>
        #complaints_grid, #case_grid , #stolen_product_grid {
            overflow: hidden;
            text-align: left;
            width: 97%;
            margin: auto;
            height: 475px;
        }

        .panel{
            border-radius:0px;
            margin-top:30px;
            border:none;
        }

        .panel-header{
            padding: 20px;
            text-align: right;
        }

        .nav.nav-tabs{
            background-color:#FAFAFA;
        }

        .nav.nav-tabs a{
            padding:18px;
            font-size:13px;
        }

        .nav-tabs>li.active>a,  .nav-tabs>li>a,  .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
            border:none;
            border-right: 1px solid rgba(42,42,42,.2) !important;;
            border-radius: 0px;
            margin:0px;
            color:#828282;
        }

        .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
            color:#525252;
        }

        [title*='JavaScript charts']{
            display:none !important;
        }

        [href*='#stolen_product']:active, [href*='#stolen_product']:visited, [href*='#stolen_product']:focus{
            border-left:1px solid rgba(42,42,42,.2) !important;
        }

        .statistics{
            border: 1px solid rgba(42,42,42,.15);
            box-shadow: 0px 0px 3px 0px rgba(92,92,92,.1);
        }

        .box{
            background-color:#fff;border: 1px solid rgba(42,42,42,.15);box-shadow: 0px 0px 5px 0px rgba(42,42,42,.1);
        }

        .box h3{
            text-align:center;
            padding: 40px 20px;
            font-weight:bold;
            margin: 0px;
        }

        .box div{
            font-size:smaller;padding:10px;text-align:center;border-top:1px solid rgba(42,42,42,.1);
        }
    </style>
    {!! Breadcrumbs::render('panel.index') !!}
    <div class="col-md-3">
        <div class="box" style="">
            <h3 style="color:#fff;text-align:center;padding: 40px 20px;font-weight:bold;background-color: #F75B49;margin: 0px;">2,300</h3>
            <div style="background-color: #D44434;font-size:smaller;padding:10px;text-align:center;border-top:1px solid rgba(42,42,42,.1);color: #fff;">
                آمار1
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box">
            <h3 style="background-color: #f7a149;">1,120</h3>
            <div style="background-color: #dc8329;">
                آمار2
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box">
            <h3 style="background-color: #49b7f7;">489</h3>
            <div style="background-color: #319cda;">
                آمار3
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box">
            <h3 style="background-color: #c449f7;">310</h3>
            <div style="background-color: #a535d4;">
                آمار4
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="panel">
            <div class="statistics">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" style="display:flex;" role="tablist">
                    <li role="presentation" class="active"><a href="#complaints" aria-controls="home" role="tab" data-toggle="tab" style="border-right:none !important">آمار 1</a></li>
                    <li role="presentation"><a href="#cases" aria-controls="profile" role="tab" data-toggle="tab">آمار 2</a></li>
                    <li role="presentation">
                        <a href="#stolen_product" aria-controls="messages" role="tab" data-toggle="tab">
                            آمار 3
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="height:500px;">
                    <div role="tabpanel" class="tab-pane active" id="complaints">
                        <div id="complaints_grid">

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="cases">
                        <div id="case_grid">

                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="stolen_product">
                        <div id="stolen_product_grid">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("script")

    {!! Html::script("js/amcharts.js") !!}
    {!! Html::script("js/serial.js") !!}
    <script>
        jQuery(function($){
            var chart = AmCharts.makeChart( "complaints_grid", {
                "type": "serial",
                "theme": "light",
                "dataProvider": [ {
                    "date": "1395/01/02",
                    "count": 500
                }, {
                    "date": "1395/02/02",
                    "count": 1882
                }, {
                    "date": "1395/03/03",
                    "count": 1809
                }, {
                    "date": "1395/04/04",
                    "count": 1322
                }, {
                    "date": "1395/06/06",
                    "count": 1122
                }, {
                    "date": "1395/07/07",
                    "count": 1114
                }, {
                    "date": "1395/08/08",
                    "count": 984
                }, {
                    "date": "1395/09/09",
                    "count": 711
                }, {
                    "date": "1395/10/10",
                    "count": 665
                } ],
                "valueAxes": [ {
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0
                } ],
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [ {
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "count"
                } ],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "date",
                "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true
                }
            } );

            var chart = AmCharts.makeChart("case_grid", {
                "theme": "light",
                "type": "serial",
                "dataProvider": [{
                    "date": "1395/01/01",
                    "in-progress": 50,
                    "finished": 20
                }, {
                    "date": "1395/02/02",
                    "in-progress": 20,
                    "finished": 10
                }, {
                    "date": "1395/03/03",
                    "in-progress": 30,
                    "finished": 10
                }, {
                    "date": "1395/04/04",
                    "in-progress": 40,
                    "finished": 50
                }, {
                    "date": "1395/05/05",
                    "in-progress": 30,
                    "finished": 20
                }, {
                    "date": "1395/06/06",
                    "in-progress": 10,
                    "finished": 15
                }],
                "valueAxes": [{
                    "position": "left",
                    "title": "GDP growth rate",
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "تعداد پروندهای در حال بررسی [[category]] : <b>[[value]]</b>",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "title": "2004",
                    "type": "column",
                    "valueField": "in-progress"
                }, {
                    "balloonText": "تعداد پرونده های مختومه [[category]] : <b>[[value]]</b>",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "title": "2005",
                    "type": "column",
                    "clustered":false,
                    "columnWidth":0.5,
                    "valueField": "finished"
                }],
                "plotAreaFillAlphas": 0.1,
                "categoryField": "date",
                "categoryAxis": {
                    "gridPosition": "start"
                },
                "export": {
                    "enabled": true
                }

            });

            var chart = AmCharts.makeChart( "stolen_product_grid", {
                "type": "serial",
                "theme": "light",
                "dataProvider": [ {
                    "date": "1395/01/02",
                    "count": 500
                }, {
                    "date": "1395/02/02",
                    "count": 1882
                }, {
                    "date": "1395/03/03",
                    "count": 1809
                }, {
                    "date": "1395/04/04",
                    "count": 1322
                }, {
                    "date": "1395/06/06",
                    "count": 1122
                }, {
                    "date": "1395/07/07",
                    "count": 1114
                }, {
                    "date": "1395/08/08",
                    "count": 984
                }, {
                    "date": "1395/09/09",
                    "count": 711
                }, {
                    "date": "1395/10/10",
                    "count": 665
                } ],
                "valueAxes": [ {
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0
                } ],
                "gridAboveGraphs": true,
                "startDuration": 1,
                "graphs": [ {
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "count"
                } ],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "date",
                "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "tickPosition": "start",
                    "tickLength": 20
                },
                "export": {
                    "enabled": true
                }
            } );
        })
    </script>
@endsection