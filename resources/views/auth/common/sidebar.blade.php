<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Alexander Pierce</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    @foreach(config('master.sidebar') as $item)
    <li>
      <a href="{{ route('auth_' . $item) }}">
        <i class="fa fa-files-o"></i>
        <span>{{ trans('auth.sidebar.' . $item) }}</span>
      </a>
    </li>
    @endforeach
  </ul>
</section>
<!-- /.sidebar -->
</aside>