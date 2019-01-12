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
					<div class="card" class="login-form">
					  	  <div class="card-header bg-info dashboardHeader">Login to rocket.Where do you want to go next?</div>
						  <div class="card-body" style="background: #f1f1f1">								
							  	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">  
									  <a class="nav-link text-center login linkColor" id="v-pills-home-tab" href="{{url('merchants/dashboard')}}" role="tab" aria-controls="v-pills-home">Login to Merchant</a>
									  <a class="nav-link text-center linkColor" id="v-pills-profile-tab" href="{{url('seller/dashboard')}}" role="tab" aria-controls="v-pills-home">Login to Seller</a>								
								</div>
						  </div> 
					</div>
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