@extends('admin.index')
@section('page-header','Sửa role')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Sửa Role</li>
    </ol>
@endsection
@section('content')

    <div class="box box-default">
        <div class="register-logo">
            <a href="#"><b>Chỉnh sửa (Permission)</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Tạo quyền mới</p>
            <form action="/admin/role/{{$role->id}}" method="POST">
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

                                        <li>{{ $errors->message }}</li>

                                    @endif
                                </ul>
                            </div>
                        @endif

                        @if($role)

                            <div class="form-group has-feedback">
                                <input type="text" value="{{ $role->name }}" name="name" class="form-control"
                                       placeholder="Tên">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input value="{{ $role->display_name }}" type="text" name="display_name"
                                       class="form-control" placeholder="Tên HIển thị">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label>Viết mô tả</label>
                            <textarea class="form-control" name="description" rows="3"
                                      placeholder="Viết Mô tả ...">{{ $role->description }}</textarea>
                                <input type="hidden" name="_method" value="put"/>
                            </div>

                            @if($perms)

                                <div class="form-group">
                                    <label>Multiple</label>
                                    {{--{{ var_dump($perms) }}--}}

                                    <select name="perm[]" class="form-control select2" multiple="multiple"
                                            data-placeholder="Chọn quyền"
                                            style="width: 100%;">
                                        @foreach($perms as $perm)

                                            <option value="{{ $perm->id }}"
                                                    @if(isset($perms_of_role))
                                                    @foreach( $perms_of_role as $perm_of_role)
                                                    @if($perm->id == $perm_of_role->id)
                                                    selected="selected"
                                                    @endif
                                                    @endforeach
                                                    @endif
                                            >{{ $perm->display_name }}

                                            </option>


                                        @endforeach
                                    </select>

                                </div><!-- /.form-group -->
                            @endif
                        @endif


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
