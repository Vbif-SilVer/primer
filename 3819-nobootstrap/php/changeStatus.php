<?php
if (isset($_POST['rejectStatus']) && !empty($_POST)){
	require_once "../db/db.php";
	$changeStatus=$conn->prepare("update requests set status='На рассмотрении' where id=?");
	$changeStatus=$changeStatus->execute(array($_POST['orderId']));
	header('location: ../admin');
}

if (isset($_POST['confirmStatus']) && !empty($_POST)){
	require_once "../db/db.php";

	$uploadImage=$_FILES["addPhoto"]["name"];

	$extension=pathinfo($uploadImage, PATHINFO_EXTENSION);
	$newName='after.'.$extension;

	$changeStatus=$conn->prepare("update requests set status='Выполнена', photoAfter=? where id=?");
	$changeStatus=$changeStatus->execute(array($newName, $_POST['orderId']));

	$imageFolder=$conn->query("select photoPath from requests where id='".$_POST['orderId']."'")->fetch();

	$folderPath="".__DIR__."\\..\\img\\".$imageFolder['photoPath']."\\";	
	move_uploaded_file($_FILES["addPhoto"]["tmp_name"], "$folderPath".$newName);

	header('location: ../admin');
}