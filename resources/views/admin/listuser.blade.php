@extends('admin.index')
@section('page-header','Danh sách người dùng')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li  class="active">Danh sách người dùng</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách người dùng</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Cửa hàng</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>


                        @if($users)

                            {{--{{ var_dump($users) }}--}}
                            @foreach($users as $user)


                                <tr>
                                    <td><a class="" href="/admin/user/{{ $user->id }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>

                                        {{ App\Store::find($user->store_id)->store_name }}

                                    </td>
                                    <td>
                                        @foreach( $user->roles as $role)
                                            <button class="badge btn-info">
                                                {{ $role->display_name }}
                                            </button>
                                        @endforeach
                                    </td>
                                    <td class="text-center"><a class=""
                                                               href="{{ asset('/admin/user/'.$user->id.'/edit') }}"><i
                                                    class="fa fa-pencil"></i> Edit </a></td>
                                    <td class="text-center">
                                        <form action={{ asset('/admin/user/'.$user->id) }} method="post">
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
                            <th>Tên người dùng</th>
                            <th>Email</th>
                            <th>Cửa hàng</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
