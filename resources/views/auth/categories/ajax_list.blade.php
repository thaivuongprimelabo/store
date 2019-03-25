

  <table class="table table-hover" style="table-layout: fixed; word-wrap:break-word;">
  	<col width="10%">
  	<col width="50%">
  	<col width="10%">
  	<col width="10%">
  	<col width="10%">
  	<col width="5%">
  	<col width="5%">
    <tr>
      <th>{{ trans('auth.categories.table_header.id') }}</th>
      <th>{{ trans('auth.categories.table_header.name') }}</th>
      <th>{{ trans('auth.categories.table_header.status') }}</th>
      <th>{{ trans('auth.categories.table_header.created_at') }}</th>
      <th>{{ trans('auth.categories.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($categories->count())
    @foreach($categories as $category)
    <tr>
      <td>{{ $category->id }}</td>
      <td style="width:20%;">{{ $category->name }}</td>
      @if($category->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="1" data-id="{{ $category->id }}" data-status="{{ $category->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="1" data-id="{{ $category->id }}" data-status="{{ $category->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $category->created_at }}</td>
      <td>{{ $category->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_categories_remove',['id' => $category->id]),
      	'url2' => route('auth_categories_edit',['id' => $category->id])
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