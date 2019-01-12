<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h2>Hello <b>{!! $data1['username'] !!},</b></h2>
	<p>Please click the button below to login:</p>
	<a target="_blank"  href="{{$data1['token']}}" style="background-color:#5fbeaa; width:90px; color: #FFFFFF;
	text-align: center;border-radius: 4px;border: none; padding:10px;cursor: pointer;display: inline-block; text-decoration: none">Login</a>
	<p>_{{getenv('APP_NAME')}} Team</p>
	<hr>
	<p><small>If you are having trouble clicking the login button, copy and paste the link below into your web browser.:</small></p>
	<small><a href="{{$data1['token']}}">{{$data1['token']}}</a></small>
</body>
</html>