@extends('frontend.sellers.template')
@section('content')
    <div class="card">
    	<div class="card-body"> 
    		<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 5px">Coupon List</p>
			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush