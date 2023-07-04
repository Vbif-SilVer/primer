<header  class="header shadow">
	<a class="inHeader" href="../index.php">
		<img src="../logo/logo.png" alt="">
		<p>Animals cuting</p>
	</a>
	<div class="inHeader width-25">

		<?php if ($_SESSION['userAuth']){ ?>
			<a href="../userPage.php" class="button btn-green width-100">Личный кабинет</a>
			<a href="../php/logout.php" class="button btn-red width-100">Выход</a>

		<?php } elseif ($_SESSION['adminAuth']) { ?>
			<a href="../admin" class="button btn-green width-100">Панель управления</a>
			<a href="../php/logout.php" class="button btn-red width-100">Выход</a>

		<?php } else { ?>
			<a href="registrationPage.php" class="button btn-blue width-100">Регистрация</a>
			<a href="authorizationPage.php" class="button btn-green width-100">Вход</a>
		<?php } ?>
	</div>
</header>