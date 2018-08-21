<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
</head>
<body>
	<div>
		<br><br>
		Date : {{ \Carbon\Carbon::now() }}'<br>
		Type : 講座/課程<br>
		Name : {{ $params['name'] }}<br>
		Tel : {{ $params['phone'] }}<br>
		Email : {{ $params['email'] }}<br>
		Remarks : {{ $params['come_to']. " - " .$params['message']  }}<br>
		character_1 : '.$intt.'<br>
		<br><br>			
		{{ $params['company'] }}
	</div>
</body>
</html>