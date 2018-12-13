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
	<link href="{{asset('public/frontend/global_assets/css/icons/fontawesome/styles.min.css')}}" rel="stylesheet" type="text/css">
	<!-- <link href="{{asset('public/frontend/plugins/summernote/summernote-bs4.css')}}" rel="stylesheet"> -->	
	<!-- /global stylesheets -->

	{{-- dataTables Css--}}

	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/datatables/jquery.dataTables.min.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/DataTables_latest/DataTables-1.10.18/css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/DataTables_latest/Responsive-2.2.2/css/responsive.dataTables.min.css') }}">
	
	<!-- Jquery date time picker css -->
	<link href="{{asset('public/frontend/assets/css/jquery.datetimepicker.css')}}" rel="stylesheet" type="text/css">

	<!-- Core JS files -->

	<script src="{{asset('public/frontend/global_assets/js/main/jquery.min.js')}}"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="{{asset('public/frontend/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('public/frontend/global_assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
	<!-- <script src="{{asset('public/frontend/global_assets/js/plugins/editors/summernote/summernote.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script> -->
	<script src="{{asset('public/frontend/global_assets/js/plugins/editors/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>

	<script src="{{asset('public/frontend/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
	<script src="{{asset('public/frontend/assets/js/app.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/demo_pages/form_select2.js')}}"></script>

	<!-- Date Time Picker -->
	<script src="{{asset('public/frontend/global_assets/js/plugins/pickers/anytime.min.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/pickers/pickadate/picker.time.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/demo_pages/picker_date.js')}}"></script>
	<script src="{{asset('public/frontend/global_assets/js/demo_pages/components_popups.js')}}"></script>

	<!-- <script src="{{asset('public/frontend/global_assets/js/demo_pages/editor_ckeditor.js')}}"></script> -->

	<!-- <script src="{{asset('public/frontend/global_assets/js/demo_pages/editor_summernote.js')}}"></script> -->

	<!-- /theme JS files -->
	<!-- Jquery date time picker Js-->
	<script src="{{asset('public/frontend/assets/js/jquery.datetimepicker.full.js')}}"></script>	
	

	{{-- jquery.dataTables js--}}

	{{-- <script src="{{ asset('public/frontend/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script> --}}
	<script src="{{ asset('public/frontend/plugins/DataTables_latest/DataTables-1.10.18/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/frontend/plugins/DataTables_latest/Responsive-2.2.2/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/frontend/plugins/jquerysteps/jquery.steps.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/frontend/plugins/jqueryvalidate/jquery.validate.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/frontend/global_assets/js/plugins/notifications/jgrowl.min.js')}}"></script>

	<style type="text/css">
		.producttype p:hover{
			background: #26a69a;
			color:#fff;
			border-radius: 5px;
			cursor: pointer;
			/*font-size:25px;*/
		}
		* {
		  box-sizing: border-box;
		}

		body {
		  background-color: #f1f1f1;
		}

		#regForm {
		  background-color: #ffffff;
		  font-family: Raleway;
		  width: 100%;
		}

		h1 {
		  text-align: center;  
		}

		input {
		  padding: 10px;
		  width: 100%;
		  font-size: 17px;
		  font-family: Raleway;
		  border: 1px solid #aaaaaa;
		}

		/* Mark input boxes that gets an error on validation: */
		input.invalid {
		  background-color: #ffdddd;
		}

		/* Hide all steps by default: */
		.tab {
		  display: none;
		}

		button {
		  background-color: #4CAF50;
		  color: #ffffff;
		  border: none;
		  padding: 10px 20px;
		  font-size: 17px;
		  font-family: Raleway;
		  cursor: pointer;
		}

		button:hover {
		  opacity: 0.8;
		}

		#prevBtn {
		  background-color: #bbbbbb;
		}

		/* Make circles that indicate the steps of the form: */
		  .step {
			/* height: 15px; */
			width: 22%;
			margin: 0 10px;
			background-color: #fff;
			border: none;
			display: inline-block;
			opacity: 0.5;
			padding: 11px;
			border-radius: 2px;
			text-align: center;
			font-size: 20px;
			color: #000;
			border:2px solid #ddd;
		}

		.step.active {
		  opacity: 1;
		  background: #26a69a;
		  border: none;
		}

		/* Mark the steps that are finished and valid: */
		.step.finish {
		  background-color: #1f2e2e;
		  color:#ddd;
		  border: none;
		}

		/*Stylesheet for codes input for product type code/serial starts here*/
		#tags{
		  border:1px solid #ccc;
		  font-family:Arial;
		}
		#tags > span{
		  cursor:pointer;
		  display:block;
		  float:left;
		  color:#fff;
		  background:#26a69a;
		  padding:5px;
		  padding-right:25px;
		  margin:4px;
		}
		#tags > span:hover{
		  opacity:0.7;
		}
		#tags > span:after{
		 position:absolute;
		 content:"×";
		 border:1px solid;
		 padding:2px 5px;
		 margin-left:3px;
		 font-size:11px;
		}
		#tags > input{
		  background:#eee;
		  border:0;
		  padding:7px;
		}
		.error{
			color:red !important;
		}
		/*Stylesheet for codes input for product type code/serial ends here*/
	</style>
</head>

<body>