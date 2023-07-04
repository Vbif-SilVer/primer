<?php
if (isset($_POST['regButton'])
	&& !empty($_POST)
	){
		require_once '../db/db.php';
		$checkLoginSQL=$conn->query("select * from users where login='".$_POST['login']."'");
		$checkLogin=$checkLoginSQL->fetch();
		if (!$checkLogin){
			$prepReg=$conn->prepare("insert into users (fio, login, password, email) values (?, ?, ?, ?)");
			
			if ($prepReg=$prepReg->execute(array($_POST['fio'], $_POST['login'],$_POST['password'],$_POST['email']))){
				session_start();
				$_SESSION['regOk']=true;
				$location='../index.php';
			}
		} else {
			session_start();
			$_SESSION['loginFail']=true;
			$location='../registrationPage.php';
		}
}
header('location:'.$location);
?>