@extends('frontend.affiliates.template')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Register for a new Affiliate Product</h6>
			</div>

			<div class="card-body">
				<form action="{{url('affiliates/products')}}" method="post" id="productUrlForm">				
					@csrf	
					<div class="form-group row">
						<label class="col-form-label col-lg-2">Product ID:</label>
						<div class="col-lg-12">
							<input type="text" class="form-control" placeholder="Product url: e.g. {{url('buy/xxxxx/yyyy')}}" name="product_url">
							@if($errors->has('product_url'))
							<div class="form-text text-danger">
								{{$errors->first('product_url')}}
							</div>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-12">	
							<button type="submit" class="btn bg-teal-400 btn-labeled btn-md">Register To be an affiliate</button>	
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body"> 
		{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
	</div>
</div>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}

<script type="text/javascript">
	$(function(){
		$('#productUrlForm').validate({
			rules: {
				product_url:{
					required: true
				},
			},
		});
	});
</script>

@endpush