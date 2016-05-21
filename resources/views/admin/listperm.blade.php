@extends('admin.index')
@section('page-header','Danh sách quyền')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Danh sách quyền</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="toolbar">

            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Tên (Alias)</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>

                        </tr>
                        </thead>
                        <tbody>


                        @if($perms)

                            {{--{{ var_dump($users) }}--}}
                            @foreach($perms as $perm)


                                <tr>
                                    <td><a class="" href="/admin/perm/{{ $perm->id }}">{{ $perm->name }}</a></td>
                                    <td>{{ $perm->display_name }}</td>
                                    <td>
                                        {{ $perm->description }}
                                    </td>


                                    <td class="text-center"><a class=""
                                                               href="{{ asset('/admin/perm/'.$perm->id.'/edit') }}"><i class="fa fa-pencil"></i> Edit </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ asset('/admin/perm/'.$perm->id) }}" method="post">
                                            <input name="_method" value="delete" hidden type="text">
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        @endif

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Tên (Alias)</th>
                            <th>Tên Hiển thị</th>
                            <th>Mô tả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>


                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
