@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card">
			<div class="card-body">
				<form action="{{url('seller/add-coupon')}}" method="post" id="productCuponForm">
					<fieldset class="mb-3">
						<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">You can embed your product on your existing wix, wordpress, weebly, custom website and more. All you have to do is copy and paste the code from the textbox.</p>
						@csrf	
						<div class="form-group row">
						    <div class="col-md-6">  
							      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Product <span class="text-danger">*</span></label>
							      <select class="form-control" name="product_id">
							      			<option value="">Select products</option>
								        @foreach($products as $product)
								        	<option value="{{$product->id}}">{{$product->product_title}}</option>
								        @endforeach
								  </select>
								  @if($errors->has('product_id'))
									   <div class="form-text text-danger">
									   	  {{$errors->first('product_id')}}
									   </div>
								  @endif
							</div>
							<div class="col-md-6">
								<label style="font-weight: 700;color:#797979;font-size:14px">Choose button text</label>
								<input type="text" name="button_text" id="button_text" value="Buy Now" class="form-control">
								@if($errors->has('button_text'))
								   <div class="form-text text-danger">
								   	  {{$errors->first('button_text')}}
								   </div>
								@endif
							</div>
	      				</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label style="font-weight: 700;color:#797979;font-size:14px">Choose button width (advanced)</label>
								<input type="text" name="button_text" id="button_text" value="200px" class="form-control">
								@if($errors->has('button_text'))
								   <div class="form-text text-danger">
								   	  {{$errors->first('button_text')}}
								   </div>
								@endif
							</div>
							<div class="col-md-6">
								<label style="font-weight: 700;color:#797979;font-size:14px">Choose button color (optional)</label>
								<input type="text" name="button_text" id="button_text" value="#81C868" class="form-control">
								@if($errors->has('button_text'))
								   <div class="form-text text-danger">
								   	  {{$errors->first('button_text')}}
								   </div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label style="font-weight: 700;color:#797979;font-size:14px">Embed Code:</label>
								<textarea class="form-control" placeholder="Embed code will be shown here"></textarea>
							</div>
							<div class="col-md-6">
								<label style="font-weight: 700;color:#797979;font-size:14px">Preview Button:</label>
								<input type="text" name="button_text" id="button_text" value="#81C868" class="form-control">
								@if($errors->has('button_text'))
								   <div class="form-text text-danger">
								   	  {{$errors->first('button_text')}}
								   </div>
								@endif
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	<!-- /form inputs -->
@endsection