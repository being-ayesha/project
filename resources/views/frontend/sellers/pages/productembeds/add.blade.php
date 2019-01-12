@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->

	

	<div class="card">
		<div class="card-body">
			<form action="{{url('seller/add-coupon')}}" method="post" id="productCuponForm">

				<fieldset class="mb-3">
					<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">You can embed your product on your existing wix, wordpress, weebly, custom website and more. All you have to do is copy and paste the code from the textbox.</p>
					<input type="hidden" name="username" id="username" value="{{base64_encode(Auth::user()->username)}}">
					<input type="hidden" name="currency" id="currency" value="{{$currency}}">
					@csrf	
					<div class="form-group row">
						<div class="col-md-6">  
							<label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Product <span class="text-danger">*</span></label>
							<select class="form-control change" name="product_id" id='product_id'>
								<option value="">Select products</option>
								@foreach($products as $product)
								<option value="{{$product->product_uuid}}" data-price="{{$product->price}}">{{$product->product_title}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label style="font-weight: 700;color:#797979;font-size:14px">Choose button text</label>
							<input type="text" name="button_text" id="button_text" value="Buy Now" class="form-control change">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label style="font-weight: 700;color:#797979;font-size:14px">Choose button width (advanced)</label>
							<input type="text" name="button_width" id="button_width" value="200px" class="form-control change">
							
						</div>
						<div class="col-md-6">
							<label style="font-weight: 700;color:#797979;font-size:14px">Choose button color (optional)</label>
							<input type="text" name="button_color" id="button_color" value="#81C868" class="form-control change">	
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<div class="form-check">
								<label class="form-check-label" style="font-weight: 700;color:#797979;font-size:14px">
									<input type="checkbox" class="form-check-input-styled change" id="priceCheck" data-fouc>
									Show Price on Button
								</label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-check">
								<label class="form-check-label" style="font-weight: 700;color:#797979;font-size:14px">
									<input type="checkbox" class="form-check-input-styled change" id="separator" data-fouc>
									Show Separator
								</label>
							</div>
						</div>
						
					</div>

					<div class="form-group row">
						<div class="col-md-6">
							<div class="pull-right">
								<span id="copiedMessage" style="display: none;margin-right: 10px">Copied</span>
								<span id="copyBtn"></span>
							</div>

							<label style="font-weight: 700;color:#797979;font-size:14px">Embed Code:</label>
							<textarea class="form-control" id="embedCode" disabled="disabled" rows="5"></textarea>
						</div>
						<div class="col-md-6">
							<label style="font-weight: 700;color:#797979;font-size:14px">Preview Button:</label>
							<p id="buttonPreview"></p>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<!-- /form inputs -->
@endsection

@push('scripts')
<script type="text/javascript" src="{{url('public/js/custom/product_embaded_encode.js')}}"></script>
@endpush




