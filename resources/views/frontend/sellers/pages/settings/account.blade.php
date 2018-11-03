@extends('frontend.sellers.template')
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
												<td style="padding: 5px;color: #2196f3">aminultechvill</td>	
											</tr>
											<tr>
												<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Email</td>
												<td style="padding: 5px;color: #2196f3">aminul.techvill@gmail.com</td>
											</tr>
											<tr>
												<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Account Type</td>
												<td style="padding: 5px;color: #2196f3">Basic</td>
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
						<form action="{{url('seller/settings/account')}}" method="post" enctype="multipart/form-data">
								<input type="hidden" name="store_settings" value="1">
								@csrf
								<div class="form-group">
					        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Store Settings</p>
					        	 	<p style="font-size: 14px;font-weight:700;color: #797979">Store URL:</p><span style="font-size: 14px;"><a href="{{url('seller')}}/{{Auth::user()->username}}" target="_blank">{{url('seller')}}/{{Auth::user()->username}}</a></span> 
					        	</div>
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
							    <div class="form-group">  
								      <label for="description" style="font-weight: 700;color:#797979;font-size:14px">Seller Page Description</label>
								      <p>
								      	<textarea class="form-control" placeholder="Seller page description.." rows="5" cols="5" name="seller_page_description">{{$settings->seller_page_description?$settings->seller_page_description:''}}</textarea>
								      </p>
							    </div>
								<div class="form-group">
								      <label for="google_track_code" style="font-weight: 700;color:#797979;font-size:14px">Google Analytics Tracking Code </label>
								      <p>
								      	<input type="text" class="form-control" id="google_track_code" placeholder="Google Analytics Tracking Code (Optional)" value="{{$settings->google_track_code?$settings->google_track_code:''}}" name="google_track_code">
								      </p>
								      @if($errors->has('google_track_code'))
								         <span class="form-text text-danger">
								         	{{$errors->first('google_track_code')}}
								         </span>
								      @endif
							    </div>
							    <div class="form-group">
								      <label for="fb_track_code" style="font-weight: 700;color:#797979;font-size:14px">Facebook Pixel Tracking Code </label>
								      <p>
								      	<input type="text" class="form-control" id="fb_track_code" placeholder="Facebook Pixel Tracking Code (Optional)" value="{{$settings->fb_track_code?$settings->fb_track_code:''}}" name="fb_track_code">
								      </p>
								      @if($errors->has('fb_track_code'))
								         <span class="form-text text-danger">
								         	{{$errors->first('fb_track_code')}}
								         </span>
								      @endif
							    </div>
								<button type="submit" class="btn btn-md btn-primary">Save Changes</button>					       
				        </form>
				        <!--  </section> -->
					</div>
				</div>

			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
							<form action="{{url('seller/settings/account')}}" method="post" enctype="multipart/form-data">
								<input type="hidden" name="ipn_settings" value="1">
								@csrf
								<!-- <section> -->
								<div class="form-group">
					        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">ipn settings</p>
					        	</div>
					            <div class="Settings">
									 	<div class="form-check" style="float: left;">
											  <input class="form-check-input" name="ipn_status" type="checkbox" {{$settings->ipn_status==1?'checked="checked"':''}} id="ipn_status">
									 	</div>
										<label class="form-check-label" for="ipn_status" style="font-weight: 700;color:#797979;font-size:14px;display: block !important">
										    Send IPNs For All Order updates (including chargebacks, disputes, and more) 
										</label>											
								</div>
								<br>
								<div class="form-group">
								      <label for="ipn_secret" style="font-weight: 700;color:#797979;font-size:14px">Ipn Secret </label>
								      <p>
								      	<input type="text" class="form-control" id="ipn_secret" placeholder="IPN Secret" value="{{$settings->ipn_secret?$settings->ipn_secret:''}}" name="ipn_secret">
								      </p>
								      @if($errors->has('ipn_secret'))
								         <span class="form-text text-danger">
								         	{{$errors->first('ipn_secret')}}
								         </span>
								      @endif
							    </div>
							    <button type="submit" class="btn btn-md btn-primary">Save Changes</button>
					        	<!-- </section> -->
				        	</form>
					</div>
				</div>
				
				<div class="card">
					<div class="card-body">
							<form action="{{url('seller/settings/account')}}" method="post" enctype="multipart/form-data">
									<input type="hidden" name="email_settings" value="1">
									@csrf
									<!-- <section> -->
									<div class="form-group">
						        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">E-mail Notification Settings</p>
						        	</div>
			    					<div class="form-group">
									 	<div class="form-check" style="float: left;">
											  <input class="form-check-input" name="receive_email_product_sold" type="checkbox" {{$settings->receive_email_product_sold==1?'checked':''}} id="receive_email_product_sold">
									 	</div>
										<label class="form-check-label" for="receive_email_product_sold" style="font-weight: 700;color:#797979;font-size:14px">
										    Receive an e-mail when a product is sold 
										</label>											
									</div>
									<div class="form-group">
										<div class="form-check" style="float: left;">
										  <input class="form-check-input" name="receive_email_unsuccessfull_login" type="checkbox" {{$settings->receive_email_unsuccessfull_login==1?'checked':''}} id="receive_email_unsuccessfull_login">
										</div>
										<label class="form-check-label" for="receive_email_unsuccessfull_login" style="font-weight: 700;color:#797979;font-size:14px;display: block !important">
										    Receive an e-mail when someone unsuccessfully attempts to login to your account 
										</label>
									</div>
									<div class="form-group">
										<div class="form-check" style="float: left;">
										  <input class="form-check-input" name="receive_email_site_tips_updates" type="checkbox" {{$settings->receive_email_site_tips_updates==1?'checked="checked"':''}} id="receive_email_site_tips_updates">
										</div>
										<label  class="form-check-label" for="receive_email_site_tips_updates" style="font-weight: 700;color:#797979;font-size:14px">
										    Receive an e-mail with Rocketr tips and updates.  
										</label>
									</div>
									<button type="submit" class="btn btn-md btn-primary">Save Changes</button>
									<!-- </section> -->
							</form>
					</div>
				</div>
			</div>
	</div>
@endsection
@push('scripts')
  <script type="text/javascript">
	  //Display image before upload starts here	    
		    $(".profileImageInp").change(function(){
		        if (this.files && this.files[0]) {
		            var reader    = new FileReader();
		            reader.onload = function (e) {
		                $('#profilePhoto').attr('src', e.target.result);
		            }
		            reader.readAsDataURL(this.files[0]);
		        }
		    });
	  //Display image before upload ends here
  </script>
@endpush