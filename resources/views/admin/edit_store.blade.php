@extends('admin.index')
@section('page-header','Sửa cửa hàng')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Sửa cửa hàng</li>
    </ol>
@endsection
@section('content')
    <div class="box box-default">
        <div class="register-logo">
            <a href="#"><b>Tạo mới cửa hàng</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Tạo mới cửa hàng trong chuỗi hệ thống hệ thống</p>
            <form action="/admin/store/{{ $store->id }}" method="post">
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

                        @if(session('messages'))
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <ul>
                                    {{--<li><strong>{{ $messages }}</strong></li>--}}
                                    <i class="fa fa-thumbs-up"></i> <strong>{{ session('messages') }}</strong>
                                </ul>
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            {{--<pre>--}}
                            {{--{{ var_dump($errors) }}--}}
                            {{--{{ gettype($errors) }}--}}
                            {{--</pre>--}}
                            <div class="alert alert-danger alert-dismissable" >
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong>Whoops!</strong> Có lỗi xảy ra.<br>
                                <ul>
                                    @if(gettype($errors) != 'string' )
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    @else

                                        <li>{{ $errors }}</li>

                                    @endif
                                </ul>
                            </div>
                        @endif
                        @if($store)
                                <div class="form-group has-feedback">

                                    <label>Tên cửa hàng*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input value="{{ $store->store_name }}" type="text" name="store_name" class="form-control" required>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Email cửa hàng*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input value="{{ $store->store_email }}" type="email" name="store_email" class="form-control" required>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Số điện thoại cửa hàng*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input value="{{ $store->store_phone }}" type="tel" name="store_phone" class="form-control" required>
                                    </div><!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Viết mô tả</label>
                                    <textarea class="form-control" name="store_description" rows="3" placeholder="Viết Mô tả ...">{{
                                    $store->store_description
                                    }}</textarea>
                                </div>
                                <div class="form-group has-feedback">
                                    <label>Mã số cửa hàng (bí mật)</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </div>
                                        <input value="{{ $store->control_code }}" type="text" name="control_code" class="form-control" required>
                                        <input name="_method" value="put" hidden>
                                    </div><!-- /.input group -->
                                </div>
                            @endif

                        {{--<pre>--}}
                        {{--{{ var_dump($roles) }}--}}
                        {{--</pre>--}}


                        <div class="row">
                            <div class="col-xs-8">

                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <input name="_method" value="PUT" type="hidden" >
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Sửa thông tin</button>
                            </div><!-- /.col -->
                        </div>

                    </div>
                </div>
                {{--<div class="form-group has-feedback">--}}
                {{--<input type="password" class="form-control" placeholder="Retype password">--}}
                {{--<span class="glyphicon glyphicon-log-in form-control-feedback"></span>--}}
                {{--</div>--}}

            </form>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->
@endsection
