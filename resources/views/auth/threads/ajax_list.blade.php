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
      <th>{{ trans('auth.threads.table_header.id') }}</th>
      <th>{{ trans('auth.threads.table_header.name') }}</th>
      <th>{{ trans('auth.threads.table_header.status') }}</th>
      <th>{{ trans('auth.threads.table_header.author') }}</th>
      <th>{{ trans('auth.threads.table_header.created_at') }}</th>
      <th>{{ trans('auth.threads.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($threads->count())
    @foreach($threads as $thread)
    <tr>
      <td>{{ $thread->id }}</td>
      <td>{{ $thread->name }}</td>
      @if($thread->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $thread->id }}" data-status="{{ $thread->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $thread->id }}" data-status="{{ $thread->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $thread->author_id }}</td>
      <td>{{ $thread->created_at }}</td>
      <td>{{ $thread->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_threads_remove',['id' => $thread->id]),
      	'url2' => route('auth_threads_edit',['id' => $thread->id])
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
  {{ $threads->links('auth.common.paging', ['paging' => $paging]) }}
</div>