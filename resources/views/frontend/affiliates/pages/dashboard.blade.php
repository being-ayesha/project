@extends('frontend.affiliates.template')
@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Commission Made</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
					<i class="fa fa-usd fa-2x" style="color:#26a69a"><span style="color:#26a69a; font-size: 30px; margin-left: 5px">{{$total_commission_made}}</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours :{{$daily_commission_made}} </p>
					<p style="color: #98a6ad"> Last Week :{{$weekly_commission_made}}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Number Sales</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
				<i class="fa fa-cart-plus fa-2x" style="color:#81c868"><span style="color:#81c868; font-size: 30px; margin-left: 5px">{{$number_of_sale}}</span></i>
				<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : {{$daily_sale}}</p>
				<p style="color: #98a6ad"> Last Week : {{$weekly_sale}}</p>
			</div>
			</div>
		</div>
	</div>
	
</div>
@endsection