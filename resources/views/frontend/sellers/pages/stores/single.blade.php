@extends('frontend.sellers.pages.stores.template')
@section('storeContent')
<div class="row" style="margin-top: 30px;">
	      <div class="col-sm-7">
	      	 <div class="card">
	      	 	<div class="card-body">
                        <div style="margin-bottom: 10px;">
                            @if(@$product->product_photo)
                            	<img style="height: 200px;width: 100%" class="rounded" src="{{url('public/uploads/sellers/products')}}/{{$product->product_photo}}" alt="{{$product->product_title}}">                                
                        	@else
                        		<img style="height: 200px;width: 100%" class="rounded" src="{{url('public/uploads/sellers/products')}}/{{$product->product_photo}}" alt="{{$product->product_title}}">
                        	@endif
                        </div>
                        <div class="panel-heading" style="margin-bottom: 20px;">
                            <h1 class="m-t-30"> {{$product->product_title}}</h1>
                        </div>
                        <div class="panel-body">
                            <div style="text-align: justify;">
                                <p>{!!$product->product_description!!}</p>                                        
                            </div>
                        </div>
		        </div>
	        </div>
	      </div>
	      <div class="col-sm-5">
		        <div class="card" style="margin-bottom: 30px;">
		            <div class="card-body">
		            	<div class="alert alert-success alert-dismissible customAlertSuccess" style="display: none;">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <span class="successMsg"></span>
						</div>
						<div class="alert alert-danger alert-dismissible customAlertError" style="display: none;">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <span class="errorMsg"></span>
						</div>
						
						@if(@$affiliates!=null)
						<form action="{{url('buy')}}/{{base64_encode($product->user->username)}}/{{$product->product_uuid}}/{{base64_encode($affiliates->username)}}" method="post">
					    @else
						<form action="{{url('buy')}}/{{base64_encode($product->user->username)}}/{{$product->product_uuid}}" method="post">
						@endif
				            	@csrf
				            	<input type="hidden" name="payment_method_id" id="payment_method_id" value="{{$product->paymentMethod->id}}">
				            	<input type="hidden" name="product_id" id="product_id" value="{{base64_encode($product->id)}}">
				            	<input type="hidden" name="quantity" id="quantity" value="1">
				            	<input type="hidden" id="seller_id" name="seller_id" value="{{base64_encode($product->user->id)}}">
				            	<input type="hidden" name="originalAmnt" class="originalAmnt" value="{{$product->price}}">
				            	<input type="hidden" name="max_stock" class="max_stock" value="{{$product->stock}}">
				            	<div class="paymentAmount" style="text-align: center;color: #26a69a;font-weight: bold;font-size: 30px;">
				            		<span class="currency">$</span><span class="amount">&nbsp;{{number_format($product->price,2)}}</span>
				       		        <h1><button disabled class="btn btn-md" style="background: #26a69a;color: #fff"><i class="fa fa-paypal"></i>&nbsp;{{$product->paymentMethod->name}}</button></h1>
				            	</div>
				            	@if($product->productType->name!='File')
					            	@if($product->stock!=0)
						            	<div class="m-b-10 text-center">
				                                <button type="button" class="btn btn-sm btn-success bootstrap-touchspin-up" onclick="decreaseValue()" id="decreaseItem">
				                                    <i class="fa fa-minus"></i>
				                                </button>
				                                <span id="quantity-text">1</span>
				                                <button type="button" class="btn btn-sm btn-success bootstrap-touchspin-up" onclick="increaseValue()" id="increaseItem">
				                                    <i class="fa fa-plus"></i>
				                                </button>
				                        </div>
			                        @endif
		                        @endif
		                        @if($activeCouponsCnt>0 && $product->stock!=0)
			                        <div class="row" style="margin-top: 20px;text-align: center">
				                        <div class="col-xs-12 col-md-8">
				                            <input type="text" class="form-control" name="coupon" id="couponCode" value="" placeholder="Optional Coupon Code">
				                        </div>
				                        <div class="col-xs-12 col-md-4">
				                            <button type="button" class="btn btn-success btn-md form-control" id="validateCouponCode">Validate</button>
				                        </div>
				                    </div>
			                    @endif
			                    <br>
			                    @if($product->stock==0)
			                    	<button type="submit" disabled class="btn btn-success btn-lg btn-block">Out of Stock</button>		            	
			                    @else
			                    	<button type="submit" id="buyNowButton" class="btn btn-success btn-lg btn-block">Buy Now </button>		            	
				            	@endif
		            	</form>
		            </div>
		        </div>
		        <div class="card">
		            <div class="card-body" style="text-align: center;">
		            	<!-- <div class="row">
		            		<div class="col-xs-12 col-md-4">
		            			<button class="btn btn-sm" style="margin-bottom: 5px;background: #3B5998;width: 100%">
		            				<i class="fa fa-facebook"></i>&nbsp;<span class="socialIcon">Share</span>
		            			</button>
		            		</div>
		            		<a class="btn" target="_blank" href="http://www.facebook.com/sharer/sharer.php?s=100&amp;p[title]=<?php echo urlencode($product->product_title);?>&amp;p[summary]=<?php echo urlencode($product->product_description) ?>&amp;p[url]=<?php echo urlencode(url('/')); ?>&amp;p[images][0]=<?php echo urlencode(url('public/uploads/sellers/products'.'/'.$product->product_photo)); ?>">Share</a>
		            		<div class="col-xs-12 col-md-4">
		            			<button class="btn btn-sm" style="margin-bottom: 5px;background: #55ACEE;width: 100%">
		            				<i class="fa fa-twitter"></i>&nbsp;<span class="socialIcon">Tweet</span>
		            			</button>
		            		</div>
		            		<div class="col-xs-12 col-md-4">
		            			<button class="btn btn-sm btn-success" style="margin-bottom: 5px;background: #cb2027;width: 100%">
		            				<i class="fa fa-pinterest"></i>&nbsp;<span class="socialIcon">Save</span>
		            			</button>
		            		</div>
		            	</div>
		            	<hr/> -->
		            	<div class="text-center">
		            		   @if(@$product->user->profile_photo)
                               		<img style="border:1px solid #ddd" src="{{url('public/uploads/sellers/profilephoto')}}/{{$product->user->profile_photo}}" class="imgCircle profile-image" alt="profile-image" name="image"><br>
                               @else
                               		<img style="border:1px solid #ddd" src="{{url('public/uploads/sellers/profilephoto')}}/nouser.jpg" class="imgCircle profile-image" alt="profile-image" name="image"><br>
                               @endif
                               <h4>Seller: <a href="{{url('sellers')}}/{{$product->user->username}}" target="_blank">{{$product->user->username}}</a></h4>                                            
                               <!-- <a href="#message-seller" class="btn btn-primary btn-small waves-effect waves-light" data-animation="blur" data-plugin="custommodal" data-overlayspeed="100" data-overlaycolor="#36404a">Message Seller</a> -->
                        </div>
						<hr/>
                        <div class="row">
                            <table class="col-md-12 product-attributes-table">
	                            <tbody>
	                            	<tr>
	                            		<td class="text-left"><h6>Stock</h6></td>
	                            		<td class="text-right">
	                            			<h6>
			                            		<span style="color:red">
			                            			@if($product->stock=='-1')
			                            				Unlimited
			                            			@else
			                            				{{$product->stock}}
			                            			@endif
			                            		</span>
			                            	<h6>
	                            		</td>
	                            	</tr>
	                            	<tr>
	                            		<td class="text-left"><h6>Product Type</h6></td>
	                            		<td class="text-right"><h6>{{$product->productType->name}}<h6></td>
	                            	</tr>                                            
	                            </tbody>
	                        </table>
                        </div>
		            </div>
		        </div>
	      </div>

  </div>
