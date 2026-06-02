<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn,
"DELETE FROM order_detail
 WHERE id_product='$id'");

$query = "DELETE FROM products
          WHERE id_product='$id'";

$hapus = mysqli_query($conn, $query);

if ($hapus) {

    header("Location: data_produk.php");

} else {

    echo "Data gagal dihapus!";

}
?>