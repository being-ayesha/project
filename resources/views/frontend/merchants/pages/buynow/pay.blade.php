@extends('frontend.sellers.pages.stores.template')
@section('storeContent')
<div class="col-md-5 offset-md-3" style="margin-top: 100px;">
<div class="card">
	<div class="card-header bg-primary text-white header-elements-inline">
		<h6 class="card-title">CHECKOUT</h6>
	</div>
	<div class="card-body">
		<div class="row" style="margin-bottom: -15px">
			<div>
				<h4><i class="fa fa-user-circle fa-2x" style="color: #2196f3"></i></h4>
			</div>
			<div>
				<h4 style="padding-left: 10px">{{$user_details->email}}</h4>
			</div>
			<div>
				<label class="col-form-label" style="padding-left: 10px;margin-left: 100px;color:#4caf50;font-size: 15px;font-weight:602;"> ${{$payment_details->price}}</label>
			</div>
		</div>
		<hr>
		<form action="{{url('merchants/pay-now')}}" method="post" id="marcent_email_form">
			@csrf
			<input type="hidden" name="username"       		 value="{{$username}}">
			<input type="hidden" name="price"          		 value="{{$payment_details->price}}">
			<input type="hidden" name="invoice_id"     		 value="{{$payment_details->invoice_id}}">
			<input type="hidden" name="buyer_shipping" 		 value="{{$payment_details->buyer_shipping}}">
			<input type="hidden" name="browser_redirect_url" value="{{@$payment_details->browser_redirect_url}}">
			<input type="hidden" name="ipn_redirect_url"     value="{{@$payment_details->ipn_redirect_url}}">
			
			<div class="form-group row">
				<label class="col-form-label col-lg-2 text-right" style="color: #797979;font-size: 14px;font-weight:600;">Email</label>
				
				<div class="col-lg-10">
					<input type="email" class="form-control" name="mail" id="email" placeholder="Please enter your email address">
				</div>
			</div>
			<button type="submit" class="btn btn-success btn-block">Buy Now</button>
		</form>
	</div>
</div>
</div>
@endsection
@push('scripts')
 <script type="text/javascript">
 	$('#marcent_email_form').validate({
 		rules:{
 			mail:{
 				required:true,
 				email:true
 			}
 		}
 	});
 </script>
@endpush