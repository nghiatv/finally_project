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
                    <th>Tên đơn hàng</th>
                    <th>Ngày lập hóa đơn</th>
                    <th>Tiền ship</th>
                    <th>Tiền thuế</th>
                    <th>Giảm giá</th>
                    <th>Tổng phụ phí</th>
                    <th>Tổng tiền</th>
                    {{--<th>CSS grade</th>--}}
                </tr>
                </thead>
                <tbody>
                @if($poheaders)
                    @foreach($poheaders as $poheader)
                        <tr>
                            <td><a href="{{ asset('/admin/orders/'.$poheader->id) }}">{{ $poheader->purchase_order_name }}</a> </td>
                            <td>{{ $poheader->order_date }}</td>
                            <td>{{ $poheader->ship_cost }}</td>
                            <td>{{ $poheader->tax_cost }}</td>
                            <td>{{ $poheader->discount }}</td>
                            <td>{{ $poheader->total_duel }}</td>
                            <td>{{ $poheader->amount }}</td>
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
                    <th>Tên đơn hàng</th>
                    <th>Ngày lập hóa đơn</th>
                    <th>Tiền ship</th>
                    <th>Tiền thuế</th>
                    <th>Giảm giá</th>
                    <th>Tổng phụ phí</th>
                    <th>Tổng tiền</th>
                </tr>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
@endsection