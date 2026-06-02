<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {

    header("Location: ../auth/login.php");
    exit;
}

$query = "SELECT orders.*, users.nama
          FROM orders
          JOIN users
          ON orders.id_user = users.id_user
          ORDER BY id_order DESC";

$result = mysqli_query($conn, $query);

?>

<h1>Data Pesanan</h1>

<table border="1" cellpadding="10">

<tr>
    <th>ID Order</th>
    <th>Customer</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

    <td>
        <?= $row['id_order']; ?>
    </td>

    <td>
        <?= $row['nama']; ?>
    </td>

    <td>
        <?= $row['tanggal']; ?>
    </td>

    <td>
        Rp <?= number_format($row['total']); ?>
    </td>

    <td>
        <?= $row['status']; ?>
    </td>

    <td>

    <a href="detail_pesanan.php?id=<?= $row['id_order']; ?>">
        Detail
    </a>



    <a href="update_status.php?id=<?= $row['id_order']; ?>">
        Update Status
    </a>

    </td>

</tr>

<?php } ?>

</table>