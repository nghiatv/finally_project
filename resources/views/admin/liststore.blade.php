@extends('admin.index')
@section('page-header','Danh sách cửa hàng')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Danh sách cửa hàng</li>
    </ol>
@endsection
@section('content')

    @if($stores)
        <div class="row">
            @foreach($stores as $store)

                <div class="col-md-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><a class=""
                                                     href="{{ asset('/admin/store/'.$store->id) }}">{{ $store->store_name }}</a>
                            </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Thuộc tính</th>
                                    <th>Giá trị</th>

                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td>Doanh thu tháng này</td>
                                    <td>
                                        {{ \App\Store::getRevenue($store->id)[0]->amount  }}
                                    </td>

                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Hóa đơn đã thanh toán</td>
                                    <td>
                                        {{ App\Store::getNewOrders($store->id)[0]->orders_count }}
                                    </td>

                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Mặt hàng bán chạy</td>
                                    <td>
                                        @if( App\Store::getBestSelling($store->id))
                                             {{ App\Store::getBestSelling($store->id)[0]->product_name }}
                                            @endif
                                    </td>

                                </tr>
                                {{--<tr>--}}
                                {{--<td>4.</td>--}}
                                {{--<td>Fix and squish bugs</td>--}}
                                {{--<td>--}}
                                {{--<div class="progress progress-xs progress-striped active">--}}
                                {{--<div class="progress-bar progress-bar-success" style="width: 90%"></div>--}}
                                {{--</div>--}}
                                {{--</td>--}}
                                {{--<td><span class="badge bg-green">90%</span></td>--}}
                                {{--</tr>--}}
                            </table>
                        </div><!-- /.box-body -->

                    </div><!-- /.box -->


                </div><!-- /.col -->

            @endforeach
        </div>
    @endif
@endsection
