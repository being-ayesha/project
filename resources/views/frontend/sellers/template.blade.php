@include('frontend.sellers.common.header')
	<!-- Main navbar -->
		@include('frontend.sellers.common.mainnavbar')
	<!-- /main navbar -->
	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
			@include('frontend.sellers.common.sidebar')
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-light">
				<!-- @include('frontend.sellers.common.breadcrumbheader') -->
				@include('frontend.sellers.common.breadcrumb')
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
				@include('frontend.sellers.common.foot')
			<!-- /footer -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->
@stack('scripts')
@include('frontend.sellers.common.footer')