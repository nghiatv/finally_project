@extends('admin.index')
@section('page-header','Danh sách hóa đơn')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Danh sách hóa đơn</li>
    </ol>
@endsection
@section('content')
    <div class="row">
{{--<pre>   {{var_dump($list)}}</pre>--}}
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách hóa đơn</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                   <form method="get">
                       <div class="row">
                           <div class="col-xs-12 col-md-6">
                               <!-- Date and time range -->
                               <div class="form-group">
                                   <label>Date range</label>
                                   <div class="input-group">
                                       <div class="input-group-addon">
                                           <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" value="{{ $range or "" }}" name="date-range" class="form-control pull-right" id="daterange-btn">
                                   </div><!-- /.input group -->
                               </div><!-- /.form group -->

                               <!-- Date and time range -->

                           </div>

                           <div class="col-xs-12 col-md-3">
                               <div class="form-group">
                                   <label> <br></label>
                                  <div  class="input-group">
                                      <input type="submit" value="Gửi" class="btn btn-primary">
                                  </div>
                               </div>
                           </div>
                       </div>
                   </form>
                    <table id="listBill" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Ngày lập hóa đơn</th>
                            <th>Tên hóa đơn</th>
                            <th>Cửa hàng</th>
                            <th>Trạng thái</th>
                            <th>Giá trị</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($list)
                            @foreach($list as $item)
                                <tr>
                                    <td><a href="{{ asset('/admin/orders/'.$item->id) }}">
                                        {{ $item->order_date }}</a></td>
                                    <td><a href="{{ asset('/admin/orders/'.$item->id) }}"> {{ $item->purchase_order_name }}</a></td>
                                    <td><a href="{{ asset('/admin/store/'.$item->store_id) }}">{{ App\Store::findOrFail($item->store_id)->store_name }}</a> </td>
                                    <td><span class="label label-success">Delivered</span></td>
                                    <td>{{ $item->amount }}</td>
                                </tr>
                                @endforeach
                        @endif

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Ngày lập hóa đơn</th>
                            <th>Tên hóa đơn</th>
                            <th>Cửa hàng</th>
                            <th>Trạng thái</th>
                            <th>Giá trị</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
@push('scripts')
        <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#listBill').DataTable({
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            searching: false,
            iDisplayLength: -1,
            ordering: true,
            order: [[0, 'desc']]
        });
    });
//    //Date range picker with time picker
//    $('#reservationtime').daterangepicker({timePicker: false, timePickerIncrement: 30, format: 'YYYY/MM/YYYY'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
            {
                format : 'YYYY-MM-DD',
                ranges: {
                    'Hôm nay': [moment(), moment().add(1,'days')],
                    'Hôm qua': [moment().subtract(1, 'days'), moment()],
                    '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
//                ,
//                startDate: moment().subtract(29, 'days'),
//                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
    );

    var startDate;
    var endDate;



</script>
@endpush