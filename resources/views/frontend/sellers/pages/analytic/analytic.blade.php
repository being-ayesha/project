@extends('frontend.sellers.template')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<form action="{{url('seller/analytics')}}" method="post" id="analyticsForm">
				@csrf
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Select Products you wish to run analytics for:</label>
							<select multiple="multiple" class="form-control select" name="analytic_product_id[]" id="analytic_product_id" data-placeholder="Please select products..">
								@foreach($products as $product)
								<option value="{{$product->id}}" @if(@$groupProduct) {{in_array($product->id,$groupProduct)?'selected="selected"':''}} @endif>{{$product->product_title}}</option>
								@endforeach
							</select>
							<div class="error error_analytic_product_id"></div>
						</div>
					</div>

					<div class="col-md-5">
						<div class="form-group">
							<label for="product_type" style="font-weight: 700;color:#797979;font-size:14px">Select Date Range:</label>
							<button type="button" class="form-control btn btn-light daterange-predefined data_button">
								<i class="icon-calendar22 mr-2"></i>
								<span id="select_date"></span>

							</button>
						</div>
						<input type="hidden" name="select_date" class="new_value" value="">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary" style="margin-top: 27px">Generate Date</button>
					</div>

				</div>
			</form>
			</div>
			</div>
		</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Product Views</h6>
				<input type="hidden" value="{{@$viewcount}}" id="google-area-stacked_value" >
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
						<a class="list-icons-item" data-action="reload"></a>
						<a class="list-icons-item" data-action="remove"></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<!-- Area chart -->
				<div class="card-body">
					@if(@$result_product_message)
					<div class="error">{{$result_product_message}}</div>
					@elseif(@$viewcount)
					<div class="chart-container">
						<div class="chart" id="google-area-stacked"></div>
					</div>
					@else
					<div></div>
					@endif
				</div>
				<!-- /area chart -->
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Number of Orders and Amount Made </h6>
				<input type="hidden" value="{{@$ordercount}}" id="google-column-value">
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
						<a class="list-icons-item" data-action="reload"></a>
						<a class="list-icons-item" data-action="remove"></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="card-body">
					@if(@$result_order_message)
					<div class="error">{{$result_order_message}}</div>
					@elseif(@$ordercount)
					<div class="chart-container">
						<div class="chart" id="google-column"></div>
					</div>
					@else
					<div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>


</div>
@endsection
@push('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="{{asset('public/frontend/global_assets/js/demo_pages/charts/google/lines/area_stacked.js')}}"> </script>
<script type="text/javascript" src="{{asset('public/frontend/global_assets/js/demo_pages/charts/google/bars/column.js')}}"></script>
<script type="text/javascript">
	$(function(){
		$('.daterangepicker-inputs').hide();
		$('.ranges').css('width','200px');
	});
</script>
<script type="text/javascript">
	$(function(){
		$('.ranges').click(function(){
			var date =$('#select_date').text();
			$('.new_value').attr('value',date);
		});

	});

	$(function(){
		$('#analyticsForm').validate({
			rules:{
				"analytic_product_id[]":{
					required:true
				}
			},
			errorPlacement: function (error, element) {
				if(element.attr("id") == "analytic_product_id") {
					error.appendTo('.error_analytic_product_id');
				}
				else {
					error.insertAfter(element);
				}
			}

		});

	});
</script>
@endpush