@endsection
@push('scripts')

<script type="text/javascript">
	$(window).on('load',function(){
		var token            = $('input[name="_token"]').val();
		var seller_id     	 = $('#seller_id').val();
		var product_id    	 = $('#product_id').val();
		var store_product_id = localStorage.getItem("store_product");
		
		localStorage.setItem('store_product', product_id);
			var url           = SITE_URL+'/product-view';
			$.ajax({
				url:url,
				method:"post",
				dataType:'json',
				async:false,
				data:{
				"_token":token,
				"seller_id":seller_id,
				'product_id':product_id
				},
			});
		
	})
</script>

	<script type="text/javascript">
		var latestAmnt = '';
		var originalAmnt = '';
		function increaseValue() {
		  $('#decreaseItem').removeAttr('disabled');
		  var value = parseInt(document.getElementById('quantity-text').innerHTML, 10);
		  value     = isNaN(value) ? 0 : value;
		  var max_stock  = $('.max_stock').val();
		  value==max_stock?$('#increaseItem').attr('disabled',true):value++;
		  //value++;
		  document.getElementById('quantity-text').innerHTML = value;
		  originalAmnt   = parseFloat($('.originalAmnt').val());
		  latestAmnt     = originalAmnt*value;
		  $('.amount').text(latestAmnt.toFixed(2));
		  $('#quantity').val(value);
		}

		function decreaseValue() {
		  $('#increaseItem').removeAttr('disabled');
		  var value = parseInt(document.getElementById('quantity-text').innerHTML, 10);
		  value     = isNaN(value) ? 0 : value;
		  value==1?$('#decreaseItem').attr('disabled',true):value--;
		  var amount   = parseFloat($('.amount').text());
		  originalAmnt = parseFloat($('.originalAmnt').val());
		  if(amount==originalAmnt){
		  		latestAmnt   = originalAmnt;
		  }else{
		  		latestAmnt   = (amount-originalAmnt);
		  }
		  $('.amount').text(latestAmnt.toFixed(2));
		 /* if(value==1){
		  	$('#decreaseItem').attr('disabled',true);
		  }else{
			value--;
		  }*/
		  //value < 1 ? value = 1 : '';
		  document.getElementById('quantity-text').innerHTML = value;
		  $('#quantity').val(value);
		}

		//validate coupon code starts here
		$(document).on('click','#validateCouponCode',function(){
		        var token         = $('input[name="_token"]').val();
		        var couponCode    = $('#couponCode ').val();
		        var seller_id     = $('#seller_id').val();
		        var product_id    = $('#product_id').val();
		        var url           = SITE_URL+'/seller/product-coupon-code-check';
		        if(couponCode){
		            $.ajax({
		              url:url,
		              method:"post",
		              dataType:'json',
		              async:false,
		              data:{
		                "_token":token,
		                "couponCode":couponCode,
		                "seller_id":seller_id,
		                'product_id':product_id
		              },
		              success:function(response){
		                if(response.status==1){
		                	var discountAmnt = response.discountAmount;
		                	$('.customAlertError').css('display','none');
		                	$('.customAlertSuccess').css('display','block');
		                	$('.originalAmnt').val(discountAmnt);
		                	$('.amount').text(discountAmnt.toFixed(2));
		                	$('.successMsg').html(response.message);
		                }else{
		                	$('.customAlertSuccess').css('display','none');
		                	$('.customAlertError').css('display','block');
		                    $('.errorMsg').html(response.message);
		                    return false;
		                }
		              }
		            });
		        }
		});
	</script>
@endpush