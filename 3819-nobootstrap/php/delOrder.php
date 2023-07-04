<?php
if (isset($_POST['delOrder']) and !empty($_POST)){
	require_once "../db/db.php";
	$delOrder=$conn->prepare('delete from requests where id=?');
	$delOrder=$delOrder->execute(array($_POST['orderId']));
	header('location: ../userPage.php');
}