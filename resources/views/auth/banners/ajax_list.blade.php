

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
      <th>{{ trans('auth.banners.table_header.id') }}</th>
      <th>{{ trans('auth.banners.table_header.banner') }}</th>
      <th>{{ trans('auth.banners.table_header.link') }}</th>
      <th>{{ trans('auth.banners.table_header.status') }}</th>
      <th>{{ trans('auth.banners.table_header.created_at') }}</th>
      <th>{{ trans('auth.banners.table_header.updated_at') }}</th>
      <th></th>
      <th></th>
    </tr>
    @if($banners->count())
    @foreach($banners as $banner)
    <tr>
      <td>{{ $banner->id }}</td>
      <td><img src="{{ Utils::getImageLink($banner->banner) }}" width="200" /></td>
      <td><a href="{{ $banner->link }}" target="_blank" title="{{ $banner->description }}">{{ $banner->link }}</a></td>
      @if($banner->status == Status::ACTIVE)
      <td><a href="javascript:void(0)" class="update-status" data-tbl="2" data-id="{{ $banner->id }}" data-status="{{ $banner->status }}"><span class="label label-success">{{ trans('auth.status.active') }}</span></a></td>
      @else
      <td><a href="javascript:void(0)" class="update-status" data-tbl="2" data-id="{{ $banner->id }}" data-status="{{ $banner->status }}"><span class="label label-danger">{{ trans('auth.status.unactive') }}</span></a></td>
      @endif
      <td>{{ $banner->created_at }}</td>
      <td>{{ $banner->updated_at }}</td>
      @include('auth.common.row_button',[
      	'url1' => route('auth_banners_remove',['id' => $banner->id]),
      	'url2' => route('auth_banners_edit',['id' => $banner->id])
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
  {{ $banners->links('auth.common.paging', ['paging' => $paging]) }}
</div>