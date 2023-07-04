<?php	
	require_once '../db/db.php';
	$checkLoginSQL=$conn->query("select * from users where login='".$_POST['login']."'");
	$checkLogin=$checkLoginSQL->fetch();
	if ($checkLogin){
		echo "0";
	} else {
		echo "1";
	}
?>