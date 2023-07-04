<?php session_start() ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script defer src = "js/jquery-3.6.0.js"></script>
		<script defer src="js/scripts.js"></script>
	</head>
	<body>
		<?php include "include/header.php" ?>
		<main class="container">

			<?php if ($_SESSION['loginFail']){ 
			unset($_SESSION['loginFail']);?>
			<div id="message" class="alert width-100 border-red text-red light-red"><p>Указанный логин уже занят! </p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php } ?>

			<form class="card-wrap shadow width-45" action="php/registration.php" onsubmit="return CheckPassword(); return fioCheck()" method="POST" id="regForm">

				<h3 class="card-header blue"> Регистрация </h3>

				<p id="validateAlert" class="alert width-100 border-red text-red light-red" style="transform: scale(0); display: none"></p>

				<label for="fio">Введите ФИО<span class="text-red">* </span>:</label><input id="fio" name="fio" class="border-blue validate" required type="text" aria-describedby="fioHelp" pattern='^[а-яА-я0-9\s]+$'>
				<small id="fioHelp"><span class="text-red"> * </span>Только кириллица и пробелы</small>

				<label for="login">Введите Логин<span class="text-red">* </span>:</label><input class="border-blue validate" name="login" id="login" required type="text" aria-describedby="loginHelp" onchange="checkLogin()">
				<span id="checkLoginSpan"></span>
				<small id="loginHelp"><span class="text-red"> * </span>Только латинские буквы и цифры</small>

				<label for="password">Введите пароль<span class="text-red">* </span>: </label><input class="border-blue validate" name="password" id="password" required type="password" aria-describedby="passwordHelp">
				<small id="passwordHelp"><span class="text-red">*</span> Только латинские буквы, цифры и спецсимволы </small>

				<label for="confirmPass"> Повторите пароль: </label><input class="border-blue validate" id="confirmPass" name="confirmPassword" required type="password">

				<label for="Email"> Введите Email<span class="text-red">* </span>: </label><input class="border-blue validate" id="Email" name="email" required type="Email" aria-describedby="emailHelp">
				<small id="passwordHelp"><span class="text-red">*</span> В формате *@*.* </small>

				<div><label for="checkbox"> Согласие на обработку персональных данных: </label><input id="checkbox" required type="checkbox"></div>
				<input type="submit" class="button btn-blue" value="Зарегистрироваться" name="regButton" id="register">
			</form>
		</main>		
	</body>
</html>