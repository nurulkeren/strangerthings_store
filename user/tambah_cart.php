<?php
session_start();

$id_product = $_POST['id_product'];
$qty = $_POST['qty'];

// cek apakah cart sudah ada
if (!isset($_SESSION['cart'])) {

    $_SESSION['cart'] = [];
}

// cek apakah produk sudah ada di cart
if (isset($_SESSION['cart'][$id_product])) {

    $_SESSION['cart'][$id_product] += $qty;

} else {

    $_SESSION['cart'][$id_product] = $qty;

}

header("Location: cart.php");
?>