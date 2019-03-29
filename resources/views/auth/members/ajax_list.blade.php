<table class="table table-hover">
  	<col width="2%">
  	<col width="30%">
  	<col width="20%">
  	<col width="10%">
  	<col width="10%">
  	<col width="10%">
    <tr>
      <th>{{ trans('auth.members.table_header.id') }}</th>
      <th>{{ trans('auth.members.table_header.name') }}</th>
      <th>{{ trans('auth.members.table_header.email') }}</th>
      <th>{{ trans('auth.members.table_header.avatar') }}</th>
      <th>{{ trans('auth.members.table_header.status') }}</th>
      <th>{{ trans('auth.members.table_header.created_at') }}</th>
      <th>{{ trans('auth.members.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($members->count())
    @foreach($members as $member)
    <tr>
      <td>{{ $member->id }}</td>
      <td>{{ $member->name }}</td>
      <td>{{ $member->email }}</td>
      <td><img src="{{ Utils::getImageLink($member->avatar) }}" width="90" /></td>
      @if($member->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $member->id }}" data-status="{{ $member->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="0" data-id="{{ $member->id }}" data-status="{{ $member->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $member->created_at }}</td>
      <td>{{ $member->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_members_remove',['id' => $member->id]),
      	'url2' => route('auth_members_edit',['id' => $member->id])
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
  {{ $members->links('auth.common.paging', ['paging' => $paging]) }}
</div>