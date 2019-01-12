@extends('frontend.sellers.template')
@section('content')
<!-- Begin MySiteAuditor -->
<!-- <script src="//cdn.mysiteauditor.com/audit-tool.js" type="text/javascript"></script>
		
<div id="seogroup-embed"  data-apikey="a66a7a51b3298619cb946aaf29fe0b4314216369" data-language="english" data-type="slim"></div> -->
<!-- End MySiteAuditor -->
<div class="row">
	<div class="col-lg-4">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Amount Made</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
					<i class="fa fa-{{$currency}} fa-2x" style="color:#26a69a"><span style="color:#26a69a; font-size: 30px; margin-left: 5px">{{($order!=NULL)?$order->totalAmount():'0'}}</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : {{($order!=NULL)?$order->dailyAmount():'0'}}</p>
					<p style="color: #98a6ad"> Last Week :{{($order!=NULL)?$order->weeklyAmount():'0'}}</p>
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
				<i class="fa fa-cart-plus fa-2x" style="color:#81c868"><span style="color:#81c868; font-size: 30px; margin-left: 5px">{{($order!=NULL)?$order->totalOrder():'0'}}</span></i>
				<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : {{($order!=NULL)?$order->dailyOrder():'0'}}</p>
				<p style="color: #98a6ad"> Last Week : {{($order!=NULL)?$order->weeklyOrder():'0'}}</p>
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
					<i class="fa fa-eye fa-2x" style="color:#7266ba"><span style="color:#7266ba; font-size: 30px; margin-left: 5px">{{($productView!=NULL)?$productView->totalviews():'0'}}</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : {{($productView!=NULL)?$productView->dailyViews():'0'}}</p>
					<p style="color: #98a6ad"> Last Week : {{($productView!=NULL)?$productView->weeklyViews():'0'}}</p>
				</div>
				
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Product Views Over Last week</h6>
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

<div class="card">
    	<div class="card-body">
    		<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">Latest 10 orders</p>
			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
@endsection
@push('scripts')
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="{{asset('public/frontend/global_assets/js/demo_pages/charts/google/lines/area_stacked.js')}}"> </script>
{!! $dataTable->scripts() !!}
@endpush