@extends('frontend.merchants.template')
@section('content')
<div class="row">
	<div class="col-md-6" >
		<a href="{{url('merchants/payment-buttons')}}" style="color: #797979">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">Payment Buttons and Links</h6>
				</div>

				<div class="card-body">
					<div class="row">
					<div class="col-sm-10">
						<p>
							Payment Buttons are HTML buttons (or links) that you can add directly to your website to accept payments or donations. These are extremely simple and quick to setup.
						</p>
					</div>
					<div class="col-sm-2">
					<i class="fa fa-gg-circle fa-4x" style="color: #26a69a"></i>
					</div>
				</div>
				</div>
			</div>	
		</a>
	</div>	
	

	<div class="col-md-6">
		<a href="{{url('merchants/api')}}" style="color: #797979">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">API</h6>
				</div>

				<div class="card-body">

					<div class="row" style="margin-top: -10px">
						<div class="col-sm-10">
							<p>
								<p>You can use our simple, easy-to-use, and <em>very</em> flexible API to integrate payments directly on your website. You can also use our API to get previous order data, run reports, and more.</p>
							</p>
						</div>
						<div class="col-sm-2">
							<i class="fa fa-spotify fa-4x" style="color: #26a69a"></i>
						</div>
					</div>

				</div>
			</div>	
		</a>
	</div>
	
</div>
@endsection