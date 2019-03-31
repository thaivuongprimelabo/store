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
      <th>{{ trans('auth.contacts.table_header.id') }}</th>
      <th>{{ trans('auth.contacts.table_header.subject') }}</th>
      <th>{{ trans('auth.contacts.table_header.email') }}</th>
      <th>{{ trans('auth.contacts.table_header.phone') }}</th>
      <th>{{ trans('auth.contacts.table_header.status') }}</th>
      <th>{{ trans('auth.contacts.table_header.created_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($data_list->count())
    @foreach($data_list as $contact)
    <tr>
      <td>{{ $contact->id }}</td>
      <td>{{ $contact->subject }}</td>
      <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
      <td>{{ $contact->phone }}</td>
      @if($contact->status == ContactStatus::NEW_CONTACT)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="3" data-id="{{ $contact->id }}" data-status="{{ $contact->status }}"><span class="label label-danger">{{ trans('auth.status.new') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="3" data-id="{{ $contact->id }}" data-status="{{ $contact->status }}"><span class="label label-success">{{ trans('auth.status.replied') }}</span></a></td>
      @endif
      <td>{{ $contact->created_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_contacts_remove',['id' => $contact->id]),
      	'url2' => route('auth_contacts_edit',['id' => $contact->id])
      ])
    </tr>
    @endforeach
    @else
    <tr>
    	<td colspan="8" align="center">{{ trans('auth.no_data_found') }}</td>
    </tr>
    @endif
</table>
