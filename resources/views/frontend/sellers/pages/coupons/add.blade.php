@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card">
			<div class="card-body">
				<form action="{{url('seller/add-coupon')}}" method="post" id="productCuponForm">
					<fieldset class="mb-3">
						<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Add Coupon</p>
						@csrf	
						<div class="form-group">
						      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Product <span class="text-danger">*</span></label>
						      <select multiple="multiple" class="form-control select" name="product_id[]" id="coupon_product_id" data-placeholder="Please select products..">
							        @foreach($products as $product)
							        	<option value="{{$product->id}}">{{$product->product_title}}</option>
							        @endforeach
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
							        @foreach($paymentMethod as $paymentMethod)
							        	<option value="{{$paymentMethod->id}}">{{$paymentMethod->name}}</option>
							        @endforeach
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
							<input type="text" name="coupon_code" id="coupon_code" value="{{old('coupon_code')}}" class="form-control" placeholder="e.g. CHRISTMAS50PERCENTOFF">
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
								<option value="percent">Percent Off</option>
								<option value="amount">Amount Off</option>
							</select>
						</div>
						<div class="discount_strcture_div">
							<div class="row">
								<div class="col-md-11">
									<div class="form-group">
										<input type="number" min="-1" name="discount_amount" id="discount_amount" class="form-control">	
									</div>
								</div>
								<div class="col-md-1">
									<div class="form-group">
										<p id="discount_result" style="background: #f6f5f5;margin-left: -15px;height: 35px;padding-top: 8px" align="center">% Off</p>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Expire Date<span class="text-danger">*</span></label>
							<input id="datetimepicker1" type="text" class="form-control" name="expaire_date" id="coupon_expaire_date">
							@if($errors->has('expaire_date'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('expaire_date')}}
							   </div>
							@endif
						</div>


						<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Number of Uses <span class="text-danger">*</span></label>
							<input type="number" min="-1" name="stock" id="stock" value="-1" class="form-control"> 
							@if($errors->has('stock'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('stock')}}
							   </div>
							@endif
						</div>
					</fieldset>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Add Coupon</button>
					</div>
				</form>
			</div>
		</div>
	<!-- /form inputs -->
@endsection