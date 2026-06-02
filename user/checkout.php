<?php
session_start();

include '../config/koneksi.php';

// cek login
if (!isset($_SESSION['id_user'])) {

    header("Location: ../auth/login.php");
    exit;
}

// cek cart kosong
if (empty($_SESSION['cart'])) {

    echo "Keranjang kosong!";
    exit;
}

$id_user = $_SESSION['id_user'];

$total = 0;

// hitung total
foreach ($_SESSION['cart'] as $id_product => $qty) {

    $query = "SELECT * FROM products
              WHERE id_product='$id_product'";

    $result = mysqli_query($conn, $query);

    $data = mysqli_fetch_assoc($result);

    $subtotal = $data['harga'] * $qty;

    $total += $subtotal;
}

// simpan ke orders
$insert_order = "INSERT INTO orders
                 (id_user, tanggal, total, status)
                 VALUES
                 ('$id_user', NOW(), '$total', 'Menunggu')";

mysqli_query($conn, $insert_order);

// ambil id order terakhir
$id_order = mysqli_insert_id($conn);

// simpan detail order
foreach ($_SESSION['cart'] as $id_product => $qty) {

    $query = "SELECT * FROM products
              WHERE id_product='$id_product'";

    $result = mysqli_query($conn, $query);

    $data = mysqli_fetch_assoc($result);

    $subtotal = $data['harga'] * $qty;

    $insert_detail = "INSERT INTO order_detail
                     (id_order, id_product, qty, subtotal)
                     VALUES
                     ('$id_order','$id_product','$qty','$subtotal')";

    mysqli_query($conn, $insert_detail);
    $update_stok = "UPDATE products
                 SET stok = stok - $qty
                 WHERE id_product='$id_product'";

mysqli_query($conn, $update_stok);
}

// kosongkan cart
unset($_SESSION['cart']);

echo "Checkout berhasil!";
?>