<?php session_start();
require_once "db/db.php"; 
$orders=$conn->query("select * from requests where status='Выполнена' ORDER BY id DESC limit 4");
$count=$conn->query("select count(*) from requests where status='Выполнена'")->fetchColumn();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
		<script defer src = "js/jquery-3.6.0.js"></script>
		<script defer src="js/scripts.js"></script>
		<title>Главная страница</title>
	</head>
	<body>
		<?php include "include/header.php"; ?>
		<div class="container">
			<?php if ($_SESSION['regOk']){
			unset($_SESSION['regOk']);?>
			<div id="message" class="alert width-100 border-green text-green light-green"><p>Вы успешно зарегистрированы!</p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php } ?>
			<p class="sectionName text-green width-100 light-green border-green-left border-green-top">Выполнено заказов: <?=$count?></p>			
		</div>
		<main class="container">
<?php 
		foreach ($orders as $row) {
			$categoryName=$conn->query("select name from category where id=".$row["categoryId"]."");
			$categoryName=$categoryName->fetch();			
?>
					<div class='card-wrap width-33 complete'>
						<div class='card shadow'>
						<h3 class='card-header green'><?=$row['name']?></h3>
						<div class='img-wrap changePhoto'>
						<img src='img/1 (1).jpg' alt='Фото заказа' class='photoBefore'>
						<img src='img/1 (2).jpg' alt='Фото заказа' class='photoAfter'>
						</div>
					<p>Дата создания: <?=$row['time']?></p>
					<p>Категория: <?=$categoryName['name']?></p>
					<p>Статус: <span class='card-status green'><?=$row['status']?></span></p>
					<p><?=$row['description']?></p>
				</div>
			</div>
<?php } ?>
		</main>
	</body>
</html>