@if(isset($services))
@foreach($services as $key=>$service)
<table class="table box table-bordered table-responsive toy-item">
    <thead style="cursor: pointer;">
      <tr>
        <th colspan="4">{{ $service->group_name }}
        	<input type="hidden" name="service[{{ $key }}][group_name]" class="service-group-name" value="{{ $service->group_name }}" />
        </th>
      </tr>
    </thead>
    <tbody>
      @php
      		$names = explode(',', $service->service_names);
            $prices = explode(',', $service->service_prices);
            $row_index = 0;
      @endphp
      @foreach($names as $k=>$service_name)
      @php
      	$row_index = $k;
      @endphp
      @include('auth.products.service_row',['service_name' => $service_name, 'service_price' => $prices[$k]])
      @endforeach
      <tr class="add-item">
        <td colspan="8">  <button type="button" class="btn btn-sm btn-success add-service-item" title="Add new item"><i class="fa fa-plus"></i> {{ trans('auth.button.add_item') }}</button></td>
      </tr>
      <tr></tr>
    </tbody>
    <input type="hidden" class="group_index" value="{{ $key }}" />
	<input type="hidden" class="row_index" value="{{ $row_index }}" />
</table>

@endforeach
@else
<table class="table box table-bordered table-responsive toy-item">
    <thead style="cursor: pointer;">
      <tr>
        <th colspan="4">{service_group_name}
        	<input type="hidden" name="" class="service-group-name" value="" /></th>
      </tr>
    </thead>
    <tbody>
      @include('auth.products.service_row',['class' => 'hide_element'])
      <tr class="add-item">
        <td colspan="8">  <button type="button" class="btn btn-sm btn-success add-service-item" title="Add new item"><i class="fa fa-plus"></i> {{ trans('auth.button.add_item') }}</button></td>
      </tr>
      <tr></tr>
    </tbody>
    <input type="hidden" class="group_index" value="-1" />
	<input type="hidden" class="row_index" value="-1" />
</table>
@endif
