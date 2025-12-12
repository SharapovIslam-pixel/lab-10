<?php
$dsn = "mysql:host=localhost;dbname=project;charset=utf8";
$user = "root";
$pass = "";

$pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>
