<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $params['company'] }}</title>
</head>
<body>
	<div>
		<p>
			<br><br>
			Date : {{ \Carbon\Carbon::now() }}<br>
			Type : Acquired Business (BUY) <br>				
			Name : {{ $params['name'] }}<br>
			Tel  : {{ $params['tel'] }}<br>
			Email : {{ $params['email'] }}<br>
			Region : {{ $params['region_name'] }}<br>
			Industry : {{ $params['business_nature_name'] }}<br>
			Remarks : {{ $params['come_to']." ".$params['message'] }}<br>
			<br><br>
			<h3><b>Details</b></h3><br />
			Code : {{ $params['code'] }}<br />
			intro : {{ $params['intro'] }}<br />
			Location : {{ $params['region_name'] }}<br />
			Business Nature : {{ $params['business_nature_name'] }}<br />
			Investment : {{ $params['investment'] }}
			<br><br>
			<br><br>				
			{{ $params['company'] }}
		</p>
	</div>
</body>
</html>