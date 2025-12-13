<?php
session_start();
$_SESSION['notes'] = [];
header("Location: notes.php");
?>