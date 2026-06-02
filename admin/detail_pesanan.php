<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {

    header("Location: ../auth/login.php");
    exit;
}

$id_order = $_GET['id'];

$query = "SELECT order_detail.*, products.nama_product
          FROM order_detail
          JOIN products
          ON order_detail.id_product = products.id_product
          WHERE order_detail.id_order='$id_order'";

$result = mysqli_query($conn, $query);

?>

<h1>Detail Pesanan</h1>

<table border="1" cellpadding="10">

<tr>
    <th>Produk</th>
    <th>Qty</th>
    <th>Subtotal</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td>
        <?= $row['nama_product']; ?>
    </td>

    <td>
        <?= $row['qty']; ?>
    </td>

    <td>
        Rp <?= number_format($row['subtotal']); ?>
    </td>

</tr>

<?php } ?>

</table>