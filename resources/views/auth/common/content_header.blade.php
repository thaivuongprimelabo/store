<section class="content-header">
  <h1>
    {{ trans('auth.' . $name . '.' .$title) }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li><a href="{{ route('auth_' . $name) }}">{{ trans('auth.' . $name . '.list_title') }}</a></li>
    <li class="active">{{ trans('auth.' . $name . '.' .$title) }}</li>
  </ol>
</section>