  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.colors.table_header.id') }}</th>
      <th>{{ trans('auth.colors.table_header.name') }}</th>
      <th>{{ trans('auth.colors.table_header.status') }}</th>
      <th>{{ trans('auth.colors.table_header.created_at') }}</th>
      <th>{{ trans('auth.colors.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($colors->count())
    @foreach($colors as $color)
    <tr>
      <td>{{ $color->id }}</td>
      <td>
      	<a href="javascript:void(0)" style="display:inline-block; width:21px; height:21px; margin-left:5px; margin-bottom:-6px; background-color:{{ $color->name }}"></a>
      	<input type="hidden" id="color" value="{{ $color->name }}" />
      </td>
      @if($color->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="8" data-id="{{ $color->id }}" data-status="{{ $color->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="8" data-id="{{ $color->id }}" data-status="{{ $color->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $color->created_at }}</td>
      <td>{{ $color->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_products_colors_remove',['id' => $color->id]),
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