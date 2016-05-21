@extends('admin.index')
@section('page-header','Chi tiết cửa hàng')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Chi tiết cửa hàng</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        @if($revenue)
                            {{ $revenue[0]->amount or 0 }}
                            <small class="text-white">VND</small>
                        @else
                            0
                        @endif
                    </h3>
                    <p>Doanh thu tháng này</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        @if($neworders)
                            {{--{{ dd($neworders) }}--}}
                            {{ $neworders[0]->orders_count }}
                        @else
                            No data
                        @endif
                    </h3>
                    <p>Đơn hàng mới</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h4>
                        @if($bestseller)
                            {{ $bestseller[0]->product_name }}
                        @else
                            No Data
                        @endif
                    </h4>
                    @if($bestseller)
                        <p><strong>{{ $bestseller[0]->quantity }}</strong> sản phẩm / trong tháng</p>
                    @else
                        <p><strong>0</strong> sản phẩm / trong tháng</p>
                    @endif
                </div>
                <div class="icon">
                    <i class="ion ion-trophy"></i>
                </div>
                {{--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div><!-- ./col -->

    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">  <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Doanh thu 30 ngày</h3>
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
                {{--<div class="box-footer no-border">--}}
                {{--<div class="row">--}}
                {{--<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">--}}
                {{--<input type="text" class="knob" data-readonly="true" value="20" data-width="60"--}}
                {{--data-height="60" data-fgColor="#39CCCC">--}}
                {{--<div class="knob-label">Mail-Orders</div>--}}
                {{--</div><!-- ./col -->--}}
                {{--<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">--}}
                {{--<input type="text" class="knob" data-readonly="true" value="50" data-width="60"--}}
                {{--data-height="60" data-fgColor="#39CCCC">--}}
                {{--<div class="knob-label">Online</div>--}}
                {{--</div><!-- ./col -->--}}
                {{--<div class="col-xs-4 text-center">--}}
                {{--<input type="text" class="knob" data-readonly="true" value="30" data-width="60"--}}
                {{--data-height="60" data-fgColor="#39CCCC">--}}
                {{--<div class="knob-label">In-Store</div>--}}
                {{--</div><!-- ./col -->--}}
                {{--</div><!-- /.row -->--}}
                {{--</div><!-- /.box-footer -->--}}
            </div><!-- /.box --></div>
    </div>
    <div class="row">

        {{--<pre>   {{ var_dump($abc) }}</pre>--}}


        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">

                <div class="box-body box-profile">
                    <a href="/admin/store/{{$store->id}}/edit" class="pull-right" style="position: absolute; right: 20px;"><b><i class="fa fa-pencil" title="Chỉnh sửa"></i> </b></a>
                    <img class="profile-user-img img-responsive img-circle"
                         src="{{ '/adminLTE/dist/img/store.png' }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ $store->store_name }}</h3>
                    <p class="text-muted text-center">{{ $store->description }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Số điện thoại</b> <a class="pull-right">{{ $store->store_phone }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{ $store->store_email }}</a>
                        </li>

                    </ul>
                    <form method="post" action="{{ asset('/admin/store/'.$store->id) }}">
                        <input hidden name="_method" value="delete">
                        <button type="submit" class="btn btn-block btn-danger">Xóa cửa hàng</button>
                    </form>

                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
        <div class="col-md-9">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-md-12">
                    <!-- solid sales graph -->

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Đơn hàng mới nhất</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div><!-- /.box-header -->
                        {{--<pre>--}}
                        {{--{{ $orders }}--}}
                        {{--</pre>--}}

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Ngày tạo hóa đơn</th>
                                        <th>Tên hóa đơn</th>
                                        <th>Status</th>
                                        <th>Doanh thu</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($orders)
                                        @foreach($orders as $order)
                                            <tr>
                                                <td><a href="{{ asset('/admin/orders/'.$order->id) }}">{{ $order->order_date }}</a></td>
                                                <td><a href="{{ asset('/admin/orders/'.$order->id) }}">{{ $order->purchase_order_name }}</a> </td>
                                                <td><span class="label label-success">Delivered</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a"
                                                         data-height="20">{{ $order->amount }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td> Không có dữ liệu để hiển thị</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <a href="{{ asset('/admin/store/'.$store->id.'/orders') }}"
                               class="btn btn-sm btn-default btn-flat pull-right">View All
                                Orders</a>
                        </div><!-- /.box-footer -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection
@push('scripts')
<script>

    $(document).ready(function () {
        'use strict'
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                    @if($revenueLastMonth)
{{--                {{dd($abc) }}--}}
                    @foreach($revenueLastMonth as $item)
                    {day: '{{ $item[0] }}' , item1: {{ $item[1]->total_amount or 0 }} },
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
            gridTextSize: 10
        });
    });
</script>
@endpush