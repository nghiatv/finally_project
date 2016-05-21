@extends('admin.index')
@section('page-header','Danh sách mặt hàng')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Danh sách mặt hàng</li>
    </ol>
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách mặt hàng</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Cửa hàng</th>

                    {{--<th>CSS grade</th>--}}
                </tr>
                </thead>
                <tbody>
                @if($products)
                    @foreach($products as $product)
                        <tr>
                            {{--<td><a href="{{ asset('/admin/orders/'.$poheader->id) }}">{{ $poheader->purchase_order_name }}</a> </td>--}}
                            <td><a href="{{asset('/admin/product/'.$product->id)}}">{{ $product->product_name }}</a> </td>
                            <td><a href="{{asset('/admin/product/'.$product->id)}}">{{ $product->product_code }}</a> </td>
                            {{--<td>{{ $product->product_code }}</td>--}}
                            <td>{{ \App\Store::findOrFail($product->store_id)->store_name }}</td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <span>Không có sản phẩm nào</span>
                    </tr>
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Cửa hàng</th>

                </tr>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection