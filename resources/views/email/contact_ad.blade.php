<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $params['company'] }}</title>
</head>
<body>
	<p>
		<br><br>
		Date : {{ \Carbon\Carbon::now() }}<br>
		Type : Contact us<br>				
		Name : {{ $params['name'] }}<br>
		Tel : {{ $params['phone'] }}<br>
		Email : {{ $params['email'] }}<br>
		Remarks : {{ $params['come_to'] }} - {{ $params['message'] }}<br>
		<br><br>
		<br><br>				
		{{ $params['company'] }}
	</p>
</body>
</html>