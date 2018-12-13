@extends('frontend.affiliates.template')
@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="card">
	<div class="card-header">
		<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Paypal Settings</h6>
	</div>

	<div class="card-body">
		<form action="{{url('affiliates/settings')}}" method="post" id="paymentSettingsValidation">
			@csrf
			<div class="form-group">
				<label>Paypal User Name</label>
				<input type="text" class="form-control" placeholder="Enter your username..." name="method[0][username]" value="{{@$paypal['username']}}">
			</div>

			<div class="form-group">
				<label>Paypal Password:</label>
				<input type="password" class="form-control" placeholder="Enter your password..." name="method[1][password]" value="{{@$paypal['password']}}">
			</div>

			<div class="form-group ">
				<label>Paypal Signature</label>

				<input type="test" class="form-control" placeholder="Enter your signature..." name="method[2][signature]" value="{{@$paypal['signature']}}">
			</div>

			<div class="form-group ">
				<label>Mode</label>
				<select class="form-control" name="method[3][mode]">
					<option value="sandbox" {{(@$paypal['mode']=='sandbox')?'selected="selected"':''}}>Sandbox</option>
					<option value="live" {{(@$paypal['mode']=='live')?'selected="selected"':''}}>Live</option>
				</select>
			</div>

			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="method[4][status]">
					<option value="active" {{(@$paypal['status']=='active')?'selected="selected"':''}}>Active</option>
					<option value="inactive" {{(@$paypal['status']=='inactive')?'selected="selected"':''}}>Inactive</option>
				</select>
			</div>

			<div class="text-right">
				<button type="submit" class="btn btn-primary">Save Changes<i class="icon-paperplane ml-2"></i></button>
			</div>
		</form>
	</div>
</div>
	</div>
</div>
@endsection