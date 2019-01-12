@extends('frontend.merchants.template')
@section('content')
<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<!-- <section> -->
					<div class="form-group">
						<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Merchant Profile</p>
					</div>
					
					<form action="{{url('merchants/settings/profile')}}" method="post" id="merchantProfile">
						@csrf
						<div class="form-group">
							<label>First name <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{@$merchant->first_name?$merchant->first_name:''}}">
							@if($errors->has('first_name'))
							<span class="form-text text-danger">
								{{$errors->first('first_name')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>Last name <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{@$merchant->last_name?$merchant->last_name:''}}">
							@if($errors->has('last_name'))
							<span class="form-text text-danger">
								{{$errors->first('last_name')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>Address Line <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="address_line_1" placeholder="Address Line" value="{{@$merchant->address_line_1?$merchant->address_line_1:''}}">

							@if($errors->has('address_line_1'))
							<span class="form-text text-danger">
								{{$errors->first('address_line_1')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>Address Line 2 <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="address_line_2" placeholder="Address Line 2" value="{{@$merchant->address_line_2?$merchant->address_line_2:''}}">

							@if($errors->has('address_line_2'))
							<span class="form-text text-danger">
								{{$errors->first('address_line_2')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>City <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="city" placeholder="City" value="{{@$merchant->city?$merchant->city:''}}">

							@if($errors->has('city'))
							<span class="form-text text-danger">
								{{$errors->first('city')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>State <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="state" placeholder="State" value="{{@$merchant->state?$merchant->state:''}}">

							@if($errors->has('state'))
							<span class="form-text text-danger">
								{{$errors->first('state')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>Postal Code <span style="color: red;">*</span></label>
							<input type="text" class="form-control" name="postal_code" placeholder="Postal Code" value="{{@$merchant->postal_code?$merchant->postal_code:''}}">

							@if($errors->has('postal_code'))
							<span class="form-text text-danger">
								{{$errors->first('postal_code')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>Country <span style="color: red;">*</span></label>
							<select class="form-control" name="country">
								@foreach($country as $country)
								<option value="{{$country}}" {{@$merchant->country==$country?'selected':''}} >{{$country}}</option>
								@endforeach	
							</select>
							@if($errors->has('country'))
							<span class="form-text text-danger">
								{{$errors->first('country')}}
							</span>
							@endif
						</div>

						<div class="form-group">
							<label>Business Name</label>
							<input type="text" class="form-control" name="business_name" placeholder="Business Name(optional)" value="{{@$merchant->business_name?$merchant->business_name:''}}">
						</div>

						<div class="form-group">
							<label>Business Description</label>
							<input type="text" class="form-control" name="business_description" placeholder="Business Description(optional)" value="{{@$merchant->business_description?$merchant->business_description:''}}">
						</div>

						<div class="form-group">
							<label>Business Industry</label>
							<input type="text" class="form-control" name="business_company" placeholder="Business Industry(optional)" value="{{@$merchant->business_company?$merchant->business_company:''}}">
						</div>

						<div class="form-group">
							<label>Website</label>
							<input type="text" class="form-control" name="merchant_website" placeholder="Website(optional)" value="{{@$merchant->merchant_website?$merchant->merchant_website:''}}">
						</div>

						<div class="d-flex justify-content-between text-right">
							<button type="submit" class="btn bg-teal-400">Save Changes <i class="icon-paperplane ml-2"></i></button>
						</div>
					</form>

				</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<div class="form-group">
						<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Volume Information</p>
				</div>
				<div class="form-group">
					<p style="color: #797979;font-size: 14px;">
						In order to comply with Anti-Money Laundering and other fraud prevention laws, Rocketr offers different volume tier. You can request to increase the amount you process by providing us with more information about your business. Click here to learn more about our tiers.
					</p>
					<table>
						<tr>
							<td style="color: #797979;font-size: 14px;font-weight:600;">Your Current Tier</td>
						</tr>
						<tr>
							<td style="color: #797979;font-size: 14px;">Tier 1</td>
						</tr>

						<tr>
							<td style="color: #797979;font-size: 14px;font-weight:600;">Daily Processing Limit</td>
						</tr>
						<tr>
							<td style="color: #797979;font-size: 14px;">$100</td>
						</tr>

						<tr>
							<td style="color: #797979;font-size: 14px;font-weight:600;">Annual Processing Limit</td>
						</tr>
						<tr>
							<td style="color: #797979;font-size: 14px;">$500</td>
						</tr>
					</table>
				</div>
				<button type="increaseVolume" class="btn btn-block bg-teal-400">Increase Processing Volume</button>
				
			</div>
		</div>
	</div>

</div>
@endsection