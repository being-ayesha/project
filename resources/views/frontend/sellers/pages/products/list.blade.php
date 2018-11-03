@extends('frontend.sellers.template')
@section('content')
    <div class="card">
    	<div class="card-body"> 
			{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
		</div>
	</div>
@endsection
@push('scripts')
{!! $dataTable->scripts() !!}
@endpush