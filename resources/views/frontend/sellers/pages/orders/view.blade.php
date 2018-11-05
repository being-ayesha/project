@extends('frontend.sellers.template')
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
								if($yesterday==date('Y-m-d',strtotime($order->order_date))){
									echo "Yesterday at ".date('H:i:s A',strtotime($order->order_date));
								}else if($today==date('Y-m-d',strtotime($order->order_date))){
									echo "Today at ".date('H:i:s A',strtotime($order->order_date));
								}else{
									echo date("F d Y H:i A", strtotime($order->order_date));
								}
								@endphp
								</td>	

							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Order Id</td>
								<td style="padding: 5px;color: #2196f3">{{$order->order_uuid}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Status</td>
								<td style="padding: 5px;color: #2196f3">
									@if($order->payment_status=='paid')
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
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Buyer Country</td>
								<td style="padding: 5px;color: #2196f3">{{$order->buyer_country}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Product</td>
								<td style="padding: 5px;color: #2196f3">{{$order->product->product_title}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Quantity</td>
								<td style="padding: 5px;color: #2196f3">{{$order->product_quantity}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Coupon</td>
								<td style="padding: 5px;color: #2196f3">{{$order->coupon_code}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Buyer Ip</td>
								<td style="padding: 5px;color: #2196f3">{{$order->buyer_ip}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">HTTP Reffer</td>
								<td style="padding: 5px;color: #2196f3">{{$order->http_referer}}</td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Affiliate Informations <br>Notes</td>
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
								<td style="padding: 5px;color: #2196f3">{{$order->payment->name}}</td>	
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Transaction Id</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Payment Status</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal E-mail</td>
								<td style="padding: 5px;color: #2196f3">{{$order->buyer_email}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Amount Paid</td>
								<td style="padding: 5px;color: #2196f3">{{$order->amount}}</td>
							</tr>

							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal Fees</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal Sender Name</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Paypal Sender Address</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Receiver E-mail</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>
							<tr>
								<td style="font-size: 14px;font-weight:600;color: #98a6ad;padding: 2px">Rocketr Fee</td>
								<td style="padding: 5px;color: #2196f3"></td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">PRODUCT DELIVERY INFORMATION</p>
					
				</div>
				<div class="card-body">
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<p class="text-uppercase font-size-sm" style="font-weight: 700;color:#797979;font-size:14px;margin-bottom: 10px">IPN INFORMATION</p>
					
				</div>
				<div class="card-body">
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
