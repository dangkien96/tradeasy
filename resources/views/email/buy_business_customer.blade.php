<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $params['company'] }}</title>
</head>
<body>
	Dear {{ $params['name'] }},<br />
	<br />
	您的資料已送出。我們的辦公時間：星期一至五 10:00 - 18:30，星期六 10:00 - 13:30，熱線：(852)31112676，歡迎來電諮詢。<br />
	<br />
	{{ $params['company'] }}<br />
</body>
</html>