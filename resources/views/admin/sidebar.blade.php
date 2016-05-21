<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('../adminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> @if(isset(Auth::guard()->user()->name))
                        {{Auth::guard()->user()->name}}
                    @endif</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Danh mục</li>
            <!-- Optionally, you can add icons to the links -->

            @role('admin')
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>Người dùng</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ asset('admin/user') }}">Danh sách người dùng</a></li>
                    <li><a href="{{ asset('admin/user/create') }}">Tạo mới người dùng</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i></i> <span>Cửa hàng</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ asset('admin/store') }}">Danh sách của hàng</a></li>
                    <li><a href="{{ asset('admin/store/create') }}">Tạo mới cửa hàng</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-wrench"></i> <span>Role</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ asset('admin/role') }}">List Role</a></li>
                    <li><a href="{{ asset('admin/role/create') }}">Create Role</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-hand-grab-o"></i> <span>Permission</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ asset('admin/perm') }}">List Permission</a></li>
                    <li><a href="{{ asset('admin/perm/create') }}">Create Permission</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ asset('admin/bill') }}"><i class="fa fa-file-text" aria-hidden="true"></i> <span>Hóa đơn</span> <i
                            class="fa fa-angle-left pull-right"></i></a>

            </li>
            <li class="treeview"><a href="{{ asset('admin/product') }}"><i class="fa fa-file-text" aria-hidden="true"></i> <span>Mặt hàng</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
            </li>
            <li class="treeview"><a href="{{ asset('admin/mail') }}"><i class="fa fa-file-text" aria-hidden="true"></i> <span>Gửi mail</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
            </li>
            @endrole
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>