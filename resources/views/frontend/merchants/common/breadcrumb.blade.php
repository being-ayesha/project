<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
	
	<div class="d-flex">
		<div class="breadcrumb">
			<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
			<span class="breadcrumb-item active">Dashboard</span>
		</div>

		<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
	</div>

	<div class="header-elements d-none">
		<div class="breadcrumb justify-content-center">
			
			<div class="breadcrumb-elements-item dropdown p-0">
				<a href="#" class="breadcrumb-elements-item" data-toggle="dropdown">
					<i class="icon-rotate-ccw2 mr-2"></i>
					Switch
				</a>

				<div class="dropdown-menu dropdown-menu-right">
					<a href="{{url('seller')}}" class="dropdown-item">Switch to {{$siteName}} Storefront</a>
				</div>
			</div>

				<a href="{{url('merchants/settings/account')}}" class="breadcrumb-elements-item">
					<i class="icon-gear mr-2"></i>
					Settings
				</a>
			</div>
	</div>

	@if(Session::has('message'))
	<div class="flash-container" style="margin-left: -20px;position:absolute;top:0;width: 100%;padding: 2px 1px 0px 1px;text-align: center">
		<div class="alert {{Session::get('alert-class')}} text-white alert-dismissible">
			<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
			<span class="font-weight-semibold">{{Session::get('message')}}
		</div>
	</div>
	@endif

</div>