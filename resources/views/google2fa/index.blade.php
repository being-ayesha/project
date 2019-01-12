@include('frontend.common.header')
	
	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">
			
				<!-- Login form -->
				<form class="login-form"  action="{{url('2fa')}}" method="post">
					<div class="card mb-0">
						<div class="card-body">
							@if(Session::has('message'))
							<div class="flash-container">
								<div class="alert {{Session::get('alert-class')}}" role="alert" style="margin-bottom:0px;">
								  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  	 {{Session::get('message')}}
								</div>
							</div>
							@endif
							{{@csrf_field()}}

							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Enter your Two Factor Auth Code</span>
							</div>
							<!--  -->
							
							<div class="form-group form-group-feedback form-group-feedback-left twoFa">
								<input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus placeholder="Two Factor Auth Code">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								@if($errors->has('verify_code'))
									<span class="form-text text-danger">
										{{$errors->first('verify_code')}}
									</span>
								@endif
							</div>
							<div class="form-group" style="margin-top: 20px">
									<button type="submit" style="margin-left: 70px;width: 40%" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 ml-2"></i></button>
							</div>
							
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
				@include('frontend.common.foot')
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

@include('frontend.common.footer')