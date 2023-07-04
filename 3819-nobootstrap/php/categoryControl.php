<?php
if (isset($_POST['add']) && !empty($_POST)){
	require_once '../db/db.php';
	$addCategory=$conn->prepare("insert into category (name) values (?)");
	$addCategory=$addCategory->execute(array($_POST['categoryAdd']));
	if ($addCategory){
		session_start();
		$_SESSION['addCatOk']=true;		
	}else{
		session_start();
		$_SESSION['addCatFail']=true;		
	}
}
if (isset($_POST['del']) && !empty($_POST)){
	require_once '../db/db.php';
	$categoryDel=$conn->prepare("delete from category where name=?");
	$categoryDel->execute(array($_POST['categoryDel']));
	if ($categoryDel){
		session_start();
		$_SESSION['delCatOk']=true;		
	}else{
		session_start();
		$_SESSION['delCatFail']=true;		
	}
}
header("location:../admin/index.php#bottom");