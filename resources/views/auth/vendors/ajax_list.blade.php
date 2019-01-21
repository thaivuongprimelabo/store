

  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.vendor.table_header.id') }}</th>
      <th>{{ trans('auth.vendor.table_header.name') }}</th>
      <th>{{ trans('auth.vendor.table_header.logo') }}</th>
      <th>{{ trans('auth.vendor.table_header.status') }}</th>
      <th>{{ trans('auth.vendor.table_header.created_at') }}</th>
      <th>{{ trans('auth.vendor.table_header.updated_at') }}</th>
    </tr>
    @foreach($vendors as $vendor)
    <tr>
      <td>{{ $vendor->id }}</td>
      <td>{{ $vendor->name }}</td>
      <td><img src="{{ $vendor->logo }}" /></td>
      @if($vendor->status == Status::ACTIVE)
      <td><span class="label label-success">{{ trans('auth.status.active') }}</span></td>
      @else
      <td><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></td>
      @endif
      <td>{{ $vendor->created_at }}</td>
      <td>{{ $vendor->updated_at }}</td>
    </tr>
    @endforeach
  </table>
<!-- /.box-body -->
<div class="box-footer clearfix">
  {{ $vendors->links('auth.common.paging', ['paging' => $paging]) }}
</div>