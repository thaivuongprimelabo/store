<div class="modal fade" id="sizeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('auth.sizes.edit_create_title') }}</h4>
      </div>
      <div class="modal-body">
        <form id="add_form" role="form" method="post">
        	<input type="hidden" class="form-control" id="id" name="id" value=""/>
          	<div class="form-group">
            	<label>{{ trans('auth.sizes.form.name.text') }}</label>
            	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
            		<input type="text" class="form-control" id="name" name="name" value=""/>
            	</div>
          	</div>
          	<div class="checkbox">
              <label>
                <input type="checkbox" name="status" id="status" value="1" checked="checked"> {{ trans('auth.status.active') }}
              </label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="size_modal_submit">{{ trans('auth.button.create') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>