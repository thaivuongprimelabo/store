@if (session('success'))
	<div id="message">
        <div style="padding: 5px;">
            <div id="inner-message" class="alert alert-success">
                <i class="fa fa-check fa-2x"></i> {{ session('success') }}
            </div>
        </div>
    </div>
@endif
@if (session('error'))
    <div id="message">
        <div style="padding: 5px;">
            <div id="inner-message" class="alert alert-danger">
                <i class="fa fa-exclamation-triangle fa-2x"></i> {{ session('error') }}
            </div>
        </div>
    </div>
@endif

