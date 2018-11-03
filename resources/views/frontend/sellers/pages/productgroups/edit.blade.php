@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card">

			<div class="card-body">
				<form action="{{url('seller/edit-product-groups')}}/{{$ProductGroups->id}}" method="post">
					<fieldset class="mb-3">
						<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Update product group</p>
						{{@csrf_field()}}
						<div class="form-group">
							<label style="font-weight: 700;color:#797979;font-size:14px">Product Group Title <span class="text-danger">*</span></label>
							<input type="text" readonly style="background: #ddd" name="product_group_title" class="form-control" value="{{$ProductGroups->product_group_title}}" placeholder="Product group title">
							@if($errors->has('product_group_title'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('product_group_title')}}
							   </div>
							@endif
						</div>
						<div class="form-group">
						      <label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Select the products you wish to add to this product group: <span class="text-danger">*</span></label>
						      <select multiple="multiple" class="form-control select" name="product_id[]" id="product_id" data-placeholder="Please select products..">
							        @for($i=0;$i<count($products);$i++)
							        	<option value="{{$products[$i]['id']}}" {{in_array($products[$i]['product_title'],$groupProducts)?'selected="selected"':''}}>{{$products[$i]['product_title']}}</option>
							        @endfor
							  </select>
							  @if($errors->has('product_id'))
							   <div class="form-text text-danger">
							   	  {{$errors->first('product_id')}}
							   </div>
							@endif
	      				</div>
					</fieldset>


					<div class="text-right">
						<button type="submit" class="btn btn-primary">Update <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	<!-- /form inputs -->
@endsection
