

  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.vendors.table_header.id') }}</th>
      <th>{{ trans('auth.vendors.table_header.name') }}</th>
      <th>{{ trans('auth.vendors.table_header.logo') }}</th>
      <th>{{ trans('auth.vendors.table_header.status') }}</th>
      <th>{{ trans('auth.vendors.table_header.created_at') }}</th>
      <th>{{ trans('auth.vendors.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($vendors->count())
    @foreach($vendors as $vendor)
    <tr>
      <td>{{ $vendor->id }}</td>
      <td>{{ $vendor->name }}</td>
      <td><img src="{{ Utils::getImageLink($vendor->logo) }}" width="200" height="100" /></td>
      @if($vendor->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-id="{{ $vendor->id }}" data-status="{{ $vendor->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-id="{{ $vendor->id }}" data-status="{{ $vendor->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $vendor->created_at }}</td>
      <td>{{ $vendor->updated_at }}</td>
      <td><a href="{{ route('auth_vendors_remove',['id' => $vendor->id]) }}" title="Remove"><i class="fa fa-trash" aria-hidden="true" style="font-size: 24px"></i></a></td>
      <td><a href="{{ route('auth_vendors_edit',['id' => $vendor->id]) }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true" style="font-size: 24px"></i></a></td>
    </tr>
    @endforeach
    @else
    <tr>
    	<td colspan="8" align="center">{{ trans('auth.no_data_found') }}</td>
    </tr>
    @endif
  </table>
<!-- /.box-body -->
<div class="box-footer clearfix">
  {{ $vendors->links('auth.common.paging', ['paging' => $paging]) }}
</div>