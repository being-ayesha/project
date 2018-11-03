@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card">

			<div class="card-body">
				<form action="{{url('seller/product-groups')}}" method="post" id="productGroupForm">
					<a class="rocketr-embed" data-product="c639ce9a5ca8" data-color="#81C868" data-text="Buy Now" data-width="200px"  href="https://rocketr.net/buy/c639ce9a5ca8">Buy Now</a><script type="text/javascript" src="https://static.rocketr.net/assets/RocketrButton.js"></script>
					<fieldset class="mb-3">
						<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Add a product group</p>
						{{@csrf_field()}}
						<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Product Group Title <span class="text-danger">*</span></label>
							<input type="text" name="product_group_title" id="product_group_title" value="{{old('product_group_title')}}" class="form-control" placeholder="Product group title">
							<span class="text-danger errProductGroupName"></span> 
							@if($errors->has('product_group_title'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('product_group_title')}}
							   </div>
							@endif
						</div>
						<div class="form-group">
						      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Select the products you wish to add to this product group: <span class="text-danger">*</span></label>
						      <select multiple="multiple" class="form-control select" name="product_id[]" id="product_id" data-placeholder="Please select products..">
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
					</fieldset>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	<!-- /form inputs -->
	<!-- Product Groups Datatables -->
	<div class="card">
    	<div class="card-body">
    		<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">View Product Groups</p>
			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush