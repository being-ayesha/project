@php
$layout='';
if(Request::segment(1)=='seller'){
$layout="frontend.sellers.template";
}else{	
$layout="frontend.merchants.template";
}
@endphp
@extends($layout)
@section('content')
<div class="row">
	<div class="col-md-6" id="div2faGoogle">
		<div class="card">
			<div class="card-header">
				<h6 class="card-title" style="font-size: 15px;font-weight:600;text-transform:uppercase;color: #98a6ad">Two Factor Authentication</h6>
			</div>
			<div class="card-body">
					<div class="form-group row">
						<p class="card-title" style="margin-left: 5px">Login Method: Password </p><br>	
						<img src="{{ $QR_Image }}">
						<p><small>If you have trouble scanning the QR Code, you can manually add the 2FA secret: {{$secret}}</small></p>
						<p style="font-size: 15px;color: green">Before you can set 2FA, you must verify the code</p>
						<div class="col-md-12">
						<form method="post" action="{{url(Request::segment(1).'/settings/enable2fa')}}">
						@csrf
						<div class="form-group">
						<input type="text" class="form-control" placeholder="Two Factor Code" name="verify_code" id="verify-code" style="margin-bottom: 10px">
			     		</div>
			     		<div class="text-right">
			     		<button type="submit" class="btn bg-teal-400">Active 2FA</button>
						</div>
						</form>
						</div>
			     	</div>
			</div>
		</div>
	</div>
</div>
@endsection