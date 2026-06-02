<?php
session_start();

include '../config/koneksi.php';

$total = 0;

?>

<h1>Keranjang Belanja</h1>

<a href="produk.php">
Kembali Belanja
</a>

<hr>

<table border="1" cellpadding="10">

<tr>
    <th>Produk</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
</tr>

<?php

if (!empty($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $id_product => $qty) {

        $query = "SELECT * FROM products
                  WHERE id_product='$id_product'";

        $result = mysqli_query($conn, $query);

        $data = mysqli_fetch_assoc($result);

        $subtotal = $data['harga'] * $qty;

        $total += $subtotal;
?>

<tr>

    <td>
        <?= $data['nama_product']; ?>
    </td>

    <td>
        Rp <?= number_format($data['harga']); ?>
    </td>

    <td>
        <?= $qty; ?>
    </td>

    <td>
        Rp <?= number_format($subtotal); ?>
    </td>

</tr>

<?php
    }
}
?>

</table>

<h3>
Total:
Rp <?= number_format($total); ?>
</h3>

<br>

<a href="checkout.php">
Checkout
</a>