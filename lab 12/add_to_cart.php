<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$id = $_POST['id'];
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity']++;
} else {
    $_SESSION['cart'][$id] = ['id' => $id, 'quantity' => 1];
}
header("Location: products.php");
?>