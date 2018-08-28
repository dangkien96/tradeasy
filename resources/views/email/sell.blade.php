<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $params['company'] }}</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<br><br>
	Hi: {{ $params['name'] }}, <br><br>
	有客戶發出了 {{ $params['type'] }}，請于 {{ $params['start_time'] }} 后開啟下方之hyperlink，接手跟進這單生意。<br>
	(若您已是本單生意之跟進者，請直接登錄系統跟進生意)<br><br>
	<a href="{{ $params['link'] }}" target="_blank">{{ $params['link'] }}</a><br><br>
	附上生意之簡要訊息，僅供您參考<br><br>
	Date : {{ \Carbon\Carbon::now() }}<br>
	Type : {{ $params['type'] }}
	
	<br><br>
	{{ $params['company'] }}
</body>
</html>