

  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.vendor.table_header.id') }}</th>
      <th>{{ trans('auth.vendor.table_header.name') }}</th>
      <th>{{ trans('auth.vendor.table_header.logo') }}</th>
      <th>{{ trans('auth.vendor.table_header.status') }}</th>
      <th>{{ trans('auth.vendor.table_header.created_at') }}</th>
      <th>{{ trans('auth.vendor.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @foreach($vendors as $vendor)
    <tr>
      <td>{{ $vendor->id }}</td>
      <td>{{ $vendor->name }}</td>
      <td><img src="{{ Utils::getImageLink($vendor->logo) }}" width="200" height="100" /></td>
      @if($vendor->status == Status::ACTIVE)
      <td><span class="label label-success">{{ trans('auth.status.active') }}</span></td>
      @else
      <td><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></td>
      @endif
      <td>{{ $vendor->created_at }}</td>
      <td>{{ $vendor->updated_at }}</td>
      <td><a href="{{ route('auth_vendor_remove',['id' => $vendor->id]) }}" title="Remove"><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i></a></td>
      <td><a href="{{ route('auth_vendor_edit',['id' => $vendor->id]) }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 24px"></i></a></td>
    </tr>
    @endforeach
  </table>
<!-- /.box-body -->
<div class="box-footer clearfix">
  {{ $vendors->links('auth.common.paging', ['paging' => $paging]) }}
</div>