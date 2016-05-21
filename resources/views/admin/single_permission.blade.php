@extends('admin.index')
@section('page-header',"Chi tiết Permission")

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Chi tiết quyền</li>
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
                    <h3 class="box-title">{{ $perm->display_name }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tên (Alias)</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                        </tr>

                        <tr>
                            <td></td>
                            <td>{{ $perm->name }}</td>
                            <td>{{ $perm->display_name }}</td>
                            <td>
                                {{ $perm->description }}
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->

            </div><!-- /.box -->


        </div>
    </div>

@endsection
