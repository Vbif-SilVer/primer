<?php
$connSetup="mysql:host=localhost;dbname=nobootstrap";
$connUser="root";
$connPassword="";
$connErrMode=[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$conn= new PDO($connSetup,$connUser,$connPassword,$connErrMode);
?>