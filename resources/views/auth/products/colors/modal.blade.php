<div class="modal fade" id="colorModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('auth.colors.edit_create_title') }}</h4>
      </div>
      <div class="modal-body">
        <form id="add_form" role="form" method="post">
        	<input type="hidden" class="form-control" id="id" name="id" value=""/>
              <div class="form-group">
                <label>{{ trans('auth.colors.form.name.text') }}</label>
            	<input type="text" class="form-control my-colorpicker1" id="name" name="name" value="" autocomplete="off" />
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="status" id="status" value="1" checked="checked"> {{ trans('auth.status.active') }}
                  </label>
                </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="color_modal_submit">{{ trans('auth.button.create') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>