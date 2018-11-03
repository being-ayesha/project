@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
	<div class="row">
		<div class="col-lg-6">
		<div class="card">

			<div class="card-body">
				<form action="{{url('seller/edit-coupon')}}/{{$coupon->id}}" method="post" id="productCuponForm">
					<fieldset class="mb-3">
						<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Edit Coupon</p>
						{{@csrf_field()}}
						<div class="form-group">
						      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Product <span class="text-danger">*</span></label>
						      <select multiple="multiple" class="form-control select" name="product_id[]" id="coupon_product_id" data-placeholder="Please select products..">
							         @for($i=0;$i<count($products);$i++)
							        	<option value="{{$products[$i]['id']}}" {{in_array($products[$i]['product_title'],$groupCoupons)?'selected="selected"':''}}>{{$products[$i]['product_title']}}</option>
							        @endfor							        
							  </select>
							  <div class="error_coupon_product_id"></div>
							  @if($errors->has('product_id'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('product_id')}}
							   </div>
							@endif
	      				</div>
	      				<div class="form-group">
						      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Payment Methods <span class="text-danger">*</span></label>
						      <select multiple="multiple" class="form-control select" name="payment_method_id[]" id="coupon_payment_method_id" data-placeholder="Please select payment method..">
							        @for($i=0;$i<count($paymentMethod);$i++)
							        	<option value="{{$paymentMethod[$i]['id']}}" {{in_array($paymentMethod[$i]['name'],$groupPayment)?'selected="selected"':''}}>{{$paymentMethod[$i]['name']}}</option>
							        @endfor
							        
							  </select>
							   <div class="error_coupon_payment_method_id"></div>
							  @if($errors->has('payment_method_id'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('payment_method_id')}}
							   </div>
							@endif
	      				</div>
	      				<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Coupon Code <span class="text-danger">*</span></label>
							<input type="text" name="coupon_code" id="coupon_code" value="{{$coupon->coupon_code}}" class="form-control" placeholder="e.g. CHRISTMAS50PERCENTOFF">
							 <span class="text-danger errCuponCode"></span>
							@if($errors->has('coupon_code'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('coupon_code')}}
							   </div>
							@endif
						</div>

						<div class="form-group">
							<label for="discount_strcture" style="font-weight: 700;color:#797979;font-size:14px">Discount Structure<span class="text-danger">*</span></label>
							<select class="form-control" name="discount_strcture" id="discount_strcture">
								<option value="percent" {{($coupon->discount_structure=='percent')?'selected="selected"':''}}>Percent Off</option>
								<option value="amount" {{($coupon->discount_structure=='amount')?'selected="selected"':''}}>Amount Off</option>
							</select>
						</div>
						<div class="discount_strcture_div">
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<input type="number" min="-1" name="discount_amount" id="discount_amount" class="form-control" value="{{$coupon->amount_off}}">	
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<p id="discount_result" style="background: #f6f5f5;margin-left: -15px;height: 35px;padding-top: 8px" align="center">{{($coupon->discount_structure=='percent')?'% Off':'Amount Off'}}</p>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Expire Date<span class="text-danger">*</span></label>
							<input id="datetimepicker1" type="text" class="form-control" name="expaire_date" id="coupon_expaire_date" value="{{$coupon->expiry_date}}">
							@if($errors->has('expaire_date'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('expaire_date')}}
							   </div>
							@endif
						</div>


						<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Number of Uses <span class="text-danger">*</span></label>
							<input type="number" min="-1" name="stock" id="stock" value="{{$coupon->stock}}" class="form-control"> 
							@if($errors->has('stock'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('stock')}}
							   </div>
							@endif
						</div>
					</fieldset>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Save Changes</button>
					</div>
				</form>
			</div>
		</div>
		</div>

		<div class="col-lg-6">
			
				<div class="card">
				<div class="card-body">
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle-thin fa-stack-2x"></i>
						<i class="fa fa-shopping-cart fa-stack-1x"></i>
					</span>
					<h6 style="margin:-30px 0px 0px 50px">Number Of Uses <b>{{$coupon->number_of_uses}}</b></h6>
				</div>
			</div>
			
				<div class="card">
				<div class="card-header">
					<h3 class="card-title">Coupon Statistics</h3>
				</div>
				<div class="card-body">
					Number Of Uses 
				</div>
			</div>
				
			
			
		</div>

	</div>

		
	

	<!-- /form inputs -->
@endsection
<!-- @push('scripts')

<script type="text/javascript">

</script>

@endpush -->
