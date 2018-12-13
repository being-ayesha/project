@include('frontend.affiliates.common.header')
	<!-- Main navbar -->
		@include('frontend.affiliates.common.mainnavbar')
	<!-- /main navbar -->
	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
			@include('frontend.affiliates.common.sidebar')
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-light">
				<!-- @include('frontend.affiliates.common.breadcrumbheader') -->
				@include('frontend.affiliates.common.breadcrumb')
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
				@include('frontend.affiliates.common.foot')
			<!-- /footer -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
@stack('scripts')
@include('frontend.affiliates.common.footer')