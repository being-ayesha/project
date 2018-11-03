@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card" id="producttype_div">
			<div class="row">
				<div class="col-sm-12" style="margin-top: 30px; margin-bottom: 30px">
			    	<h3 style="text-align:center;">What Type of Product Do You Want To Sell?</h3>
	        	</div>
	        </div>

			<div class="row" style="padding: 0px 0px 40px 0px">
					<div class="col-sm-4 producttype"  data-rel="file" style="text-align:center;font-size:23px">
						<p><i class="fa fa-download" style="font-size:30px"></i> <br>File Download <br>[An E-book with PDF stamping, MP4 or ZIP file, etc]</p>
					</div>
					<div class="col-sm-4 producttype" data-rel="code" style="text-align:center;font-size:23px">
						<p><i class="fa fa-list" style="font-size:30px"></i> <br>Code/Serials <br>[A Beta Access key or License Key]</p>
					</div>
					<div class="col-sm-4 producttype" data-rel="service" style="text-align:center;font-size:23px">
						<p><i class="fa fa-suitcase" style="font-size:30px"></i> <br>Service <br>[A standalone product]</p>
					</div>
			</div>
		</div>
		<div class="card" id="form_div">
			<div class="card-body">
				    <form class="form-control" id="regForm" action="{{url('seller/add-product')}}" method="POST" enctype="multipart/form-data">
				        <span class="step">1.&nbsp;&nbsp;General</span>
				        <section>
				        	{{@csrf_field()}}
				            <div class="General">
				            	
								      <div class="form-group">
										      <label for="title" style="font-weight: 700;color:#797979;font-size:14px">Product Title <span class="text-danger">*</span></label>
										      <p>
										      	<input type="text" class="form-control" id="title" placeholder="Product title" name="title">
										      </p>
										      <span class="text-danger errProductName"></span>
								  	  </div>
								      <div class="form-group">  
										      <label for="description" style="font-weight: 700;color:#797979;font-size:14px">Product Description</label>
										      <p>
										      	<textarea class="form-control" id="full-editor" placeholder="Product description.." name="description"></textarea>
										      </p>
								      </div>
									 <div class="form-group">     
										      <label for="photo" style="font-weight: 700;color:#797979;font-size:14px">Product Image <span class="text-danger">*</span></label>
										      <p>
										      	<input type="file" class="form-control file-styled imageInp" name="photo">
										      </p>
										      <img id="displayImg" class="form-control" src="#"/>
									  </div>

									  <div class="form-group">
									  </div>
							</div>
				        </section>
				        <span class="step">2.&nbsp;&nbsp;Settings</span>
				        <section>
				             <div class="Settings">
										    	<div class="form-group">
												      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Product Type <span class="text-danger">*</span></label>
												      <select class="form-control" name="product_type" id="product_type">
												        <option value="file">File</option>
												        <option value="code">Codes/Serials</option>
												        <option value="service">Service</option>
		      										  </select>
	      										</div>

	      										<!--Html for product type code/serial starts here for step 2-->
											   	<div class="product_type_codes_div">
													   	<div class="form-group">
														    <label for="codes" style="font-weight: 700;color:#797979;font-size:14px">Accounts/Combos/Codes<span class="text-danger">*</span></label>
														    <div id="tags">
															 	<input type="text" name="codeTags" placeholder="Add codes/serials and hit enter" />
															</div>
															<div id="codesLabelDiv">
																<p id="code" style='font-weight: 700;color:#797979;font-size:14px;margin-top:10px'>Codes that will be added</p>
															</div>
															<!-- <input type="text" style="visibility: hidden" value="" name="codes"/> -->
														</div>

														<div class="form-group">
				      										<div class="form-check" style="float: left;">
															  <input class="form-check-input codes_purchase_permission_state" name="codes_purchase_permission" type="checkbox" id="codes_purchase_permission">
															</div>
															<label class="form-check-label" for="codes_purchase_permission" style="font-weight: 700;color:#797979;font-size:14px">
															    Allow multiple codes to be purchased at once 
															</label>											
														</div>
														<div class="form-group">
														      <label for="codes_puchase_limit" style="font-weight: 700;color:#797979;font-size:14px">Minimum Purchase Quantity</label>
														      <p>
														      	<input type="number" min="1" value="1" class="form-control" id="codes_puchase_limit" placeholder="Minimum purchase quantity" name="codes_puchase_limit">
														      </p>
												  	  	</div>
												</div>
										  	  	<!--Html for product type code/serial ends here for step 2-->
										  	  	<!--Html for product type service starts here-->
	      										<div class="product_type_service_div">
				      										<div class="form-group">
				      											<p class="text-purple">You have selected a service product. Please ensure that the Product Delivery E-Mail Message (on step 4) contains instructions for the buyer</p>
				      										</div>
				      										<div class="form-group">
					      										<div class="form-check" style="float: left;">
																  <input class="form-check-input service_purchase_permission_state" name="service_purchase_permission_state" type="checkbox" id="service_purchase_permission_state">
																</div>
																<label class="form-check-label" for="service_purchase_permission_state" style="font-weight: 700;color:#797979;font-size:14px">
																    Allow more than one to be purchased at once 
																</label>											
															</div>
															<div class="form-group">
															      <label for="service_puchase_limit" style="font-weight: 700;color:#797979;font-size:14px">Minimum Purchase Quantity</label>
															      <p>
															      	<input type="number" min="1" class="form-control" id="service_puchase_limit" placeholder="Minimum purchase quantity" name="service_puchase_limit">
															      </p>
													  	  	</div>

															<div class="form-group">
															      <label for="service_sell_permission" style="font-weight: 700;color:#797979;font-size:14px">Maximum times you want to sell this product. Default: -1 (unlimited)</label>
															      <p>
															      	<input type="number" min="-1" class="form-control" id="service_sell_permission" placeholder="Maximum stock (-1 = unlimited)" value="-1" name="service_sell_permission">
															      </p>
													  	  	</div>
										  	    </div>
	      										<!--Html for product type service ends here-->
	      										<!--Html for product type file starts here for step 2-->
	      										<div class="product_type_file_div">
			      										<div class="form-group">     
														      <label for="downloadable_file" style="font-weight: 700;color:#797979;font-size:14px">Upload a pdf or other type of file <span class="text-danger">*</span></label>
														      <p>
														      	<input type="file" class="form-control file-styled" name="downloadable_file">
														      </p>
													    </div>
													    <div class="form-group">
				      										<div class="form-check" style="float: left;">
															  <input class="form-check-input checkState" name="stock_unlimited" type="checkbox" id="stock_unlimited" checked>
															</div>
															<label class="form-check-label" for="stock_unlimited" style="font-weight: 700;color:#797979;font-size:14px">
															    Allow this product to be purchased unlimited times
															</label>											
														</div>
														<div class="form-group">
				      										<div class="form-check" style="float: left;">
															  <input class="form-check-input checkStateLimit" name="stock_limited_enable" type="checkbox" id="stock_limited_enable">
															</div>
															<label class="form-check-label" for="stock_limited_enable" style="font-weight: 700;color:#797979;font-size:14px">
															    Limit number of sales for this product
															</label>
														</div>

														<div class="form-group stock_limited_div">
														      <label for="stock_limited" style="font-weight: 700;color:#797979;font-size:14px">Limit Sales</label>
														      <p>
														      	<input type="number" min="-1" class="form-control" id="stock_limited" placeholder="Amount of time you'd like to sell this product" name="stock_limited">
														      </p>
												  	  	</div>
										  	  	</div>

												<!-- <div class="form-group">
		      										<div class="form-check" style="float: left;">
													  <input class="form-check-input" name="limit_downloads" type="checkbox" id="limit_downloads" checked>
													</div>
													<label class="form-check-label" for="limit_downloads" style="font-weight: 700;color:#797979;font-size:14px">
													    Limit Downloads to Purchaser's IP
													</label>											
												</div>
												<div class="form-group">
		      										<div class="form-check" style="float: left;">
													  <input class="form-check-input" name="watermark_pdf_file" type="checkbox" id="watermark_pdf_file" checked>
													</div>
													<label class="form-check-label" for="watermark_pdf_file" style="font-weight: 700;color:#797979;font-size:14px">
													    Watermark PDF With Purchaser's IP and Email 
													</label>
												</div> -->
												<!--Html for product type file ends here for step 2-->
							 </div>
				        </section>
				        <span class="step">3.&nbsp;&nbsp;Pricing</span>
				        <section>
				             <label for="description" style="font-weight: 700;color:#797979;font-size:14px">Product Price <span class="text-danger">*</span></label>
				             <div class="input-group">
								    <div class="input-group-prepend">
								      <span class="input-group-text">$</span>
								    </div>
								    <input type="text" name="price" class="form-control" placeholder="Product price">	 
							 </div>

							 <div class="form-group">
								  <label class="form-check-label" for="payment_method" style="font-weight: 700;color:#797979;font-size:14px">Payment Method <span class="text-danger">*</span></label>
						      	  <select class="form-control" name="payment_method" id="payment_method">
						        	 <option value="1">Paypal</option>
								  </select>
							 </div>
							 <div class="form-group">
						      	  <select class="form-control" name="purchase_permission_for_buyers" id="purchase_permission_for_buyers">
						        	 <option value="1">Allow all buyers to purchase</option>
								  </select>
							 </div>
				        </section>
				         <span class="step">4.&nbsp;&nbsp;Sharing and Finish</span>
				        <section>
				        	<div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Product Delivery E-mail</p>
				        	</div>
				            <div class="form-group">  
							      <label for="product_delivery_email_message" style="font-weight: 700;color:#797979;font-size:14px">E-Mail Message <span class="text-danger">*</span></label>
							      <p style="color:#797979">You can edit the e-mail message that will be send to your buyers here. The following variables are allowed: {productTitle}, {productPrice}, {codePurchased}, {fileDownloadUrl}, {buyerName}, {buyerEmail}</p>
							      <p>
							      	<textarea style="color:#797979;font-size: 15px" rows="8" class="form-control" name="product_delivery_email_message">Hello {buyerName},Thank you for purchasing {productTitle}.Here is the license you purchased: {codePurchased}</textarea>
							      </p>
						    </div>
						    <div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Social Sharing Options</p>
				        	</div>
	    					<div class="form-group">
							 	<div class="form-check" style="float: left;">
									  <input class="form-check-input" name="show_fb" type="checkbox" id="show_fb">
							 	</div>
								<label class="form-check-label" for="show_fb" style="font-weight: 700;color:#797979;font-size:14px">
								    Show Facebook Share Button
								</label>											
							</div>
							<div class="form-group">
								<div class="form-check" style="float: left;">
								  <input class="form-check-input" name="show_tweet" type="checkbox" id="show_tweet">
								</div>
								<label class="form-check-label" for="show_tweet" style="font-weight: 700;color:#797979;font-size:14px">
								    Show Tweet Button 
								</label>
							</div>
							<div class="form-group">
								<div class="form-check" style="float: left;">
								  <input class="form-check-input" name="show_pinit" type="checkbox" id="show_pinit">
								</div>
								<label class="form-check-label" for="show_pinit" style="font-weight: 700;color:#797979;font-size:14px">
								    Show PinIt Button 
								</label>
							</div>
							<div class="form-group">
				        	 	<p style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Affiliate Options</p>
				        	</div>
				        	<p style="color: #797979">Please visit <a href="#">this link</a> to learn more about how the affiliate program works.</p> 
							<div class="form-group">
								<div class="form-check" style="float: left;">
								  <input class="form-check-input" name="affiliate_permission" type="checkbox" id="affiliate_permission">
								</div>
								<label class="form-check-label" for="affiliate_permission" style="font-weight: 700;color:#797979;font-size:14px">
								      Allow Affiliates to sign up for this product
								</label>
							</div>
							<div class="input-group mb-3 affiliate_rate_div">
								<label></label>
							    <input type="number" min="0.01" name="affiliate_rate" class="form-control" placeholder="Affiliate Percent">
							    <div class="input-group-prepend">
							      <span class="input-group-text">%</span>
							    </div>
							</div>
				        </section>
				    </form>
			</div>
		</div>
@endsection
@push('scripts')
  <script type="text/javascript">
  	$(function(){	
	  //Ckeditor enable
	  CKEDITOR.replace('full-editor');
	});
  </script>
@endpush