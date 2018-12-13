@php
  $uriAll         = ['affiliates/products','affiliates/settings','affiliates/payouts'];
  $currentUri     = Route::current()->uri();
@endphp

<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Navigation</div> <i class="icon-menu" title="Navigation"></i></li>
				<!-- /main -->

				<!-- Dashboard -->
				<li class="nav-item">
					<a href="{{url('affiliates/dashboard')}}" class="nav-link {{ ($currentUri == 'affiliates' || $currentUri == 'affiliates/dashboard') ? 'active' : ''  }}">
						<i class="icon-home4"></i>
						<span>
							Dashboard
						</span>
					</a>
				</li>
				<!-- Dashboard -->
				<!-- Product -->
				<li class="nav-item">
					<a href="{{url('affiliates/products')}}" class="nav-link {{ ($currentUri == 'affiliates/products') ? 'active' : ''  }}">
						<i class="icon-cube"></i>
						<span>
							Products
						</span>
					</a>
				</li>
				<!-- Product -->
				<li class="nav-item">
					<a href="{{url('affiliates/payouts')}}" class="nav-link {{ ($currentUri == 'affiliates/payouts') ? 'active' : ''  }}">
						<i class="icon-home4"></i>
						<span>
							Payment Logs
						</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{url('affiliates/settings')}}" class="nav-link {{ ($currentUri == 'affiliates/settings') ? 'active' : ''  }}">
						<i class="icon-cog3"></i>
						<span>
							Settings
						</span>
					</a>
				</li>

			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->
	
</div>