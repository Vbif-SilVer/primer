<?php session_start();
require_once "db/db.php"; 
$orders=$conn->query("select * from requests where userId='".$_SESSION['userId']."' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/style.css">
		<script defer src="js/scripts.js"></script>
		<title>Страница пользователя</title>
	</head>
	<body>
		<?php
		include "include/header.php";
		if ($_SESSION['userAuth']){ ?>
		<div class="container">
			<p id="top" class="sectionName text-blue width-100 light-blue border-blue-left border-blue-top">Страница пользователя: удаление и просмотр своих заказов <a style="float: right" href="userPage.php#bottom" class="button outline-blue width-33">Перейти к созданию заказа</a></p>
		</div>
		<nav>
			<button class="button outline-gray" onclick="ShowAll()">Все</button>
			<button class="button outline-blue" onclick="ShowNew()">Новые</button>
			<button class="button outline-green" onclick="ShowComplete()">Выполненные</button>
			<button class="button outline-red" onclick="ShowReject()">На рассмотрении</button>
		</nav>
		<main class="container">
<?php 
		foreach ($orders as $row) {
			$categoryName=$conn->query("select name from category where id=".$row["categoryId"]."");
			$categoryName=$categoryName->fetch();
			switch ($row['status']) {
				case 'Новая':
					echo "<div class='card-wrap width-33 new'>
						<div class='card shadow'>
						<h3 class='card-header blue'>".$row['name']."</h3>
						<div class='img-wrap'>
						<img src='../img/".$row['photoPath']."/".$row['photoBefore']."' alt='Фото заказа'>
						</div>";
				break;
				case 'На рассмотрении':
					echo "<div class='card-wrap width-33 reject'>
						<div class='card shadow'>
						<h3 class='card-header red'>".$row['name']."</h3>
						<div class='img-wrap'>
						<img src='../img/".$row['photoPath']."/".$row['photoBefore']."' alt='Фото заказа'>
						</div>";
				break;
				case 'Выполнена':
					echo "<div class='card-wrap width-33 complete'>
						<div class='card shadow'>
						<h3 class='card-header green'>".$row['name']."</h3>
						<div class='img-wrap changePhoto'>
						<img src='img/1 (1).jpg' alt='Фото заказа' class='photoBefore'>
						<img src='img/1 (2).jpg' alt='Фото заказа' class='photoAfter'>
						</div>";
				break;
			}			
?>
					<p>Дата создания: <?=$row['time']?></p>
					<p>Категория: <?=$categoryName['name']?></p>
					<p>Статус: <span class=
						<? switch ($row['status']){
							case 'Новая':
							echo "'card-status blue'";
							break;
							case 'Выполнена':
							echo "'card-status green'";
							break;
							case 'На рассмотрении':
							echo "'card-status red'";
							break;														
						}
						 ?>
						><?=$row['status']?></span></p>
					<p><?=$row['description']?></p>
					<? if ($row['status']=='Новая') { ?>

					<form action="../php/delOrder.php" method="post" onsubmit="return confirm('Точно удалить?')">
						<input type="hidden" name="orderId" value="<?=$row['id']?>">					
						<input type="submit" class="button outline-red" name="delOrder" value="Удалить">
					</form>
					
					<? } ?>
				</div>
			</div>
<?php } ?>

		</main>
		<div class="container">
			<p id="bottom" class="sectionName text-blue width-100 light-blue border-blue-left border-blue-top" >Страница пользователя: создание заказов <a style="float: right" href="userPage.php#top" class="button outline-blue width-33">Перейти к перейти к просмотру заказов</a></p>
		</div>
		<div class="container" style="margin-bottom: 50px;">

			<form action="php/addRequest.php" method="post" class="card-wrap shadow width-45" enctype="multipart/form-data">

				<h3 class="card-header blue"> Создание заказа </h3>
				<label for="orderName">Введите название заказа:</label><input id="orderName" class="border-blue" required type="text" name="orderName">
				<label for="orderCategory">Выберите категорию заказа:</label><input class="border-blue" required type="text" placeholder="Выберите категорию" list="categoryList" id="orderCategory" autocomplete="off" name="orderCategory">
				<datalist id="categoryList">
				<?php 
				require_once "db/db.php";
				$categoryNameList=$conn->query('select name from category');
				foreach($categoryNameList as $categoryName){ ?>
					<option><?=$categoryName['name']?></option>
				 <?php } ?>
				</datalist>
				<label for="orderDesc">Введите описание:</label><textarea name="orderDesc" id="orderDesc" class="border-blue" rows="5"></textarea>
				<label for="orderPhoto">Выберите фотографию питомца:</label><input id="orderPhoto" class="border-blue" required type="file" name="orderPhoto">
				<input type="submit" name="orderSubmit" class="button btn-blue" value="Создать">
			</form>
		</div>

		<?php }else{ ?>
		<div id="message" class="alert border-red text-red light-red">Страница доступна только авторизированным пользователям!<a href="authorizationPage.php" class="button btn-green">Войти</a></div>
		<?php } ?>
	</body>
</html>
</body>
</html>