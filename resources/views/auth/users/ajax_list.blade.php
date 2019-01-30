

  <table class="table table-hover">
    <tr>
      <th>{{ trans('auth.users.table_header.id') }}</th>
      <th>{{ trans('auth.users.table_header.name') }}</th>
      <th>{{ trans('auth.users.table_header.avatar') }}</th>
      <th>{{ trans('auth.users.table_header.email') }}</th>
      <th>{{ trans('auth.users.table_header.status') }}</th>
      <th>{{ trans('auth.users.table_header.created_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($users->count())
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td><img src="{{ Utils::getImageLink($user->avatar) }}" alt="{{ Utils::getImageLink($user->avatar) }}" width="{{ Common::ADMIN_IMAGE_WIDTH }}" /></td>
      <td>{{ $user->email }}</td>
      @if($user->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="5" data-id="{{ $user->id }}" data-status="{{ $user->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="5" data-id="{{ $user->id }}" data-status="{{ $user->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $user->created_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_users_remove',['id' => $user->id]),
      	'url2' => route('auth_users_edit',['id' => $user->id])
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