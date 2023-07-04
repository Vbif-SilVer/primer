<?php 
require_once "../db/db.php";
$categoryNameList=$conn->query('select name from category');
?>