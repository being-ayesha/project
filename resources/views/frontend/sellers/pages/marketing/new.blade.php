@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card">
			<div class="card-body">
				<form action="{{url('seller/new-marketing')}}" method="post" id="newMarketingFrom">
						<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">New Marketing Email</p>
						@csrf

						<div class="form-group">
							<label for="from" style="font-weight: 700;color:#797979;font-size:14px">From<span class="text-danger">*</span></label>
							<p>
								<input type="text" class="form-control" id="from"  name="from" value="{{$from}}" readonly="readonly">
							</p>
							<span class="text-danger errFrom"></span>
						</div>

						<div class="form-group">
							<label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Select Buyers you'd like to e-mail: <span class="text-danger">*</span></label>
							<select multiple="multiple" class="form-control select" name="buyers_email[]" id="buyers_email_new" data-placeholder="Please select buyers..">
								<option value="1">All Buyers</option>
								<option value="2">All Buyers who didn't go through with purchase</option>
							</select>
							<div class="error_buyer_email"></div>
							@if($errors->has('buyers_email'))
							 <div class="form-text text-danger">
							   	  {{$errors->first('buyers_email')}}
							   </div>
							@endif
						</div>

						<div class="form-group">
							<label for="title" style="font-weight: 700;color:#797979;font-size:14px">Subject<span class="text-danger">*</span></label>
							<p>
								<input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
							</p>
							@if($errors->has('subject'))
							 <div class="form-text text-danger">
							   	  {{$errors->first('subject')}}
							   </div>
							@endif
						</div>
						<div class="form-group">  
							<label for="message" style="font-weight: 700;color:#797979;font-size:14px">Message</label>
							<p>
								<textarea class="form-control my-message" id="full-editor" placeholder="Message.." name="content"></textarea>
							</p>
							@if($errors->has('message'))
							 <div class="form-text text-danger">
							   	  {{$errors->first('message')}}
							   </div>
							@endif
							<div class="error" id="err_message"></div>
						</div>

						<div class="text-right">
							<button type="submit" class="btn btn-primary">Send <i class="icon-paperplane ml-2"></i></button>
						</div>
				</form>
			</div>
		</div>
	<!-- /form inputs -->
@endsection

@push('scripts')
  <script type="text/javascript">
  	$(function(){	
	  //Ckeditor enable
	  CKEDITOR.replace('full-editor');
	  
	});

  	$( "#newMarketingFrom" ).submit(function( event ) {
  		var messageLength =  CKEDITOR.instances['full-editor'].getData();
		if(messageLength==""){
			$('#err_message').html("This field is required.");
			return false;
		}
		else{
			$('#err_message').html("");
			return true;
		}
  		event.preventDefault();
  	});

  </script>
@endpush