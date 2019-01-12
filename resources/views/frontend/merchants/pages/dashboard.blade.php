@extends('frontend.merchants.template')
@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Revenue</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
					<i class="fa fa-{{@$currency}} fa-2x" style="color:#26a69a"><span style="color:#26a69a; font-size: 30px; margin-left: 5px"> {{($order!=NULL)?$order->totalAmount():'0'}}</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours :{{($order!=NULL)?$order->dailyAmount():'0'}}</p>
					<p style="color: #98a6ad"> Last Week : {{($order!=NULL)?$order->WeeklyAmount():'0'}}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card" align="center">
			<div class="card-header">
				<p class="font-size-sm" style="font-weight: 700;color:#797979;font-size:14px">Number of Orders</p>
			</div>
			<div class="card-body">
				<div style="margin-top: -20px">
					<i class="fa fa-cart-plus fa-2x" style="color:#26a69a"><span style="color:#26a69a; font-size: 30px; margin-left: 5px"> {{($order!=NULL)?$order->totalOrder():'0'}}</span></i>
					<p style="color: #98a6ad; margin-top: 5px"> Last 24 hours : {{($order!=NULL)?$order->dailyOrder():'0'}}</p>
					<p style="color: #98a6ad"> Last Week :{{($order!=NULL)?$order->weeklyOrder():'0'}}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Next steps</h6>
			</div>

			<div class="card-body">
				<div class="table-responsive">

					<table class="table text-nowrap">
						<tbody>
							<tr style="background: #26a69a;">
								<td>
									<a href="{{url('merchants/settings/profile')}}" style="text-decoration: none;color: white; {{($profile==1)?'pointer-events: none;text-decoration: line-through;':''}}">
									<div class="d-flex align-items-center">
										<div class="mr-2">
											<span class="fa-stack">
												<span class="fa fa-circle-o fa-stack-2x"></span>
												<strong class="fa-stack-1x">
													1    
												</strong>
											</span>
										</div>
										<p style="font-size: 16px;margin-top: 10px;">Complete Profile</p>
										
									</div>
								</a>
								</td>
							</tr>

							<tr style="background: #26a69a;">
								<td>
								<a href="{{url('merchants/settings/payment')}}" style="text-decoration: none;color: white;{{($paymentSetting>=1)?'pointer-events: none;text-decoration: line-through;':''}}">
									<div class="d-flex align-items-center">
										<div class="mr-2">
											<span class="fa-stack">
												<span class="fa fa-circle-o fa-stack-2x"></span>
												<strong class="fa-stack-1x">
													2    
												</strong>
											</span>
										</div>
										<p style="font-size: 16px;margin-top: 10px;">Configure Payment Options Profile</p>
									</div>
								</a>
								</td>
							</tr>

							<tr style="background: #26a69a;">
								<td>
								<a href="{{url('merchants/settings/security')}}" style="text-decoration: none;color: white {{($user_details==1)?'pointer-events: none;text-decoration: line-through;':''}}">
									<div class="d-flex align-items-center">
										<div class="mr-2">
											<span class="fa-stack">
												<span class="fa fa-circle-o fa-stack-2x"></span>
												<strong class="fa-stack-1x">
													3    
												</strong>
											</span>
										</div>
										<p style="font-size: 16px;margin-top: 10px;">Enable 2 Factor Authentication</p>
									</div>
								</a>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection