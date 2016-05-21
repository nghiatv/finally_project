@extends('admin.index')
@section('page-header','Tạo email mới')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{asset('/')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Viết email</li>
    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gửi mail thông báo</h3>
                    </div><!-- /.box-header -->
                    <form id="sendmail" action="/admin/mail" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            @if(session('messages'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>

                                    <p><strong>{{session('messages') }}</strong></p>

                                </div>
                            @endif

                            @if (count($errors) > 0)
                                {{--<pre>--}}
                                {{--{{ var_dump($errors) }}--}}
                                {{--{{ gettype($errors) }}--}}
                                {{--</pre>--}}
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                    </button>
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
                            <div class="form-group">
                                <label>To: </label>
                                <select class="form-control select2" multiple="multiple" name="to[]"
                                        data-placeholder="Chọn cửa hàng" style="width: 100%;">
                                    @foreach($stores as $store)
                                        <option value="{{ $store->store_email }}"
                                                @if(old('to'))
                                                @foreach( old('to') as $item)
                                                @if(  $store->store_email == $item )
                                                selected="selected"
                                                @endif
                                                @endforeach
                                                @endif
                                        >
                                            {{ $store->store_name }} - ( {{$store->store_email}} )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>CC: </label>
                                <select class="form-control select2" multiple="multiple" name="cc[]"
                                        data-placeholder="Chọn người dùng" style="width: 100%;">
                                    @foreach($users as $user)
                                        <option value="{{ $user->email }}"
                                                @if(old('cc'))
                                                @foreach( old('cc') as $item)
                                                @if(  $user->email == $item )
                                                selected="selected"
                                                @endif
                                                @endforeach
                                                @endif
                                        >
                                            {{ $user->name }} - ( {{$user->email}} )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên tiêu đề</label>
                                <input class="form-control" name="subject" value="{{ old('subject') }}"
                                       placeholder="Subject:">
                            </div>
                            <div class="form-group">
                    <textarea id="compose-textarea" name="content" class="form-control" style="height: 300px">
                        {{ old('content') }}
                    </textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment[]" multiple="multiple">
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gửi mail
                                </button>
                            </div>
                            <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /. box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
@push('scripts')

<script src="{{ asset('/adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>

    $(function () {
        $("#compose-textarea").wysihtml5();
    });

</script>
@endpush