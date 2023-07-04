<?php 
session_start();
if (!empty($_POST) && isset($_POST['orderSubmit'])){

	$imageFolder=md5(time());
	$uploadImage=$_FILES["orderPhoto"]["name"];

	$extension=pathinfo($uploadImage, PATHINFO_EXTENSION);
	$newName='before.'.$extension;

	require_once "../db/db.php";

	$categoryId=$conn->query("select id from category where name='".$_POST["orderCategory"]."'");
	$categoryId=$categoryId->fetch();

	$addOrderSQL="insert into requests (userId, name, description, time, categoryId, photoPath, photoBefore) values (?,?,?,now(),?,?,?)";
	
	$AddOrder=$conn->prepare($addOrderSQL);
	$AddOrder=$AddOrder->execute(array($_SESSION["userId"], $_POST["orderName"], $_POST["orderDesc"], $categoryId['id'], $imageFolder, $newName));

	if ($AddOrder){
		$folderPath="".__DIR__."\\..\\img\\".$imageFolder."\\";
		mkdir($folderPath);
		move_uploaded_file($_FILES["orderPhoto"]["tmp_name"], "$folderPath".$newName);
		header("location:../userPage.php");
	}

}