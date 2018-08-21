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
		<!-- <br><br>
		<b>Details</b><br />
		Code : '.get_field("tbl_opportunities", "code", $opportunities_id).'<br />
		intro : '.get_field("tbl_opportunities", "intro_2", $opportunities_id).'<br />
		Location : '.get_field("tbl_location", "name_2", get_field("tbl_opportunities", "location_id", $opportunities_id)).'<br />
		Business Nature : '.get_field("tbl_business_nature", "name_2", $business_nature_id).'<br />
		Investment : '.$investment.' -->
		<br><br>
		<br><br>				
		{{ $params['company'] }}
	</p>
</body>
</html>