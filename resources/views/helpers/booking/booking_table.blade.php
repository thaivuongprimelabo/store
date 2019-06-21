<table id="booking_list" class="table table-bordered" style="word-wrap:break-word; table-layout: fixed;">
	<col width="4%">
	@php
		$cnt = count($booking_date);
		$width = (100 - 8) / $cnt;
	@endphp
	@if($cnt)
	@foreach($booking_date as $date=>$v)
	<col width="{{ $width }}%">
	@endforeach
	<col width="4%">
	@endif
	<thead>
		<tr>
			<th style="text-align: center;">
				<a href="javascript:void(0)" class="btn-next-prev" data-prev="true" data-next="false" data-start-date="{{ $start_date }}" data-end-date="{{ $end_date }}"><i class="fa fa-arrow-left"></i></a>
			</th>
			@if($cnt)
			@foreach($booking_date as $date=>$v)
			<th style="text-align: center;">{{ $date }}</th>
			@endforeach
			@endif
			<th style="text-align: center;">
				<a href="javascript:void(0)" class="btn-next-prev" data-prev="false" data-next="true" data-start-date="{{ $start_date }}" data-end-date="{{ $end_date }}"><i class="fa fa-arrow-right"></i></a>
			</th>
		</tr>
	</thead>
	<tbody>
		@if(count($booking_time))
		@php
			$times = $booking_date[key($booking_date)];
		@endphp
		@foreach($times as $time=>$value)
		<tr>
			<td>{{ $time }}</td>
			@foreach($booking_date as $date=>$v)
			@php
				$slots = $v[$time];
			@endphp
			<td data-booking-time="{{ $time }}" data-booking-date="{{ $date }}">
				@foreach($slots as $slot)
				{!! \App\Constants\BookingStatus::getLabel($slot) !!}
				@endforeach
			</td>
			@endforeach
			<td>{{ $time }}</td>
		</tr>
		@endforeach
		@endif
		
	</tbody>
</table>
