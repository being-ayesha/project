@include('frontend.merchants.common.header')
	<!-- Main navbar -->
		@include('frontend.merchants.common.mainnavbar')
	<!-- /main navbar -->
	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
			@include('frontend.merchants.common.sidebar')
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-light">
				@include('frontend.merchants.common.breadcrumbheader')
				@include('frontend.merchants.common.breadcrumb')
			</div>
			<!-- /page header -->
			<!-- Content area -->
			<div class="content">
				<!--Dashboard Content-->
				  @yield('content')
				<!--Dashboard Content-->
			</div>
			<!-- /content area -->
			<!-- Footer -->
				@include('frontend.merchants.common.foot')
			<!-- /footer -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
@include('frontend.merchants.common.footer')