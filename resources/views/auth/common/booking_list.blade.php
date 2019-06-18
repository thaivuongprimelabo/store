<div class="table-responsive">
	<table id="booking_list" class="table table-bordered" style="word-wrap:break-word;">
		<col width="2%">
		@if(count($booking_time))
    	@foreach($booking_date as $date)
		<col width="auto">
		@endforeach
    	@endif
		<thead>
    		<tr>
    			<th></th>
    			@if(count($booking_time))
    			@foreach($booking_date as $date)
    			<th style="text-align: center;">{{ $date }}</th>
    			@endforeach
    			@endif
    		</tr>
		</thead>
		<tbody>
			@if(count($booking_time))
			@foreach($booking_time as $time)
			<tr>
				<td>{{ $time }}</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
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
              <div class="form-group form-inline">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
            		<select class="form-control">
            			<option value="19">19</option>
            		</select>
            	</div>
            	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
            		<select class="form-control">
            			<option value="19">06</option>
            		</select>
            	</div>
            	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
            		<select class="form-control">
            			<option value="19">2019</option>
            		</select>
            	</div>
            	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
            		<select class="form-control">
            			<option value="08">08</option>
            		</select>
            	</div>
            	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-clock-o fa-fw"></i></span>
            		<select class="form-control">
            			<option value="30">30</option>
            		</select>
            	</div>
              </div>
              <div class="form-group">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
            		<textarea class="form-control" rows="10" placeholder="Ghi chú"></textarea>
            	</div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="service_submit">{{ trans('auth.button.create') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<style type="text/css">
    #booking_list td:hover {
        background: #f0f0f0;
        cursor: pointer;
    }
</style>
@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('click', '#booking_list td', function(e) {
			$('#slot_modal').modal();
		});
	});
</script>
@endsection