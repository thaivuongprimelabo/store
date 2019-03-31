{{ csrf_field() }}
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('auth.' . $name . '.create_title') }}</h3>
    </div>
    <div class="box-body">
    	@php
    		$forms = trans('auth.' . $name . '.form');
    	@endphp
    	@if(!$tab)
    	{!! Utils::generateForm($forms, $config, $name) !!}
    	@else
    	<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab-form-1" data-toggle="tab" aria-expanded="true"> Thông tin sản phẩm 
					</a>
				</li>
				<li>
					<a href="#tab-form-2" data-toggle="tab"> Đồ chơi theo xe 
					</a>
				</li>
			</ul>
			<div class="tab-content fields-group">
				<div class="tab-pane active" id="tab-form-1">
					{!! Utils::generateForm($forms, $config, $name) !!}
				</div>
				<div class="tab-pane" id="tab-form-2">
					<div class="form-group">
						<table class="table box table-bordered table-responsive toy-item">
                            <thead style="cursor: pointer;">
                              <tr>
                                <th colspan="4">Bô xe máy</th>
                              </tr>
                            </thead>
                            <tbody style="display: none;">
                              <tr>
                              	<td>
                              		<span><span class="input-group"><input type="text" name="group[1][name][]" value="" class="form-control" placeholder="Detail name"></span></span></td><td><button onclick="removeItemForm(this);" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-placement="top" rel="tooltip" data-original-title="" title="Remove item"><span class="glyphicon glyphicon-remove"></span> Remove</button>
                              	</td>
                              </tr>
                              <tr>
                              	<td>
                              		<span><span class="input-group"><input type="text" name="group[1][name][]" value="" class="form-control" placeholder="Detail name"></span></span></td><td><button onclick="removeItemForm(this);" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-placement="top" rel="tooltip" data-original-title="" title="Remove item"><span class="glyphicon glyphicon-remove"></span> Remove</button>
                              	</td>
                              </tr>
                              <tr id="addnew-1">
                                <td colspan="8">  <button type="button" class="btn btn-sm btn-success" onclick="morItem(1);" rel="tooltip" data-original-title="" title="Add new item"><i class="fa fa-plus"></i> Add more</button></td>
                              </tr>
                        	  <tr></tr>
                            </tbody>
                         </table>
                         
                         <table class="table box  table-bordered table-responsive toy-item">
                            <thead style="cursor: pointer;">
                              <tr>
                                <th colspan="4">Khóa chống trộm</th>
                              </tr>
                            </thead>
                            <tbody style="display: none;">
                              <tr>
                              	<td>
                              		<span><span class="input-group"><input type="text" name="group[1][name][]" value="" class="form-control" placeholder="Detail name"></span></span></td><td><button onclick="removeItemForm(this);" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-placement="top" rel="tooltip" data-original-title="" title="Remove item"><span class="glyphicon glyphicon-remove"></span> Remove</button>
                              	</td>
                              </tr>
                              <tr>
                              	<td>
                              		<span><span class="input-group"><input type="text" name="group[1][name][]" value="" class="form-control" placeholder="Detail name"></span></span></td><td><button onclick="removeItemForm(this);" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-placement="top" rel="tooltip" data-original-title="" title="Remove item"><span class="glyphicon glyphicon-remove"></span> Remove</button>
                              	</td>
                              </tr>
                              <tr id="addnew-1">
                                <td colspan="8">  <button type="button" class="btn btn-sm btn-success" onclick="morItem(1);" rel="tooltip" data-original-title="" title="Add new item"><i class="fa fa-plus"></i> Add more</button></td>
                              </tr>
                        	  <tr></tr>
                            </tbody>
                         </table>
					</div>
				</div>
			</div>
		</div>
    	@endif
    </div>
    @if(!isset($hide_footer))
    @include('auth.common.button_footer',['back_url' => route('auth_' . $name)])
    @endif
</div>