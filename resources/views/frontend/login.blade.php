@include('frontend.common.header')
	<!-- Main navbar -->
		@include('frontend.common.mainnavbar')
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form" action="{{url('login')}}" method="post">
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
								<span class="d-block text-muted">Enter your credentials below</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Please enter your email">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								@if($errors->has('email'))
									<span class="form-text text-danger">
										{{$errors->first('email')}}
									</span>
								@endif
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="Type your password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								@if($errors->has('password'))
									<span class="form-text text-danger">
										{{$errors->first('password')}}
									</span>
								@endif
							</div>
							<div class="text-left">
								<a href="{{url('/')}}">Forgot password?</a>
							</div>
							<div class="form-group" style="margin-top: 20px">
									<button type="submit" style="margin-left: 70px;width: 74%" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>
							<div class="text-left">
								<a href="{{url('register')}}">Need an account?</a>
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