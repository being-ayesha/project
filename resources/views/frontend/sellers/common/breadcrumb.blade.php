<div style="position:relative;">
	<div style="position:relative;" class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{url('/seller')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Dashboard</span>
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>

		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				<div class="breadcrumb-elements-item dropdown p-0">
					<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
						<i class="icon-gear mr-2"></i>
						Settings
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{url('seller/settings/account')}}" class="dropdown-item"><i class="icon-user-lock"></i> Account Settings</a>
						<a href="{{url('seller/settings/payment')}}" class="dropdown-item"><i class="icon-statistics"></i> Payment Settings</a>
						<a href="{{url('seller/settings/security')}}" class="dropdown-item"><i class="icon-accessibility"></i> Security</a>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	@if(Session::has('message'))

	<div class="flash-container" style="position:absolute;top:0;width: 100%;padding: 2px 1px 0px 1px;text-align: center">
	<div class="alert {{Session::get('alert-class')}} text-white alert-dismissible">
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
		<span class="font-weight-semibold">{{Session::get('message')}}
	</div>
	</div>

	@endif
</div>