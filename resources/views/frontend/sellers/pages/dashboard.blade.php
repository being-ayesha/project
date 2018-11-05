@extends('frontend.sellers.template')
@section('content')
<div class="row">
	<div class="col-lg-4">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Amount Made</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
					<i class="fa fa-dollar fa-2x" style="color:#26a69a"><span style="color:#26a69a; font-size: 30px; margin-left: 5px">0.00</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : 0.00</p>
					<p style="color: #98a6ad"> Last Week : 0.00</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Number Sales</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
				<i class="fa fa-cart-plus fa-2x" style="color:#81c868"><span style="color:#81c868; font-size: 30px; margin-left: 5px">0</span></i>
				<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : 0.00</p>
				<p style="color: #98a6ad"> Last Week : 0.00</p>
			</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card" align="center">
			<div class="card-header" >
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Product Views</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
					<i class="fa fa-eye fa-2x" style="color:#7266ba"><span style="color:#7266ba; font-size: 30px; margin-left: 5px">0</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : 0.00</p>
					<p style="color: #98a6ad"> Last Week : 0.00</p>
				</div>
				
			</div>
		</div>
	</div>
</div>

<div class="card">
    	<div class="card-body">
    		<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">Latest 10 orders</p>
			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush