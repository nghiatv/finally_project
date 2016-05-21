@extends('admin.index')
@section('page-header','Sửa quyền')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Sửa quyền</li>
    </ol>
@endsection
@section('content')
    <div class="box box-default">
        <div class="register-logo">
            <a href="#"><b>Tạo quyền mới (Permission)</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Chỉnh sửa quyền mới</p>
            <form action="/admin/perm/{{$perm->id}}" method="post">
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
                        <div class="form-group has-feedback">
                            <input value="{{ $perm->name }}" type="text" name="name" class="form-control" placeholder="Tên">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input value="{{ $perm->display_name }}" type="text" name="display_name" class="form-control" placeholder="Tên HIển thị">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label>Viết mô tả</label>
                            <textarea class="form-control" name="description" rows="3"
                                      placeholder="Viết Mô tả ..." >{{ $perm->description }}</textarea>
                            <input type="hidden" name="_method" value="put" />
                        </div>

                        <div class="row">
                            <div class="col-xs-8">

                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
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
