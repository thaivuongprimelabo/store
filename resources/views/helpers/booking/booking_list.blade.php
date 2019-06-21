<div id="booking_wrapper" class="table-responsive">
	
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
        	<input type="hidden" id="slot_id" value="" />
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
              		<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
            		<select id="status" name="status" class="form-control">
            			{!! \App\Constants\BookingStatus::createSelectList() !!}
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
    #booking_list td {
        text-align: right;
        font-weight: bold;
    }
    
    #booking_list td:hover {
        cursor: pointer;
    }
    
    .booking_label {
        width:100% !important;
        display: inline-block !important;
        padding:10px 0px !important;
        margin-bottom: 5px !important;
        cursor: pointer;
        font-size: 14px;
        text-align: center !important;
        line-height: 20px
    }
    .btn-next-prev {
        font-size: 16px;
        display: block;
    }
</style>
@section('script')
<script type="text/javascript">
	$(document).ready(function() {

		var callback = function(res) {
			if(res.status) {
				$('#booking_wrapper').html(res.result_data);
			}
			$('#slot_modal').modal('hide');
		}

		var getSlotList = function(condition) {
			var params = condition !== null ? $.param(condition) : '';
			var url = '{{ route('booking.slotList') }}?' + params;
			$.get(url, function(res) {
				$('#booking_wrapper').html(res.result_data);
			});
		}

		getSlotList(null);

		$(document).on('click', '.btn-next-prev', function(e) {
			var condition = {
				prev: $(this).attr('data-prev'),
				next: $(this).attr('data-next'),
				start_date: $(this).attr('data-start-date'),
				end_date: $(this).attr('data-end-date'),
			};

			getSlotList(condition);
		});

		$(document).on('click', '#booking_search', function(e) {
			var condition = {
				prev: false,
				next: false,
				start_date: $('#booking_time_fr_search').val(),
				end_date: $('#booking_time_to_search').val(),
			};

			getSlotList(condition);
		});

		$(document).on('click', '#booking_list .btn-slot', function(e) {
			var slot = JSON.parse($(this).attr('data-slot'));
			var booking_time = $(this).parent().attr('data-booking-time');
			var booking_date = $(this).parent().attr('data-booking-date');

			$('#name').val('');
			$('#phone_number').val('');
			$('#note').val('');
			$('#booking_date').val(booking_date);
			$('#booking_time').val(booking_time);
			$('#status').val(0);
			$('#slot_id').val(slot.id);
			if(slot.id !== -1) {
				$('#slot_id').val(slot.id);
				$('#name').val(slot.name);
				$('#phone_number').val(slot.phone_number);
				$('#note').val(slot.note);
				$('#status').val(slot.status);
			}
			$('#slot_modal').modal();
		});

		$(document).on('click', '#slot_submit', function(e) {
			var slot_id	 	 = $('#slot_id').val();
			var booking_time = $('#booking_time').val();
			var booking_date = $('#booking_date').val();
			var phone_number = $('#phone_number').val();
			var note 		 = $('#note').val();
			var name 		 = $('#name').val();
			var status		 = $('#status').val();

			var data = {
				type : 'post',
				async : true,
				slot_id: slot_id,
				booking_time: booking_time,
				booking_date: booking_date,
				phone_number: phone_number,
				name: name,
				note: note,
				status: status,
				prev: false,
				next: false,
				start_date: $('.btn-next-prev').first().attr('data-start-date'),
				end_date: $('.btn-next-prev').first().attr('data-end-date'),
			}

			callAjax('{{ route('booking.createSlot') }}', data, 'booking.create_slot', callback);
		});
	});
</script>
@endsection