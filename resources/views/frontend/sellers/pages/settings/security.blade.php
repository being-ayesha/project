@extends('frontend.sellers.template')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Two Factor Authentication</h6>
			</div>
			<div class="card-body">
					<div class="form-group row">
						<p class="card-title" style="margin-left: 5px">Login Method: Password</p><br>
						<button type="button" class="btn bg-teal-400 btn-labeled btn-lg btn-block" style="font-size: 18px;font-weight:400">Click here to enable Authy Two Factor Authentication</button>
						<button type="button" class="btn bg-teal-400 btn-labeled btn-lg btn-block" style="font-size: 18px;font-weight:400">Click here to enable Email Two Factor Authentication</button>
						
			     	</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Change Password</h6>
			</div>
			<div class="card-body">
				<form action="{{url('seller/settings/security')}}" method="post" id="changePasswordForm">
					@csrf
					<div class="form-group">
						<label> Current Password:</label>
						<input type="password" class="form-control" placeholder="Enter your current password..." name="current_password" >
						@if($errors->has('current_password'))<span style="color: red">{{$errors->first('current_password')}}</span>@endif
					
					</div>
					<div class="form-group ">
					<label>New Password</label>
						<input type="password" class="form-control" placeholder="Enter your new password..." name="new_password" id="new_password">
						@if($errors->has('new_password'))<span style="color: red">{{$errors->first('new_password')}}</span>@endif

					</div>
					<div class="form-group ">
					<label>New Password (again)</label>
						<input type="password" class="form-control" placeholder="Enter your confirm password..." name="confirm_password" >
						@if($errors->has('confirm_password'))<span style="color: red">{{$errors->first('confirm_password')}}</span>@endif

					</div>				
					<div class="text-right">
						<button type="submit" class="btn bg-teal-400">Change Password</button>
					</div>
                </form>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body"> 
		<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 5px">Login Logs</p>
		{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
	</div>
</div>
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}

@endpush