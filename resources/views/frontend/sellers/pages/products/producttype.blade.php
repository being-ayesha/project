@extends('frontend.sellers.template')
@section('content')
	<!-- Form inputs -->
		<div class="card">

			<div class="card-body">
				<form action="{{url('seller/add-product-type')}}" class="form-control" method="post" enctype="multipart/form-data">
					<fieldset class="mb-3">
						<legend class="text-uppercase font-size-sm font-weight-bold">Product Type</legend>
						{{@csrf_field()}}
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Name</label>
							<div class="col-lg-10">
								<input type="text" name="name" class="form-control" placeholder="Product type name">
								@if($errors->has('name'))
								   <div class="form-text text-danger">
								   	  {{$errors->first('name')}}
								   </div>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-lg-2">Description</label>
							<div class="col-lg-10">
								<textarea rows="3" cols="3" name="description" class="form-control" placeholder="Product type description"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-lg-2">Photo</label>
							<div class="col-lg-10">
								<input type="file" name="photo" class="form-control">
								@if($errors->has('photo'))
								   <div class="form-text text-danger">
								   	  {{$errors->first('photo')}}
								   </div>
								@endif
							</div>
						</div>
					</fieldset>


					<div class="text-right">
						<button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
					</div>
				</form>
			</div>
		</div>
	<!-- /form inputs -->
@endsection