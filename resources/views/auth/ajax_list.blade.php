<div class="box-body">
	{!! Utils::generateList($config, $name, $data_list) !!}
</div>
<div class="box-footer clearfix">
	{{ $data_list->links('auth.common.paging', ['paging' => $paging]) }}
</div>

