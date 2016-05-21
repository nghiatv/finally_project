@extends('admin.index')

@section('page-header','Tạo Role mới')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Tạo Role mới</li>
    </ol>
@endsection
@section('content')
    <div class="box box-default">
        <div class="register-logo">
            <a href="#"><b>Tạo Role mới (Role)</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Tạo role mới</p>
            <form action="/admin/role" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">

                        @if(isset($messages))
                            <div class="alert alert-success">
                                <ul>
                                    <li><strong>{{ $message }}</strong></li>
                                </ul>
                            </div>
                        @endif

                        @if (count($errors) > 0)
                            {{--<pre>--}}
                            {{--{{ var_dump($errors) }}--}}
                            {{--{{ gettype($errors) }}--}}
                            {{--</pre>--}}
                            <div class="alert alert-danger">
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
                        <div class="form-group has-feedback">
                            <input type="text" name="name" class="form-control" placeholder="Tên">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" name="display_name" class="form-control" placeholder="Tên HIển thị">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label>Viết mô tả</label>
                            <textarea class="form-control" name="description" rows="3"
                                      placeholder="Viết Mô tả ..."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Multiple</label>
                            {{--{{ var_dump($perms) }}--}}

                            <select name="perm[]" class="form-control select2" multiple="multiple" data-placeholder="Chọn quyền"
                                    style="width: 100%;">
                                @foreach($perms as $perm)
                                <option value="{{ $perm->id }}">{{ $perm->display_name }}</option>
                                @endforeach
                            </select>

                        </div><!-- /.form-group -->


                        <div class="row">
                            <div class="col-xs-8">

                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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
