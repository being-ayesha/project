@extends('frontend.sellers.template')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Add Payout Log</h6>
			</div>

			<div class="card-body">
				<form action="{{url('seller/payouts')}}" method="post" id="payOutForm">
					@csrf
				<div class="row">
					<div class="col-md-12">
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Affiliate Username:</label>
								<select class="form-control" name="user_id">
									@foreach($affiliates as $affiliates)
									<option value="{{$affiliates->affiliate_id}}">{{$affiliates->affiliateUser->username}}</option>
									@endforeach	
								</select>

								@if($errors->has('user_id'))
								<div class="form-text text-danger">
									{{$errors->first('user_id')}}
								</div>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Payment Amount (in $):</label>
								<input type="number" class="form-control" placeholder="e.g. 12.20" name="amount" min='0'>

								@if($errors->has('amount'))
								<div class="form-text text-danger">
									{{$errors->first('amount')}}
								</div>
								@endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Payment Method:</label>
								<select class="form-control" name="payment_method">
									@foreach($payment_method as $payment_method)
									<option value="{{$payment_method->id}}">{{$payment_method->name}}</option>
									@endforeach	
								</select>

								@if($errors->has('payment_method'))
								<div class="form-text text-danger">
									{{$errors->first('payment_method')}}
								</div>
								@endif

							</div>
						</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Transaction ID: </label>
									<input type="text" class="form-control" placeholder="paypal Transaction ID" name="transaction_id">
									@if($errors->has('transaction_id'))
									<div class="form-text text-danger">
										{{$errors->first('transaction_id')}}
									</div>
									@endif
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label>Notes:</label>
									<input type="text" class="form-control" placeholder="Note to affiliate" name="notes">

									@if($errors->has('notes'))
									<div class="form-text text-danger">
										{{$errors->first('notes')}}
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-success" style="margin-left: 10px"> Log Payment</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body"> 
				<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">View Affiliate Payouts</p>

		{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive text-center', 'width' => '100%', 'cellspacing' => '0']) !!}
	</div>
</div>
@endsection

@push('scripts')
{!! $dataTable->scripts() !!}
<script type="text/javascript">
	$(function(){
		$('#payOutForm').validate({
			rules: {
				amount:{
					required: true
				},
				transaction_id:{
					required: true
				},
				notes:{
					required: true
				}
			},
		});
	});
</script>
@endpush