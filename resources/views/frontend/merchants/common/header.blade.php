<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{@$siteName}} | {{@$pageTitle}}</title>
	<script type="text/javascript">
		var SITE_URL = "{{url('/')}}";
	</script>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('public/frontend/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/frontend/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/frontend/assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/frontend/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/frontend/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/DataTables_latest/DataTables-1.10.18/css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/DataTables_latest/Responsive-2.2.2/css/responsive.dataTables.min.css') }}">
	<link href="{{asset('public/frontend/global_assets/css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('public/frontend/global_assets/js/main/jquery.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="{{asset('public/frontend/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('public/frontend/global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/styling/switch.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('public/frontend/assets/js/app.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/demo_pages/dashboard.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/demo_pages/form_select2.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/demo_pages/form_checkboxes_radios.js')}}"></script>
	<!-- /theme JS files -->
	<!-- <script src="{{ asset('public/frontend/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script> -->
	<script src="{{ asset('public/frontend/plugins/DataTables_latest/DataTables-1.10.18/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/frontend/plugins/DataTables_latest/Responsive-2.2.2/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/frontend/plugins/jquerysteps/jquery.steps.js') }}" type="text/javascript"></script>
	<script src="{{asset('public/frontend/plugins/jqueryvalidate/jquery.validate.min.js') }}" type="text/javascript"></script>
	
	<style type="text/css">
	.error{
		color:red !important;
	}
    </style>

</head>


<body>