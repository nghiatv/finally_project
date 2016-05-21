@extends('admin.index')
@section('page-header','Danh sách Role')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Danh sách Role</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            {{--<pre>--}}
            {{--{{ var_dump($users[0]->name) }}--}}
                {{--</pre>--}}
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Chi tiết các Role</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Tên (Alias)</th>
                            <th>Tên hiển thị</th>
                            <th>Mô tả</th>
                            <th>Permission</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody>


                        @if($roles)

                            {{--{{ var_dump($users) }}--}}
                            @foreach($roles as $role)


                                <tr>
                                    <td><a class="" href="/admin/role/{{ $role->id }}">{{ $role->name }}</a></td>
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
                                    <td class="text-center"><a class=""
                                           href="{{ asset('/admin/role/'.$role->id.'/edit') }}"><i class="fa fa-pencil"></i> Edit </a>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ asset('/admin/role/'.$role->id) }}" method="post">
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
                            <th>Tên (alias)</th>
                            <th>Tên Hiển thị</th>
                            <th>Mô tả</th>
                            <th>Permission</th>
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
