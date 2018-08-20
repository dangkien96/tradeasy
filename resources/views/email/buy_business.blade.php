<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<br><br>
		Hi: {!! $params['user'] !!}, <br><br>
		有客戶對現有商機有購入意向，請于 {!! $params['start_time'] !!} 后開啟下方之hyperlink，接手跟進這單生意。<br>
		(若您已是本單生意之跟進者，請直接登錄系統跟進生意)<br><br>
		<a href="{{ $params['link'] }}" target="_blank">{{ $params['link'] }}</a><br><br>
		附上生意之簡要訊息，僅供您參考
		<br>
		<br>
			Date : {{ \Carbon\Carbon::now() }}<br>
			Type : Acquired Business (BUY) <br>	
			<h3><b>Details</b></h3>
			<br/>
			Code : <b>{!! $params['code'] !!}</b><br />
			intro : <b>{!! $params['intro'] !!}</b><br/>
			Location : <b>{!! $params['region_name'] !!}</b><br/>
			Business Nature : <b>{!! $params['business_nature_name'] !!}</b><br/>
			Investment : <b>{!! $params['investment'] !!}</b>
		<br><br>
		{!! $params['company'] !!}
	</div>
</body>
</html>