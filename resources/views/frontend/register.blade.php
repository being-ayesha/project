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

				<!-- Registration form -->
				<form class="login-form" action="{{url('register')}}" method="post">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-plus3 icon-2x text-success border-success border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Create account</h5>
								<span class="d-block text-muted">All fields are required</span>
							</div>
							{{@csrf_field()}}
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" value="{{old('username')}}" name="username" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user-check text-muted"></i>
								</div>
								@if($errors->has('username'))
									<span class="form-text text-danger">
										{{$errors->first('username')}}
									</span>
							    @endif
							</div>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-mention text-muted"></i>
								</div>
								@if($errors->has('email'))
									<span class="form-text text-danger">
										{{$errors->first('email')}}
									</span>
							    @endif
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
								@if($errors->has('password'))
									<span class="form-text text-danger">
										{{$errors->first('password')}}
									</span>
							    @endif
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="conf_password" class="form-control" placeholder="Confirm password">
								<div class="form-control-feedback">
									<i class="icon-user-lock text-muted"></i>
								</div>
								@if($errors->has('conf_password'))
									<span class="form-text text-danger">
										{{$errors->first('conf_password')}}
									</span>
							    @endif
							</div>

							<div class="form-group">
								<div class="form-check">
								  <label class="form-check-label">
								    <input type="checkbox" class="form-check-input" name="remember">I accept <a href="#">Terms and Conditions</a>
								  </label>
								</div>
							</div>
							<button style="margin-left: 70px;width: 74%;" type="submit" class="btn bg-teal-400 btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>
						</div>
						<div class="card-body">
							<div class="text-left">
									<a href="{{url('/')}}">Already a member?</a>
							</div>
						</div>
					</div>
				</form>
				<!-- /registration form -->

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