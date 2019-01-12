@extends('frontend.merchants.template')
@section('content')
	<!-- Form inputs -->
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
				<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">Order Information</p>
				</div>
				<div class="card-body">
					<table class="table table-borderless table-responsive">
						<tbody>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Date Purchased</td>
								<td style="padding: 5px;color: #2196f3">
								@php 
								$yesterday=date("Y-m-d", time()-86400);
								$today=date("Y-m-d");
								if($yesterday==date('Y-m-d',strtotime($order->created_at))){
									echo "Yesterday at ".date('H:i:s A',strtotime($order->created_at));
								}else if($today==date('Y-m-d',strtotime($order->created_at))){
									echo "Today at ".date('H:i:s A',strtotime($order->created_at));
								}else{
									echo date("F d Y H:i A", strtotime($order->created_at));
								}
								@endphp
								</td>	

							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Order Id</td>
								<td style="padding: 5px;color: #2196f3">{{$order->order_uid}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Status</td>
								<td style="padding: 5px;color: #2196f3">
									@if($order->order_status=='paid' || $order->order_status=='Paid')
									<span class='badge bg-success'>PAID</span>
									@else
									<span class='badge bg-purple'>UNPAID</span>
									@endif
								</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Buyer E-mail</td>
								<td style="padding: 5px;color: #2196f3">{{$order->buyer_email}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Notes</td>
								<td style="padding: 5px;color: #2196f3">{{$order->notes}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="card">
				<div class="card-header">
					<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">Payment Details</p>
				</div>
				<div class="card-body">
					<table class="table table-borderless table-responsive">
						<tbody>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Payment Method</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->payment->name}}</td>	
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Transaction Id</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->paymentDetails->transaction_id}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Payment Status</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->paymentDetails->payment_status}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal E-mail</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->buyer_email}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Amount Paid</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->amount}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal Fees</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->paymentDetails->payment_method_fees}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal Sender Name</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->paymentDetails->sender_name}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal Sender Address</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>

							<tr>
								<td colspan="2" style="color: #2196f3;">
									<table style="margin:-15px 0px 0px 135px">
										<tr>
											<td style="padding: 0px">Street :</td>
											<td style="padding: 0px">{{@$address->Street}}</td>
										</tr>
										<tr>
											<td style="padding: 0px">City :</td>
											<td style="padding: 0px">{{@$address->City}}</td>
										</tr>
										<tr>
											<td style="padding: 0px">State : </td>
											<td style="padding: 0px">{{@$address->State}}</td>
										</tr>
										<tr>
											<td style="padding: 0px">Zip : </td>
											<td style="padding: 0px">{{@$address->Zip}}</td>
										</tr>
										<tr>
											<td style="padding: 0px">Country : </td>
											<td style="padding: 0px">{{@$address->country_name}}</td>
										</tr>
									</table>
								</td>
							</tr>
							
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Receiver E-mail</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->paymentDetails->receiver_email}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">{{$siteName}} Fee</td>
								<td style="padding: 5px;color: #2196f3">{{@$order->paymentDetails->site_fee}}</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /form inputs -->
@endsection
@push('scripts')
<script type="text/javascript">

</script>

@endpush
