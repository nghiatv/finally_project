@extends('admin.index')
@section('page-header','Danh sách đơn hàng')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$page_name}}</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Hóa đơn</th>
                    <th>Mã sản phẩm</th>
                    <th>Size</th>
                    <th>Style</th>
                    <th>Giá chính thức</th>
                    <th>Giá khuyến mãi</th>
                    {{--<th>CSS grade</th>--}}
                </tr>
                </thead>
                <tbody>
               @if($products)
                   @foreach($products as $product)
                       <tr>
                           <td>{{ $product->product_name }}</td>
                           <td>{{ $product->product_code }}</td>
                           <td>{{ $product->size }}</td>
                           <td>{{ $product->style }}</td>
                           <td>{{ $product->standard_price }}</td>
                           <td>{{ $product->selling_price }}</td>
                       </tr>
                       @endforeach

                   @else
                   <tr>
                       <span>Cửa hàng hiện không có sản phẩm nào</span>
                   </tr>
                   @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã sản phẩm</th>
                    <th>Size</th>
                    <th>Style</th>
                    <th>Giá chính thức</th>
                    <th>Giá khuyến mãi</th>
                </tr>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection