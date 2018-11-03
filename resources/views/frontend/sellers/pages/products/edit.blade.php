@extends('frontend.sellers.template')
@section('content')
<form action="{{url('seller/edit-product')}}/{{$products->product_uuid}}" method="post" enctype="multipart/form-data">
	<div class="row">
			<div class="col-sm-7">
				<div class="card">
					<div class="card-body">
						<!-- <section> -->
							<div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">General</p>
				        	</div>
				        	{{@csrf_field()}}
				            <div class="General">
				            	      <input type="hidden" name="product_type" value="{{$products->productType->name}}">
								      <div class="form-group">
										      <label for="title" style="font-weight: 700;color:#797979;font-size:14px">Product Title <span class="text-danger">*</span></label>
										      <p>
										      	<input type="text" class="form-control" id="title" placeholder="Product title" value="{{$products->product_title}}" name="title">
										      </p>
										      @if($errors->has('title'))
										         <span class="form-text text-danger">
										         	{{$errors->first('title')}}
										         </span>
										      @endif
								  	  </div>
								      <div class="form-group">  
										      <label for="description" style="font-weight: 700;color:#797979;font-size:14px">Product Description</label>
										      <p>
										      	<textarea class="form-control" id="full-editor" placeholder="Product description.." name="description">{{$products->product_description}}</textarea>
										      </p>
								      </div>

									 <div class="form-group">     
										      <label for="photo" style="font-weight: 700;color:#797979;font-size:14px">Product Image <span class="text-danger">*</span></label>
										      <p>
										      	<input type="file" class="form-control file-styled imageInp" name="photo">
										      </p>
										     <img id="displayAnotherImg" height="200px" class="form-control" src="{{url('public/uploads/sellers/products')}}/{{$products->product_photo}}"/>
								     		 <img id="displayImg" height="200px" class="form-control" src="#"/>
									  </div>

							</div>
				       <!--  </section> -->
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- <section> -->
							 <div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Pricing</p>
				        	 </div>
				             <label for="description" style="font-weight: 700;color:#797979;font-size:14px">Product Price <span class="text-danger">*</span></label>
				             <div class="input-group">
								    <div class="input-group-prepend">
								      <span class="input-group-text">$</span>
								    </div>
								    <input type="text" name="price" class="form-control" value="{{$products->price}}" placeholder="Product price">	 
							 		@if($errors->has('price'))
								         <span class="form-text text-danger">
								         	{{$errors->first('price')}}
								         </span>
									@endif
							 </div>

							 <div class="form-group">
								  <label class="form-check-label" for="payment_method" style="font-weight: 700;color:#797979;font-size:14px">Payment Method <span class="text-danger">*</span></label>
						      	  <select class="form-control" name="payment_method" id="payment_method">
						        	 <option value="1" {{($products->payment_method_id==$products->paymentMethod->id)?'selected="selected"':''}}>Paypal</option>
								  </select>
								  @if($errors->has('payment_method'))
								         <span class="form-text text-danger">
								         	{{$errors->first('payment_method')}}
								         </span>
								  @endif
							 </div>
							 <div class="form-group">
						      	  <select class="form-control" name="purchase_permission_for_buyers" id="purchase_permission_for_buyers">
						        	 <option value="1" {{($products->buyer_purchase_permission)?'selected="selected"':''}}>Allow all buyers to purchase</option>
								  </select>
							 </div>
				       <!--  </section> -->
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="card">
					<div class="card-body">
						<!-- <section> -->
							<div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">product settings</p>
				        	</div>
				             <div class="Settings">
							    	<div class="form-group">
									      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Product Type : {{ucfirst($products->productType->name)}}</label>
									</div>
									<!--Html for product type code/serial starts here for step 2-->
								   	@if($products->productType->name=='code')
									   	<div class="product_type_codes_div">
											   	<div class="form-group">
												    <label for="codesdetails" style="font-weight: 700;color:#797979;font-size:14px">Accounts/Combos/Codes (<span class="text-danger">{{count(json_decode($products->added_codes))}}</span> Remaining)</label>
													<p><a href="#">You can manage serials here</a></p>
												</div>

												<div class="form-group">
		      										<div class="form-check" style="float: left;">
													  <input class="form-check-input codes_purchase_permission_state" name="codes_purchase_permission" type="checkbox" {{$products->codes_purchase_permission=='Yes'?'checked':''}} id="codes_purchase_permission">
													</div>
													<label class="form-check-label" for="codes_purchase_permission" style="font-weight: 700;color:#797979;font-size:14px">
													    Allow multiple codes to be purchased at once 
													</label>											
												</div>
												<div class="form-group">
												      <label for="codes_puchase_limit" style="font-weight: 700;color:#797979;font-size:14px">Minimum Purchase Quantity</label>
												      <p>
												      	<input type="number" min="1" value="{{$products->purchase_limit}}" class="form-control" id="codes_puchase_limit" placeholder="Minimum purchase quantity" name="codes_puchase_limit">
												      </p>
										  	  	</div>
										</div>
									@endif
							  	  	<!--Html for product type code/serial ends here for step 2-->
							  	  	<!--Html for product type service starts here-->
									@if($products->productType->name=='service')
										<div class="product_type_service_div">
		      										<div class="form-group">
		      											<p class="text-purple">You have selected a service product. Please ensure that the Product Delivery E-Mail Message (on step 4) contains instructions for the buyer</p>
		      										</div>
		      										<div class="form-group">
			      										<div class="form-check" style="float: left;">
														  <input class="form-check-input service_purchase_permission_state" name="service_purchase_permission_state" type="checkbox" {{$products->codes_purchase_permission=='Yes'?'checked':''}} id="service_purchase_permission_state">
														</div>
														<label class="form-check-label" for="service_purchase_permission_state" style="font-weight: 700;color:#797979;font-size:14px">
														    Allow more than one to be purchased at once 
														</label>											
													</div>
													<div class="form-group">
													      <label for="service_puchase_limit" style="font-weight: 700;color:#797979;font-size:14px">Minimum Purchase Quantity</label>
													      <p>
													      	<input type="number" min="1" value="{{$products->purchase_limit}}" class="form-control" id="service_puchase_limit" placeholder="Minimum purchase quantity" name="service_puchase_limit">
													      </p>
											  	  	</div>

													<div class="form-group">
													      <label for="service_sell_permission" style="font-weight: 700;color:#797979;font-size:14px">Maximum times you want to sell this product. Default: -1 (unlimited)</label>
													      <p>
													      	<input type="number" min="-1" value="{{$products->stock}}" class="form-control" id="service_sell_permission" placeholder="Maximum stock (-1 = unlimited)" value="-1" name="service_sell_permission">
													      </p>
											  	  	</div>
								  	    </div>
							  	    @endif
									<!--Html for product type service ends here-->
									<!--Html for product type file starts here for step 2-->
									@if($products->productType->name=='file')
										<div class="product_type_file_div">
											   <div class="form-group">     
												      <label for="downloadable_file" style="font-weight: 700;color:#797979;font-size:14px">Current File Uploaded : <span class="text-danger">{{$products->downloadable_file}}</span></label>
											    </div>
	      										<div class="form-group">     
												      <label for="downloadable_file" style="font-weight: 700;color:#797979;font-size:14px">Upload a pdf or other type of file</label>
												      <p>
												      	<input type="file" class="form-control file-styled" name="downloadable_file">
												      </p>
											    </div>
											    <div class="form-group">
		      										<div class="form-check" style="float: left;">
													  <input class="form-check-input checkState" name="stock_unlimited" type="checkbox" {{$products->stock=='-1'?'checked':''}} id="stock_unlimited">
													</div>
													<label class="form-check-label" for="stock_unlimited" style="font-weight: 700;color:#797979;font-size:14px">
													    Allow this product to be purchased unlimited times
													</label>											
												</div>
												<div class="form-group">
		      										<div class="form-check" style="float: left;">
													  <input class="form-check-input checkStateLimit" name="stock_limited_enable" type="checkbox" {{$products->stock!='-1'?'checked':''}} id="stock_limited_enable">
													</div>
													<label class="form-check-label" for="stock_limited_enable" style="font-weight: 700;color:#797979;font-size:14px">
													    Limit number of sales for this product
													</label>
												</div>

												<div class="form-group {{$products->stock!='-1'?'':'stock_limited_div'}}">
												      <label for="stock_limited" style="font-weight: 700;color:#797979;font-size:14px">Limit Sales</label>
												      <p>
												      	<input type="number" min="-1" class="form-control" id="stock_limited" value="{{$products->stock}}" placeholder="Amount of time you'd like to sell this product" name="stock_limited">
												      </p>
										  	  	</div>
								  	  	</div>
							  	  	@endif
							 </div>
				        <!-- </section> -->

					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- <section> -->
				        	<div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Product Delivery E-mail</p>
				        	</div>
				            <div class="form-group">  
							      <label for="product_delivery_email_message" style="font-weight: 700;color:#797979;font-size:14px">E-Mail Message <span class="text-danger">*</span></label>
							      <p style="color:#797979">You can edit the e-mail message that will be send to your buyers here. The following variables are allowed: {productTitle}, {productPrice}, {codePurchased}, {fileDownloadUrl}, {buyerName}, {buyerEmail}</p>
							      <p>
							      	<textarea rows="4" style="color:#797979;font-size: 15px" class="form-control" name="product_delivery_email_message">{{$products->product_delivery_email_message}}</textarea>
							      </p>
							      @if($errors->has('product_delivery_email_message'))
								         <span class="form-text text-danger">
								         	{{$errors->first('product_delivery_email_message')}}
								         </span>
								  @endif
						    </div>
							
				        <!-- </section> -->
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						     @php 
						       $socialOptions = $products->productSocialOptions;//Grab social options related to specific product
						     @endphp
						<!-- <section> -->
							 <div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Social Sharing Options</p>
				        	</div>
	    					<div class="form-group">
							 	<div class="form-check" style="float: left;">
									  <input class="form-check-input" name="show_fb" type="checkbox" {{($socialOptions[0]->social_platform_name=='facebook' && $socialOptions[0]->status=='Active')?'checked':''}} id="show_fb">
							 	</div>
								<label class="form-check-label" for="show_fb" style="font-weight: 700;color:#797979;font-size:14px">
								    Show Facebook Share Button
								</label>											
							</div>
							<div class="form-group">
								<div class="form-check" style="float: left;">
								  <input class="form-check-input" name="show_tweet" type="checkbox" {{($socialOptions[1]->social_platform_name=='twitter' && $socialOptions[1]->status=='Active')?'checked':''}} id="show_tweet">
								</div>
								<label class="form-check-label" for="show_tweet" style="font-weight: 700;color:#797979;font-size:14px">
								    Show Tweet Button 
								</label>
							</div>
							<div class="form-group">
								<div class="form-check" style="float: left;">
								  <input class="form-check-input" name="show_pinit" type="checkbox" {{($socialOptions[2]->social_platform_name=='pininterest' && $socialOptions[2]->status=='Active')?'checked':''}} id="show_pinit">
								</div>
								<label class="form-check-label" for="show_pinit" style="font-weight: 700;color:#797979;font-size:14px">
								    Show PinIt Button 
								</label>
							</div>
						<!-- </section> -->
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<!-- <section> -->
							<div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Affiliate Options</p>
				        	</div>
				        	<p style="color: #797979">Please visit <a href="#">this link</a> to learn more about how the affiliate program works.</p> 
							<div class="form-group">
								<div class="form-check" style="float: left;">
								  <input class="form-check-input affiliate_rate_permission_edit" name="affiliate_permission" type="checkbox" {{$products->affiliate_permission=='Yes'?'checked':''}} id="affiliate_permission">
								</div>
								<label class="form-check-label" for="affiliate_permission" style="font-weight: 700;color:#797979;font-size:14px">
								      Allow Affiliates to sign up for this product
								</label>
							</div>
							<div class="input-group mb-3 affiliate_rate_div_edit {{empty($products->affiliate_rate)?'affiliate_rate_div':''}}">
								<label></label>
							    <input type="number" value="{{$products->affiliate_rate}}" name="affiliate_rate" class="form-control" placeholder="Affiliate Percent">
							    <div class="input-group-prepend">
							      <span class="input-group-text">%</span>
							    </div>
							</div>
						<!-- </section> -->
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<a href="{{url('seller/products')}}" class="btn btn-md btn-danger">Cancel</a>
							<button type="submit" class="btn btn-md btn-primary">Update Product</button>
						</div>
					</div>
				</div>
			</div>
	</div>
</form>
@endsection
@push('scripts')
  <script type="text/javascript">
  	$(function(){	
	  //Ckeditor enable
	  CKEDITOR.replace('full-editor');
	});
  </script>
@endpush