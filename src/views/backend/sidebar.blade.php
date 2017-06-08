  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <style media="screen">
        .user-panel>.image>img {
          width: 45px;
          max-width: 45px;
          height: 45px;
          }
        </style>
        <div class="pull-left image">
          <img src="{{ Auth::user()->image }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        @if(Auth::user()->type == 'administrator')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/user"><i class="fa fa-users"></i> List all</a></li>
            <li><a href="/user/create"><i class="fa fa-user-plus"></i> Create one</a></li>
          </ul>
        </li>
        @endif
        @if(Auth::user()->type <> 'subscriber')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Manage Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/b"><i class="fa fa-list"></i> List all</a></li>
            <li><a href="/b/draft"><i class="fa fa-outdent"></i> Show draft</a></li>
            <li><a href="/b/create"><i class="fa fa-plus-square-o"></i> Create one</a></li>
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="/b">
            <i class="fa fa-newspaper-o"></i> <span>List Posts</span>
          </a>
        </li>
        @endif
        <li><a href="{{ asset('documentation') }}"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->
