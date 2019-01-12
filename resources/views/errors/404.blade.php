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
				<!-- Container -->
				<div class="flex-fill">

					<!-- Error title -->
					<div class="text-center mb-3">
						<h1 class="error-title">404</h1>
						<h5>Oops, an error has occurred. Page not found!</h5>
					</div>
					<!-- /error title -->

				</div>
				<!-- /container -->

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