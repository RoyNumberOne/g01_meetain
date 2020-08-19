<?php 
	$dsn = "mysql:host=localhost;port=8889;dbname=meetainDataIn;charset=utf8";
	$user = "root";
	$password = "root";
	$options = array(PDO::ATTR_CASE=>PDO::CASE_NATURAL, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
	$pdo = new PDO($dsn , $user , $password, $options);
?>