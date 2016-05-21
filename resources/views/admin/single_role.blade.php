@extends('admin.index')
@section('page-header','Chi tiết role')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Chi tiết role</li>
    </ol>
@endsection
@section('content')
    <div class="toolbar"><a href="javascript: window.history.back();">
            <button type="button" class="btn btn-default">
                <i class="fa fa-angle-left"></i> Back
            </button>
        </a></div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $role->display_name }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên (Alias)</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                            <th>Xóa</th>
                        </tr>

                        <tr>
                            <td></td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>
                                {{ $role->description }}
                            </td>
                            <td>
                                @foreach(App\Role::find($role->id)->perms as $perm)


                                    <button class="badge btn-info">
                                        {{ $perm->display_name }}
                                    </button>
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->

            </div><!-- /.box -->


        </div>
    </div>

@endsection
