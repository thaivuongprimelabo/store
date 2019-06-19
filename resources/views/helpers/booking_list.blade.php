<div class="table-responsive">
	<table id="booking_list" class="table table-bordered" style="word-wrap:break-word;">
		<col width="2%">
		@if(count($booking_date))
    	@foreach($booking_date as $date=>$v)
		<col width="auto">
		@endforeach
    	@endif
		<thead>
    		<tr>
    			<th></th>
    			@if(count($booking_date))
    			@foreach($booking_date as $date=>$v)
    			<th style="text-align: center;">{{ $date }}</th>
    			@endforeach
    			@endif
    		</tr>
		</thead>
		<tbody>
			@if(count($booking_time))
			@foreach($booking_time as $time=>$slot)
			<tr>
				<td>{{ $time }}</td>
				@foreach($booking_date as $date=>$v)
				<td data-booking-time="{{ $time }}" data-booking-date="{{ $date }}"></td>
				@endforeach
			</tr>
			@endforeach
			@endif
			
		</tbody>
	</table>
</div>
<div class="modal fade" id="slot_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Đăng ký chỗ</h4>
      </div>
      <div class="modal-body">
        <form id="add_form" role="form" method="post">
        	<input type="hidden" class="form-control" id="id" name="id" value=""/>
              <div class="form-group">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
            		<input type="text" class="form-control" id="name" name="name" value="" placeholder="Tên khách hàng" />
            	</div>
              </div>
              <div class="form-group">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
            		<input type="text" class="form-control" id="phone_number" name="phone_number" value="" placeholder="Số điện thoại" />
            	</div>
              </div>
              <div class="form-group form-inline">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
            		<input type="text" class="form-control datepicker" id="booking_date" name="booking_date" value="" placeholder="dd/mm/yyyy" />
            	</div>
            	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
            		<select id="booking_time" name="booking_time" class="form-control">
            			@php
            				$booking_time = Booking::getInstance()->getBookingTime();
            			@endphp
            			@foreach($booking_time as $time=>$value)
            			<option value="{{ $time }}">{{ $time }}</option>
            			@endforeach
            			
            		</select>
            	</div>
              </div>
              <div class="form-group">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
            		<textarea class="form-control" id="note" name="note" rows="10" placeholder="Ghi chú"></textarea>
            	</div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="slot_submit">{{ trans('auth.button.create') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<style type="text/css">
    #booking_list td:hover {
        cursor: pointer;
        text-align: center;
    }
    .booking_waiting {
        background: #FF8000;
        color:#f0f0f0;
    }
    
    .booking_success {
        background: #008000;
        color:#f0f0f0;
    }
</style>
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('click', '#booking_list td', function(e) {
			var booking_time = $(this).attr('data-booking-time');
			var booking_date = $(this).attr('data-booking-date');

			$('#booking_date').val(booking_date);
			$('#booking_time').val(booking_time);
			
			$('#slot_modal').modal();
		});

		$(document).on('click', '#slot_submit', function(e) {
			var booking_time = $('#booking_time').val();
			var booking_date = $('#booking_date').val();
			var phone_number = $('#phone_number').val();
			var note 		 = $('#note').val();
			var name 		 = $('#name').val();

			var data = {
				type : 'post',
				async : false,
				booking_time: booking_time,
				booking_date: booking_date,
				phone_number: phone_number,
				name: name,
				note: note
			}

			var res = callAjax('{{ route('booking.createSlot') }}', data, 'booking.create_slot');

			if(res.status) {
				$('#slot_modal').modal('hide');
			}

			alert(res.message);
		});
	});
</script>
@endsection