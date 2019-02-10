  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.sizes.table_header.id') }}</th>
      <th>{{ trans('auth.sizes.table_header.name') }}</th>
      <th>{{ trans('auth.sizes.table_header.status') }}</th>
      <th>{{ trans('auth.sizes.table_header.created_at') }}</th>
      <th>{{ trans('auth.sizes.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($sizes->count())
    @foreach($sizes as $size)
    <tr>
      <td>{{ $size->id }}</td>
      <td>{{ $size->name }}</td>
      @if($size->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="7" data-id="{{ $size->id }}" data-status="{{ $size->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="7" data-id="{{ $size->id }}" data-status="{{ $size->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $size->created_at }}</td>
      <td>{{ $size->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_products_sizes_remove',['id' => $size->id]),
      	'url2' => 'javascript:void(0)'
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
</div>