<?php
if (isset($_POST['authButton'])
	&& !empty($_POST['authLogin'])
	&& !empty($_POST['authPassword']))
	{
		require_once '../db/db.php';
		$sql="select * from users where login=? and password=?";
		$auth=$conn->prepare($sql);
		$auth->execute(array($_POST['authLogin'],$_POST['authPassword']));
		$auth=$auth->fetch();
		if (!empty($auth)){
			session_start();
			if ($auth['role']==1) {
				$_SESSION['adminAuth']=true;
				unset($_SESSION['userAuth']);
				$location='../admin';
			} else{
				$_SESSION['userAuth']=true;
				$_SESSION['userId']=$auth['id'];
				unset($_SESSION['adminAuth']);
				$location='../userPage.php';
			}
		} else{
			session_start();
			$_SESSION['authFail']=true;
			$location='../authorizationPage.php';
		}
	}
	header('location:'.$location);
	?>