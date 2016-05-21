@extends('admin.index')
@section('page-header','Dashboard')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
    </ol>
@endsection
@section('content')
    {{--<pre>--}}

        {{--{{ var_dump($arrayRevenue) }}--}}
{{--        {{ strtotime('2016-1-1') }}--}}

{{--</pre>--}}


    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-bag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng số cửa hàng</span>
                    <span class="info-box-number"><big>{{ count(App\Store::all()) }}</big></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Doanh thu tháng</span>
                    <span class="info-box-number">{{ $totalRevenue }}</span>
                    {{--<span class="info-box-number">{{ $totalRevenue->amount }}</span>--}}
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">{{$totalSales}}</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-12">  <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Doanh thu trong năm {{ date('Y',time()) }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div><!-- /.box-body -->
            </div><!-- /.box --></div>
    </div>
@endsection
@push('scripts')
<script>

    $(document).ready(function () {
        'use strict'
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                    @if($arrayRevenue)
                    @foreach($arrayRevenue as $item)
                    {day: 'Tháng {{ $item[0] }}', item1: {{ $item[1] or 0 }} },
                    @endforeach
                    @endif
                {{--{y: '2011 Q1', item1: {{ $abc[0][0]->total_amount or 0 }} },--}}

            ],
            xkey: 'day',
            ykeys: ['item1'],
            labels: ['Doanh thu'],
            lineColors: ['#efefef'],
            lineWidth: 2,
            hideHover: 'auto',
            gridTextColor: "#fff",
            gridStrokeWidth: 0.4,
            pointSize: 4,
            pointStrokeColors: ["#efefef"],
            gridLineColor: "#efefef",
            gridTextFamily: "Open Sans",
            gridTextSize: 10,
            parseTime:false
        });
    });
</script>
@endpush