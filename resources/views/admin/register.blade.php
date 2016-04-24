@extends('admin.index')

@section('content')
    <div class="box box-default">
        <div class="register-logo">
            <a href="#"><b>Tạo mới người dùng</b></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Tạo mới người dùng hệ thống</p>
            <form action="register" method="post">
                {{--<div class="form-group has-feedback">--}}
                    {{--<input type="text" class="form-control" placeholder="Full name">--}}
                    {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
                {{--</div>--}}
               <div class="row">
                   <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                       <div class="form-group has-feedback">
                           <input type="email" class="form-control" placeholder="Email">
                           <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                       </div>
                       <div class="form-group has-feedback">
                           <input type="text" class="form-control" placeholder="Password">
                           <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                       </div>
                       <div class="form-group">
                           <label>Minimal</label>
                           <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                               <option selected="selected">Alabama</option>
                               <option>Alaska</option>
                               <option>California</option>
                               <option>Delaware</option>
                               <option>Tennessee</option>
                               <option>Texas</option>
                               <option>Washington</option>
                           </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-qkem-container"><span class="select2-selection__rendered" id="select2-qkem-container" title="Tennessee">Tennessee</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                       </div>
                       <div class="row">
                           <div class="col-xs-8">
                               <div class="checkbox icheck">
                                   <label>
                                       <input type="checkbox"> I agree to the <a href="#">terms</a>
                                   </label>
                               </div>
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
