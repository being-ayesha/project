@extends('frontend.sellers.template')
@section('content')
    <div class="card">
    	<div class="card-body">
            <p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Order List</p>
    		@if (Request::segment(3) == 'unpaid')
    			<a href="{{url('seller/orders/paid')}}" class="btn btn-light pull-right" style="background: #26a69a; color: #fff; height: 35px;width: 198px;margin: -40px 2px 5px 0px">Hide Unpaid Order</a> 
    		@else
    			<a href="{{url('seller/orders/unpaid')}}" class="btn btn-light pull-right" style="background: #26a69a; color: #fff; height: 35px;width: 198px;margin: -40px 2px 5px 0px">Show Unpaid Order</a> 
    		@endif

			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush