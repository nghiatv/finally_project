@extends('admin.index')
@section('page-header','Sửa người dùng')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Sửa người dùng</li>
    </ol>
@endsection
@section('content')
    <div class="box box-default">
        <div class="register-logo">
            <a href="#"><b>Tạo mới người dùng</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Chỉnh sửa người dùng hệ thống</p>
            <form action="/admin/user/{{$user->id}}" method="POST">
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
                            <input value="{{ $user->name }}" type="text" name="name" class="form-control"
                                   placeholder="Tên người dùng">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input value="{{ $user->email }}" type="email" name="email" class="form-control"
                                   placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input disabled="disabled" type="text" name="password" class="form-control"
                                   placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                        </div>


                        @if(count($roles))
                            <div class="form-group">
                                <label>Gán quyền cho tài khoản</label>
                                <select class="form-control select2" multiple="multiple"
                                        data-placeholder="Select a State" name="roles[]" style="width: 100%;">
                                    @foreach($roles as $role)
                                        {{--{{ var_dump($role->id) }}--}}
                                        <option
                                                @if(isset($roles_of_user))
                                                @foreach($roles_of_user as $role_of_user)
                                                @if($role->id == $role_of_user->role_id )
                                                selected="selected"
                                                @else
                                                {{ 'no single role' }}
                                                @endif
                                                @endforeach
                                                @else
                                                {{ "No roles_of_user" }}
                                                @endif
                                                value="{{ $role->name }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->


                        @endif
                        @if(count($stores))


                            <div class="form-group">
                                <label>Gán cửa hàng cho người dùng</label>
                                <select class="form-control select2" name="store" style="width: 100%;">
                                    @foreach($stores as $store)
                                        <option
                                                @if($user->store_id == $store->id)
                                                selected="selected"
                                                @endif
                                                value="{{ $store->id }}">{{ $store->store_name }}</option>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->


                        @endif
                        <div class="row">
                            <div class="col-xs-8">
                                <input name="_method" value="put" hidden>
                            </div><!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Cập nhật</button>
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
