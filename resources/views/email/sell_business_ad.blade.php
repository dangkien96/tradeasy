<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $params['company'] }}</title>
</head>
<body>
	<br>
	<br>
	Date : {{ \Carbon\Carbon::now() }}<br>
	Type : Acquired Business(SELL)<br>
	Name : {{ $params['name'] }}<br>
	Tel :  {{ $params['phone'] }}<br>
	Email : {{ $params['email'] }}<br>
	Remarks : {{ $params['come_to']." - ".$params['message'] }}<br>
	<br><br>
	<h3><b>Details</b></h3><br />
	Business Nature : {{ $params['business_nature_name'] }}<br />
	Reference profits (per month) : {{ $params['profit'] }}<br />
	Transfer fees : {{ $params['investment'] }}
	<br><br>
	<br><br>				
	{{ $params['company'] }}
</body>
</html>