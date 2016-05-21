@extends('admin.index')
@section('page-header','Chi tiết đơn hàng')
@section('content')
        <!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> {{ $poheader->purchase_order_name }} - <span><small>{{ $store->store_name }}</small></span>
                <small class="pull-right">Ngày mua
                    hàng: {{ \Carbon\Carbon::parse($poheader->order_date)->format('d-m-Y')   }}</small>
            </h2>
        </div><!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Bên bán
            <address>
                <strong style="font-size: 1.3em">{{ $store->store_name }}</strong><br>
                Điện thoại: {{ $store->store_phone }}<br>
                Email: {{ $store->store_email }}<br>
                {{$store->description}}

            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Bên mua
            <address>
                @if($poheader->customer_id)
                    <strong style="font-size: 1.3em">{{ \App\Customer::findOrFail($poheader->customer_id)->name }}</strong><br>
                    Điện thoại: {{ \App\Customer::findOrFail($poheader->customer_id)->phone }}<br>
                    Email: {{ \App\Customer::findOrFail($poheader->customer_id)->email  }}<br>
                    {{ \App\Customer::findOrFail($poheader->customer_id)->address }}<br>
                @else
                    <strong style="font-size: 1.3em">Khách lẻ</strong><br>
                    Điện thoại:<br>
                    Email: <br>
                    <br>
                @endif
            </address>
        </div><!-- /.col -->
        <div class="col-sm-4 invoice-col">
            {{--<b>Hóa đơn {{ $poheader->purchase_order_name }}</b><br>--}}
            {{--<br>--}}
            {{--<b>Order ID:</b> 4F3S8J<br>--}}
            <strong>Ngày mua hàng: </strong> {{ \Carbon\Carbon::parse($poheader->order_date)->format('d-m-Y')   }}<br>
            {{--{{ dd($poheader->ship_id) }}--}}<br>
            <strong>Hình thức vận chuyển: </strong>
            @if($poheader->ship_id)
                {{ \App\Shipment::findOrFail($poheader->ship_id)->display_name  }}
            @endif

            <br>
            <strong>Ghi chú: </strong>
            @if($poheader->ship_id)
                {{ \App\Shipment::findOrFail($poheader->ship_id)->description }}
            @endif
            <br>
            {{--<b>Account:</b> 968-34567--}}
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>

                    <th>Sản phẩm</th>
                    <th>Mã sản phẩm #</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng</th>

                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                @foreach($podetails as $podetail)
                    <tr>
                        <td>{{ \App\Product::findOrFail($podetail->pid)->product_name }}</td>
                        <td>{{ \App\Product::findOrFail($podetail->pid)->product_code }}</td>
                        <td>{{ $podetail->unit_price }}</td>
                        <td>{{ $podetail->quantity }}</td>
                        <td>{{ $podetail->quantity*$podetail->unit_price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            {{--<p class="lead">Payment Methods:</p>--}}
            {{--<img src="../../dist/img/credit/visa.png" alt="Visa">--}}
            {{--<img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
            {{--<img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
            {{--<img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}
            {{--<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">--}}
            {{--Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
            {{--</p>--}}
        </div><!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">Amount Due {{ $poheader->order_date }}</p>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Tổng:</th>
                        <td>{{ $poheader->amount - $poheader->total_duel }}</td>
                    </tr>
                    <tr>
                        <th>Thuế (A):</th>
                        <td>{{ $poheader->tax_cost }}</td>
                    </tr>
                    <tr>
                        <th>Phí vận chuyển (B):</th>
                        <td>{{ $poheader->ship_cost }}</td>
                    </tr>
                    <tr>
                        <th>Chiết khẩu (C):</th>
                        <td>{{ $poheader->discount }}</td>
                    </tr>
                    <tr>
                        <th>Tổng phụ phí (A + B +C):</th>
                        <td>{{ $poheader->total_duel }}</td>
                    </tr>

                    <tr>
                        <th>Thành tiền:</th>

                        <td>{{ $poheader->amount }}</td>
                    </tr>
                </table>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
            {{--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>--}}
            {{--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>--}}
        </div>
    </div>
</section><!-- /.content -->
@endsection