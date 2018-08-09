<!DOCTYPE html>
<html>
<head>
	<title>Send Email</title>
</head>
<body>
	<p>Date: {{ Carbon\Carbon::now() }}</p>
	<p>Tpye: {!! $params['type'] !!}</p>
	<p>Name: {!! $params['name'] !!}</p>
	<p>Tel: {!! $params['phone'] !!}</p>
	<p>Email: {!! $params['email'] !!}</p>
	<p>Ramark: {!! $params['type'] !!}</p>
	<br>
	<br>
	<b>Message</b>
	<p> {!! $params['message'] !!} </p>
	<!-- <p>Transfer fees: {!! $params['type'] !!}</p> -->
</html>