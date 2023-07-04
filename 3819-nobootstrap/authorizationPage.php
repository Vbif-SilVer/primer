<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script defer src="js/scripts.js"></script>
</head>
<body>
	<?php include "include/header.php" ?>
<main class="container">

			<?php if ($_SESSION['authFail']){ 
			unset($_SESSION['authFail']);?>
			<div id="message" class="alert width-100 border-red text-red light-red"><p>Неверный логин или пароль! </p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php } ?>

	<form class="card-wrap shadow width-45" action="php/authorization.php" method="POST">
		<h3 class="card-header green"> Авторизация </h3>

		<label for="login">Введите Логин:</label><input class="border-green" id="login" name="authLogin" required type="text">

		<label for="password">Введите пароль: </label><input class="border-green" id="password" name="authPassword" required type="password">

		<input type="submit" class="button btn-green" value="Войти" name="authButton">
	</form>
</main>

	
</body>
</html>