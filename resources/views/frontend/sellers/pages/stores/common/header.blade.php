<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{$siteName}} | {{$pageTitle}}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('public/frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('public/frontend/assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
  <script src="{{asset('public/frontend/global_assets/js/main/jquery.min.js')}}"></script>
  <script src="{{asset('public/frontend/global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('public/frontend/plugins/jqueryvalidate/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">
    var SITE_URL = "{{url('/')}}";
  </script>
  <style type="text/css">
		  .widescreen{
		    background: #ddd;
		  }
		  .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
		    color: #007bff;
		    background-color: #fff !important;
		  }
    .fa-facebook {
      background: #3B5998;
      color: white;
      padding: 5px;
    }
    .socialIcon{
      color: #fff;
    }
    .fa-twitter {
      background: #55ACEE;
      color: white;
      padding: 5px;
    }
    .fa-pinterest {
      background: #cb2027;
      color: white;
      padding: 5px;
    }
    .imgCircle{
      height: 70px;
      width: 72px;
      border-radius: 50%;
    }
    .error{
      color: red;
      font-weight: 600;
    }
  </style>
</head>
<body class="widescreen">

  @if(Session::has('message'))
  <div class="container">
    <div class="row">
     <div class="col-lg-12">
      <div class="alert {{Session::get('alert-class')}} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span><i class="fa fa-info-circle"></i>&nbsp; {{Session::get('message')}}</span>
      </div> 
    </div>
  </div>
</div>
  @endif
