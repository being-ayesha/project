@php
  $uriAll         = ['merchants/accept-payments','merchants/settings/account','merchants/settings/profile','merchants/settings/payment','merchants/settings/security','merchants/payments','merchants/payments-details/{id}'];
  $acceptpaymentTabUri =['merchants/accept-payments'];
  $paymentsTabUri =['merchants/payments','merchants/payments-details/{id}'];
  $settingsTabUri = ['merchants/settings/account','merchants/settings/profile','merchants/settings/payment','merchants/settings/security'];
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
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
				<li class="nav-item">
					<a href="{{url('merchants/dashboard')}}" class="nav-link {{ ($currentUri == 'merchants' || $currentUri == 'merchants/dashboard') ? 'active' : ''  }}">
						<i class="icon-home4"></i>
						<span>
							Dashboard
						</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{url('merchants/payments')}}" class="nav-link <?= (in_array($currentUri,$paymentsTabUri))?'active':''?>">
						<i class="icon-cash3"></i>
						<span>
							Payments
						</span>
					</a>
				</li>

				<li class="nav-item">
					<a href="{{url('merchants/accept-payments')}}" class="nav-link {{ ($currentUri == 'merchants/payment-buttons' || $currentUri == 'merchants/api' || $currentUri == 'merchants/accept-payments') ? 'active' : ''  }}">
						<i class="icon-cart5"></i>
						<span>
							Accept Payments
						</span>
					</a>
				</li>

				<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link <?= (in_array($currentUri,$settingsTabUri))?'active':''?>"><i class="icon-cog3"></i> <span>Settings</span></a>
						<ul class="nav nav-group-sub" style="display:<?= (in_array($currentUri,$settingsTabUri))? 'block' : ''?>"  data-submenu-title="Layouts">
							<li class="nav-item"><a href="{{url('merchants/settings/account')}}" class="nav-link <?= ($currentUri == 'merchants/settings/account') ? 'active' : ''?>">Account Settings</a></li>
							<li class="nav-item"><a href="{{url('merchants/settings/profile')}}" class="nav-link <?= ($currentUri == 'merchants/settings/profile') ? 'active' : ''?>">Merchant Profile</a></li>
							<li class="nav-item "><a href="{{url('merchants/settings/payment')}}" class="nav-link <?= ($currentUri == 'merchants/settings/payment') ? 'active' : ''?>">Payment Settings</a></li>
							<li class="nav-item "><a href="{{url('merchants/settings/security')}}" class="nav-link <?= ($currentUri == 'merchants/settings/security') ? 'active' : ''?>">Security</a></li>
						</ul>
					</li>
				
			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->
	
</div>