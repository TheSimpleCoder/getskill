<!DOCTYPE html>
<html>
<head>
	<title>Новая заявка.</title>
</head>
<body>
	<div class="card">
		<div class="card-header" style="padding: 25px;border: 1px solid #d8d8d8;border-radius: 3px;background: #f5f5f5;">
			<img src="https://getskill.com.ua/build/img/logo-375.png">
		</div>
		<div class="card-body" style="width: 80%;margin: auto;">
			<h1>У Вас новая заявка!</h1>
			<div>
				<p>Номер курса: <b>{{ $feedback['course_id'] }}</b></p>
				<p>Название курса: <b>{{ $feedback['course_name'] }}</b></p>
				<br>
				<p>Имя клиента: <b>{{ $feedback['name'] }}</b></p>
				<p>Номер телефона: <b>{{ $feedback['phone'] }}</b></p>
			</div>
		</div>
		<div class="card-footer" style="padding: 15px;background: #6f35a9;border-radius: 3px;">
			<p style="font-weight: 300;font-size: 14px;line-height: 19px;color: #fff;">© 2020 Get Skill</p>
		</div>
	</div>

</body>
</html>