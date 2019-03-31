<table class="table table-hover" style="table-layout: fixed; word-wrap:break-word;">
  	<col width="5%">
  	<col width="25%">
  	<col width="15%">
  	<col width="15%">
  	<col width="15%">
  	<col width="15%">
  	<col width="5%">
  	<col width="5%">
    <tr>
      <th>{{ trans('auth.posts.table_header.id') }}</th>
      <th>{{ trans('auth.posts.table_header.name') }}</th>
      <th>{{ trans('auth.posts.table_header.photo') }}</th>
      <th>{{ trans('auth.posts.table_header.status') }}</th>
      <th>{{ trans('auth.posts.table_header.published_at') }}</th>
      <th>{{ trans('auth.posts.table_header.created_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($data_list->count())
    @foreach($data_list as $post)
    <tr>
      <td>{{ $post->id }}</td>
      <td>{{ $post->name }}</td>
      <th><img src="{{ Utils::getImageLink($post->photo) }}" width="150" title="{{ $post->description }}" alt="{{ $post->name }}" /></th>
      @if($post->status == PostStatus::PUBLISHED)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="4" data-id="{{ $post->id }}" data-status="{{ $post->status }}"><span class="label label-success">{{ trans('auth.status.published') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="4" data-id="{{ $post->id }}" data-status="{{ $post->status }}"><span class="label label-danger">{{ trans('auth.status.not_published') }}</span></a></td>
      @endif
      <td>{{ $post->published_at }}</td>
      <td>{{ $post->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_posts_remove',['id' => $post->id]),
      	'url2' => route('auth_posts_edit',['id' => $post->id])
      ])
    </tr>
    @endforeach
    @else
    <tr>
    	<td colspan="8" align="center">{{ trans('auth.no_data_found') }}</td>
    </tr>
    @endif
</table>
