@extends('frontend.sellers.pages.stores.template')
@section('storeContent')
  <div class="col-md-6 offset-md-3" style="margin-top: 100px;">
	  <div class="card">
	        <div class="card-body">
	        	<form action="{{url('pay-now')}}" method="post" id="buyer_email_form">
		        	@csrf
	        		<input type="hidden" name="product_id" value="{{$product->id}}">
	        		<input type="hidden" name="order_id"   value="{{$order_id}}">
	        		<input type="hidden" name="seller_id"  value="{{$user->id}}">
	        		<input type="hidden" name="affiliates_id"  value="{{@$affiliates->id}}">
		        	<div class="form-group">
		        		<label class="control-label"><h4 class="text-center">Please enter your email address to continue</h4></label>
		        		<hr>
		            	<input type="email" class="form-control" name="buyer_email" id="buyer_email" placeholder="Please enter your email address">
		        	</div>
		        	<button type="submit" class="btn btn-success btn-block">Continue</button>
	        	</form>
	        </div>
	  </div>
	</div>
@endsection
@push('scripts')
 <script type="text/javascript">
 	$('#buyer_email_form').validate({
 		rules:{
 			buyer_email:{
 				required:true,
 				email:true
 			}
 		}
 	});
 </script>
@endpush