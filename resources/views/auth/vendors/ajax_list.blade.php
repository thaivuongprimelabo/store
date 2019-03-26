

  <table class="table table-hover">
  	<col width="2%">
  	<col width="20%">
  	<col width="10%">
  	<col width="10%">
  	<col width="10%">
  	<col width="10%">
  	<col width="2%">
  	<col width="2%">
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
      <td><img src="{{ Utils::getImageLink($vendor->logo) }}" width="{{ Common::LOGO_WIDTH }}" /></td>
      @if($vendor->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $vendor->id }}" data-status="{{ $vendor->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $vendor->id }}" data-status="{{ $vendor->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $vendor->created_at }}</td>
      <td>{{ $vendor->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_vendors_remove',['id' => $vendor->id]),
      	'url2' => route('auth_vendors_edit',['id' => $vendor->id])
      ])
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