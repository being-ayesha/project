@extends('frontend.merchants.template')
@section('content')
<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<!-- <section> -->
					<div class="form-group">
						<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Account Details</p>
					</div>
					<div class="Settings" style="margin-left: 20px">
						<table class="table table-borderless table-responsive">
							<tbody>
								<tr>
									<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Username</td>
									<td style="padding: 5px;color: #2196f3">{{Auth::user()->username}}</td>	
								</tr>
								<tr>
									<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Display name</td>
									<td style="padding: 5px;color: #2196f3">{{Auth::user()->email}}</td>
								</tr>
								<tr>
									<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Email</td>
									<td style="padding: 5px;color: #2196f3">{{Auth::user()->email}}</td>
								</tr>
								<tr>
									<td style="padding: 5px;font-size: 14px;color: ##797979" colspan="2">Please manage your secure account detais <a href="{{url('merchants/settings/profile')}}">here</a>.</td>
								</tr>
								<tr>
									<td style="padding: 5px;font-size: 14px;color: ##797979" colspan="2">To change your username or email, please contact support@creationshop.com</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- </section> -->

				</div>
		</div>

		<div class="card">
			<div class="card-body">
				<!-- <section> -->
					<form action="{{url('merchants/settings/account')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<p style="font-size: 14px;font-weight:700;color: #797979">Avatar (120x120px):</p>
							<p>
								@if(Auth::user()->profile_photo)
								<img id="profilePhoto" style="width: 120px;height:115px;border-radius: 50%" src="{{url('public/uploads/sellers/profilephoto')}}/{{Auth::user()->profile_photo}}"/>
								@else
								<img id="profilePhoto" style="width: 120px;height:115px;border-radius: 50%" src="{{url('public/uploads/sellers/profilephoto/nouser.jpg')}}"/>
								@endif
							</p> 
						</div>
						
						<div class="form-group">     
							<p>
								<input type="file" class="form-control file-styled profileImageInp" name="profile_photo">
							</p>
						</div>

						<button type="submit" class="btn btn-md bg-teal-400">Save Changes</button>					       
					</form>
					<!--  </section> -->
				</div>
			</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">IPN Settings</p>
				</div>

				<form action="{{url('seller/settings/account')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="ipn_settings" value="1">
					@csrf
					<div class="form-group">
						<label for="ipn_secret" style="font-weight: 700;color:#797979;font-size:14px">IPN Secret </label>
						<p>
							<input type="text" class="form-control" id="ipn_secret" placeholder="IPN Secret" value="{{@$settings->ipn_secret?@$settings->ipn_secret:''}}" name="ipn_secret">
						</p>
						@if($errors->has('ipn_secret'))
						<span class="form-text text-danger">
							{{$errors->first('ipn_secret')}}
						</span>
						@endif
					</div>
					<button type="submit" class="btn btn-md bg-teal-400">Save Changes</button>
					<!-- </section> -->
				</form>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<form action="{{url('merchants/settings/account')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="email_settings" value="1">
					@csrf
					<!-- <section> -->
						<div class="form-group">
							<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">E-mail Notification Settings</p>
						</div>
						<div class="form-group">
							<div class="form-check" style="float: left;">
								<input class="form-check-input" name="receive_email_product_sold" type="checkbox" {{@$settings->receive_email_product_sold==1?'checked':''}} id="receive_email_product_sold">
							</div>
							<label class="form-check-label" for="receive_email_product_sold" style="font-weight: 700;color:#797979;font-size:14px">
								Receive an e-mail when a product is sold 
							</label>											
						</div>
						<div class="form-group">
							<div class="form-check" style="float: left;">
								<input class="form-check-input" name="receive_email_unsuccessfull_login" type="checkbox" {{@$settings->receive_email_unsuccessfull_login==1?'checked':''}} id="receive_email_unsuccessfull_login">
							</div>
							<label class="form-check-label" for="receive_email_unsuccessfull_login" style="font-weight: 700;color:#797979;font-size:14px;display: block !important">
								Receive an e-mail when someone unsuccessfully attempts to login to your account 
							</label>
						</div>
						<div class="form-group">
							<div class="form-check" style="float: left;">
								<input class="form-check-input" name="receive_email_site_tips_updates" type="checkbox" {{@$settings->receive_email_site_tips_updates==1?'checked="checked"':''}} id="receive_email_site_tips_updates">
							</div>
							<label  class="form-check-label" for="receive_email_site_tips_updates" style="font-weight: 700;color:#797979;font-size:14px">
								Receive an e-mail with {{$siteName}} tips and updates.  
							</label>
						</div>
						<button type="submit" class="btn btn-md bg-teal-400">Save Changes</button>
						<!-- </section> -->
				</form>
			</div>
		</div>
	</div>
</div>
@endsection