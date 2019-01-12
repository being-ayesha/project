@extends('frontend.merchants.template')
@section('content')
<div class="content">
	<!-- Form inputs -->
	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Create a Checkout Button</h5>
		</div>
		<div class="card-body">

			<p class="mb-4" style="color: #797979;font-size: 14px;">You can easily accept payments or donations on your existing wix, wordpress, weebly, custom website and more. All you have to do is copy and paste the code from the textbox and voila.</p>

			<form action="#">
				@csrf
				<input type="hidden" name="username" id="username" value="{{base64_encode(Auth::user()->username)}}">
				<input type="hidden" name="invoice_id" id="invoice_id" value="{{$invoice_id}}">

				<div class="form-group row">
					<label class="col-form-label col-lg-3 text-right" style="color: #797979;font-size: 14px;font-weight:600;">Choose a Price</label>
					<div class="col-lg-4">
						<input type="number" class="form-control change" name="price" id="price">
					</div>
					<label class="col-form-label col-lg-4" style="color: #797979;font-size: 14px;">The price the buyer will pay on checkout. </label>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3 text-right" style="color: #797979;font-size: 14px;font-weight:600;">Choose Payment Methods</label>
					<div class="col-lg-4">
						<select multiple="multiple" class="form-control select" name="payment_method_id[]" id="coupon_payment_method_id" data-placeholder="Please select payment method">
							@foreach($paymentMethod as $paymentMethod)
							<option value="{{$paymentMethod->id}}">{{$paymentMethod->name}}</option>
							@endforeach
						</select>
					</div>
					<label class="col-form-label col-lg-4" style="color: #797979;font-size: 14px;">The buyer will be able to choose from these payment methods.</label>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3 text-right" style="color: #797979;font-size: 14px;font-weight:600;">Browser Redirect URL (optional)</label>
					<div class="col-lg-4">
						<input type="url" class="form-control change" id="browserRedirectURL" name="browserRedirectURL" placeholder="URL to redirect buyer to after purchase">
					</div>
					<label class="col-form-label col-lg-4" style="color: #797979;font-size: 14px;">The URL to redirect the buyer to after payment.</label>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3 text-right" style="color: #797979;font-size: 14px;font-weight:600;">IPN URL (optional)</label>
					<div class="col-lg-4">
						<input type="url" class="form-control change" id="ipnRedirectURL" name="ipnRedirectURL" placeholder="Server URL to send order notifications to">
					</div>
					<label class="col-form-label col-lg-4" style="color: #797979;font-size: 14px;">The URL to send purchase notifications to. Learn more here.</label>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-lg-3 text-right" style="color: #797979;font-size: 14px;font-weight:600;">Customer Information</label>
					<div class="col-lg-4">
						<div class="custom-control custom-checkbox" style="margin-top: 10px">							
							<input type="checkbox" class="custom-control-input change" id="custom_checkbox_stacked_checked" name="collectBuyerShipping" value="1">
							<label class="custom-control-label" for="custom_checkbox_stacked_checked" style="color: #797979;font-size: 14px;">Collect Buyer's Shipping Address </label>
						</div>
					</div>
				</div>

				<!-- <div class="form-group row">
					<label class="col-form-label col-lg-3 text-right" style="color: #797979;font-size: 14px;font-weight:600;">Payment Button Type</label>
					
					<div class="col-lg-9">
						<div class="row">
							<div class="col-sm-4">
								<label style="margin-top: 9px">Show checkout in a popup (iframe) </label>
							</div>
							<div class="col-sm-4 form-check form-check-switchery">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input-switchery" checked data-fouc>
									Redirect buyer to checkout. 
								</label>
							</div>
						</div>
					</div>
					
				</div> -->

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<div class="pull-right">
								<span id="copiedMessage" style="display: none;margin-right: 10px">Copied</span>
								<span id="copyBtn"></span>
							</div>

							<label class="col-form-label col-lg-3 text-right" style="font-weight: 700;color:#797979;font-size:14px">Embed Code:</label>
							<textarea class="form-control" id="embedCode"  rows="5"></textarea>
						</div>
						<div class="col-md-6">
							<label class="col-form-label text-right" style="font-weight: 700;color:#797979;font-size:18px">Preview Button:</label>
							<p id="buttonPreview"></p>
						</div>
					</div>
					
				</div>

				<!-- <div class="text-right">
					<button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
				</div> -->
			</form>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

	var typingTimer;                //timer identifier
    var doneTypingInterval = 2000;  //time in ms, 2.5 second for example
    var $input             = $('.change');

    //on keyup, start the countdown
    $input.on('input', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(btnDetails, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    function btnDetails(){
    	var token          = $('input[name="_token"]').val();
    	var price = $("#price").val(); 
    	var invoice_id = $("#invoice_id").val(); 
    	var browserRedirectURL  = $("#browserRedirectURL").val(); 
    	var ipnRedirectURL 		= $("#ipnRedirectURL").val(); 
    	var username 			= $("#username").val(); 
    	var custom_checkbox_stacked_checked = $("#custom_checkbox_stacked_checked").val();
    	var url  		 		= SITE_URL+'/merchants/invoice/'+username+'/'+invoice_id;
    	var ajaxurl  		 	= SITE_URL+'/merchants/buy-button';
    	var buyerShipping;

    	if($("#custom_checkbox_stacked_checked").prop('checked')){
    		var buyerShipping  	 = 1;
 		 } else {
 			var buyerShipping  	 = 0;
 		 }

    	$.ajax({
    		url:ajaxurl,
    		method:'post',
    		dataType:'json',
    		async:false,
    		data:{
    			'invoice_id'        :invoice_id,
    			'price'             :price,
    			'browserRedirectURL':browserRedirectURL,
    			'ipnRedirectURL'    :ipnRedirectURL,
    			'buyerShipping'    	:buyerShipping,
    			'_token':token
    		}

    	})

    	var payButton=`<a href="${url}" target="_blank" style="background-color:#81c868 ; width:200px; color: #FFFFFF;
    		text-align: center;border-radius: 4px;border: none; padding:15px;cursor: pointer;display: inline-block;">Buy Now</a>`;

    	$('#buttonPreview').html(payButton);
    	$('#embedCode').text(payButton);
    }

    
</script>
@endpush