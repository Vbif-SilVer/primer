<?php session_start();
require_once "../db/db.php"; 
$orders=$conn->query("select * from requests ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/style.css">
		<script defer src="../js/scripts.js"></script>
		<title>Страница администратора</title>
	</head>
	<body>
		<?php include "../include/header.php";
		if ($_SESSION['adminAuth']){ ?>
		<div class="container">
			<p id="top" class="sectionName text-blue width-100 light-blue border-blue-left border-blue-top">Администрирование: управление заявками пользователей <a style="float: right" href="index.php#bottom" class="button outline-blue width-33">Перейти к управлению категориями </a></p>
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
						<img src='../img/1.jpg' alt='Фото заказа'>
						</div>";
				break;
				case 'На рассмотрении':
					echo "<div class='card-wrap width-33 reject'>
						<div class='card shadow'>
						<h3 class='card-header red'>".$row['name']."</h3>
						<div class='img-wrap'>
						<img src='../img/1.jpg' alt='Фото заказа'>
						</div>";
				break;
				case 'Выполнена':
					echo "<div class='card-wrap width-33 complete'>
						<div class='card shadow'>
						<h3 class='card-header green'>".$row['name']."</h3>
						<div class='img-wrap changePhoto'>
						<img src='../img/1 (1).jpg' alt='Фото заказа' class='photoBefore'>
						<img src='../img/1 (2).jpg' alt='Фото заказа' class='photoAfter'>
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
					<form action="../php/changeStatus.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="orderId" value="<?=$row['id']?>">
						<input type="file" class="border-green" name="addPhoto" required>
						<input type="submit" class="button outline-green" value="Отметить как выполненную" name="confirmStatus">
					</form>
					<form action="../php/changeStatus.php" method="post">
						<input type="hidden" name="orderId" value="<?=$row['id']?>">
						<input type="submit" class="button outline-red" value="Отправить на рассмотрение" name="rejectStatus">
					</form>
					<? } ?>
				</div>
			</div>
<?php } ?>
		</main>

		<div class="container">
			<p id="bottom" class="sectionName text-blue width-100 light-blue border-blue-left border-blue-top">Администрирование: управление категориями <a style="float: right" href="index.php#top" class="button outline-blue width-33">Перейти к просмотру заказов</a></p>
		</div>

		<div class="container">
			<?php if ($_SESSION['addCatOk']){
			unset($_SESSION['addCatOk']);?>
			<div id="message" class="alert width-100 border-green text-green light-green"><p>Категория успешно добавлена!!</p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php }
			if ($_SESSION['addCatFail']){
			unset($_SESSION['addCatFail']);?>
			<div id="message" class="alert width-100 border-red text-red light-red"><p>Ошибка добавления категории!!</p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php }
			if ($_SESSION['delCatOk']){
			unset($_SESSION['delCatOk']);?>
			<div id="message" class="alert width-100 border-green text-green light-green"><p>Категория успешно удалена!!</p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php }
			if ($_SESSION['delCatFail']){
			unset($_SESSION['delCatFail']);?>
			<div id="message" class="alert width-100 border-red text-red light-red"><p>Ошибка удаления категории!!</p><small>Нажмите на сообщение, что бы скрыть его.</small></div>
			<?php } ?>			

		<div class="container" style="margin-bottom: 50px;">
			<form action="../php/categoryControl.php" method="POST" class="card-wrap shadow width-45">
				<h3 class="card-header green"> Добавление категории </h3>
				<input class="border-green" required type="text" placeholder="Введите название категории для создания" name="categoryAdd">
				<input type="submit" class="button btn-green" value="Добавить" name="add">
			</form>

			<form action="../php/categoryControl.php" method="POST" class="card-wrap shadow width-45">
				<h3 class="card-header red"> Удаление категории </h3>
				<input class="border-red" required type="text" placeholder="Выберите категорию для удаления" list="categoryList" name="categoryDel" autocomplete="off">
			
				<datalist id="categoryList">
				<?php 
				require_once "../db/db.php";
				$categoryNameList=$conn->query('select name from category');
				foreach($categoryNameList as $categoryName){ ?>
					<option><?=$categoryName['name']?></option>
				 <?php } ?>
				</datalist>

				<input type="submit" class="button btn-red" value="Удалить" name="del">
			</form>
		</div>
		<?php }else{ ?>
		<div id="message" class="alert border-red text-red light-red">Страница доступна только авторизированному администратору!<a href="../authorizationPage.php" class="button btn-green">Войти</a></div>
		<?php } ?>
	</body>
</html>