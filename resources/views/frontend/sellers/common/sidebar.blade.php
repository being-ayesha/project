@php
  $uriAll         = ['seller/product-embed','seller/settings/account','seller/settings/payment','seller/settings/security','seller/coupons','seller/add-coupon','seller/edit-coupon/{id}','seller/product-groups','seller','seller/dashboard','seller/products','seller/add-product-type','seller/add-product','seller/edit-product/{id}','seller/edit-product-groups/{id}','seller/orders/{status?}','seller/view-order/{id}','seller/new-marketing','seller/marketings','seller/analytics','seller/feedbacks','seller/affiliates','seller/payouts','seller/settings/enable-2fa'];
  $productsTabUri = ['seller/product-embed','seller/product-groups','seller/edit-product-groups/{id}','seller/products','seller/add-product-type','seller/add-product','seller/edit-product/{id}'];
  $ordersTabUri   = ['seller/orders/{status?}','seller/view-order/{id}'];
  $couponsTabUri  = ['seller/coupons','seller/add-coupon','seller/edit-coupon/{id}'];
  $marketingTabUri= ['seller/new-marketing','seller/marketings'];
  $analyticsTabUri= ['seller/analytics'];
  $feedbackTabUri = ['seller/feedbacks'];
  $affiliatesTabUri= ['seller/affiliates','seller/payouts'];
  $settingsTabUri = ['seller/settings/account','seller/settings/payment','seller/settings/security','seller/settings/enable-2fa'];
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

		<!-- User menu -->
		<div class="sidebar-user">
			<div class="card-body">
				<div class="media">
					<div class="mr-3">
						@if(Auth::user()->profile_photo)
						<img style="width:38px;height: 38px" src="{{url('public/uploads/sellers/profilephoto')}}/{{Auth::user()->profile_photo}}" class="rounded-circle profile-image" alt="profile-image" name="image">
						@else
						<img style="width:38px;height: 38px" src="{{url('public/uploads/sellers/profilephoto/nouser.jpg')}}" class="rounded-circle profile-image" alt="profile-image" name="image" width="38" height="38">
						@endif
					</div>

					<div class="media-body">
						<div class="media-title font-weight-semibold">{{Auth::user()->username}}</div>
						<div class="font-size-xs opacity-50">
							<span></span>
						</div>
					</div>

					<div class="ml-3 align-self-center">
						<a href="{{url('seller/settings/account')}}" class="text-white"><i class="icon-cog3"></i></a>
					</div>
				</div>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"></div> <i class="icon-menu" title="Main"></i></li>
				<li class="nav-item">
					<a href="{{url('seller/dashboard')}}" class="nav-link {{ ($currentUri == 'seller' || $currentUri == 'seller/dashboard') ? 'active' : ''  }}">
						<i class="icon-home4"></i>
						<span>
							Dashboard
						</span>
					</a>
				</li>
				@if(in_array($currentUri,$uriAll)) 
				<li class="nav-item">
					<a href="{{url('seller/analytics')}}" class="nav-link {{ ($currentUri == 'seller/analytics') ? 'active' : ''  }}">
						<i class="icon-stats-bars2"></i>
						<span>
							Analytics
						</span>
					</a>
				</li>
				@endif

				@if (in_array($currentUri,$uriAll)) 
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link <?= (in_array($currentUri,$productsTabUri))?'active':''?>"><i class="icon-cube"></i> <span>Products</span></a>
						<ul class="nav nav-group-sub" style="display:<?= (in_array($currentUri,$productsTabUri))? 'block' : ''?>" data-submenu-title="Layouts">
							<li class="nav-item"><a href="{{url('seller/products')}}" class="nav-link <?= ($currentUri == 'seller/products') ? 'active' : ''?>">View All Products</a></li>
							<!-- <li class="nav-item "><a href="{{url('seller/add-product-type')}}" class="nav-link <?= ($currentUri == 'seller/add-product-type') ? 'active' : ''?>">Add Product Type</a></li> -->
							<li class="nav-item "><a href="{{url('seller/add-product')}}" class="nav-link <?= ($currentUri == 'seller/add-product') ? 'active' : ''?>">Add A Product</a></li>
							<li class="nav-item"><a href="{{url('seller/product-groups')}}" class="nav-link <?= ($currentUri == 'seller/product-groups' || $currentUri == 'seller/edit-product-groups/{id}') ? 'active' : ''?>">Manage Product Groups</a></li>
							<li class="nav-item"><a href="{{url('seller/product-embed')}}" class="nav-link  <?= ($currentUri == 'seller/product-embed') ? 'active' : ''?>">Product Embed Generator</a></li>
						</ul>
					</li>
				@endif

				@if (in_array($currentUri,$uriAll)) 
					<li class="nav-item ">
						<a href="{{url('seller/orders')}}" class="nav-link <?= (in_array($currentUri,$ordersTabUri))?'active':''?>"><i class="icon-cart"></i> <span>Orders</span></a>
					</li>
				@endif

				@if (in_array($currentUri,$uriAll)) 
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link <?= (in_array($currentUri,$couponsTabUri))?'active':''?>"><i class="icon-price-tag2"></i> <span>Coupons</span></a>
						<ul class="nav nav-group-sub" style="display:<?= (in_array($currentUri,$couponsTabUri))? 'block' : ''?>" data-submenu-title="Layouts">
							<li class="nav-item"><a href="{{url('seller/coupons')}}" class="nav-link <?= ($currentUri == 'seller/coupons') ? 'active' : ''?>">View All Coupons</a></li>
							<li class="nav-item "><a href="{{url('seller/add-coupon')}}" class="nav-link <?= ($currentUri == 'seller/add-coupon') ? 'active' : ''?>">Add A Coupon</a></li>
						</ul>
					</li>
				@endif

				@if (in_array($currentUri,$uriAll)) 
				<li class="nav-item">
					<a href="{{url('seller/feedbacks')}}" class="nav-link {{ ($currentUri == 'seller/feedbacks') ? 'active' : ''  }}">
						<i class="icon-file-text"></i>
						<span>
							Feedback
						</span>
					</a>
				</li>
				@endif

				@if (in_array($currentUri,$uriAll)) 
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link <?= (in_array($currentUri,$marketingTabUri))?'active':''?>"><i class="icon-file-stats"></i> <span>Marketing</span></a>
						<ul class="nav nav-group-sub" style="display:<?= (in_array($currentUri,$marketingTabUri))? 'block' : ''?>" data-submenu-title="Layouts">
							<li class="nav-item"><a href="{{url('seller/new-marketing')}}" class="nav-link <?= ($currentUri == 'seller/new-marketing') ? 'active' : ''?>">New Marketing Email</a></li>
							<li class="nav-item "><a href="{{url('seller/marketings')}}" class="nav-link <?= ($currentUri == 'seller/marketings') ? 'active' : ''?>">View Previously Sent Marketing Emails</a></li>
						</ul>
					</li>
				@endif

				@if (in_array($currentUri,$uriAll)) 
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link <?= (in_array($currentUri,$affiliatesTabUri))?'active':''?>"><i class="icon-user"></i> <span>Affiliates</span></a>
						<ul class="nav nav-group-sub" style="display:<?= (in_array($currentUri,$affiliatesTabUri))? 'block' : ''?>" data-submenu-title="Layouts">
							<li class="nav-item"><a href="{{url('seller/affiliates')}}" class="nav-link <?= ($currentUri == 'seller/affiliates') ? 'active' : ''?>">View Affiliates</a></li>
							<li class="nav-item "><a href="{{url('seller/payouts')}}" class="nav-link <?= ($currentUri == 'seller/payouts') ? 'active' : ''?>">Affiliate Payouts</a></li>
						</ul>
					</li>
				@endif


				@if (in_array($currentUri,$uriAll)) 
					<li class="nav-item nav-item-submenu">
						<a href="#" class="nav-link <?= (in_array($currentUri,$settingsTabUri))?'active':''?>"><i class="icon-cog3"></i> <span>Settings</span></a>
						<ul class="nav nav-group-sub" style="display:<?= (in_array($currentUri,$settingsTabUri))? 'block' : ''?>" data-submenu-title="Layouts">
							<li class="nav-item"><a href="{{url('seller/settings/account')}}" class="nav-link <?= ($currentUri == 'seller/settings/account') ? 'active' : ''?>">Account Settings</a></li>
							<li class="nav-item "><a href="{{url('seller/settings/payment')}}" class="nav-link <?= ($currentUri == 'seller/settings/payment') ? 'active' : ''?>">Payment Settings</a></li>
							<li class="nav-item "><a href="{{url('seller/settings/security')}}" class="nav-link <?= ($currentUri == 'seller/settings/security') ? 'active' : ''?>">Security</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->
	
</div>