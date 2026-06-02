<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$query = "SELECT products.*, categories.nama_category
          FROM products
          JOIN categories
          ON products.id_category = categories.id_category";

$result = mysqli_query($conn, $query);

?>

<h2>Data Produk</h2>

<a href="tambah_produk.php">
Tambah Produk
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Kategori</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;

while ($row = mysqli_fetch_assoc($result)) {
?>

<tr>

    <td><?= $no++; ?></td>

    <td><?= $row['nama_product']; ?></td>

    <td><?= $row['nama_category']; ?></td>

    <td><?= $row['harga']; ?></td>

    <td><?= $row['stok']; ?></td>

    <td>

        <a href="edit_produk.php?id=<?= $row['id_product']; ?>">
            Edit
        </a>

        |

        <a href="hapus_produk.php?id=<?= $row['id_product']; ?>">
            Hapus
        </a>

    </td>

</tr>

<?php } ?>

</table>