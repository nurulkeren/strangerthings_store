<?php
session_start();

include '../config/koneksi.php';

$query = "SELECT products.*, categories.nama_category
          FROM products
          JOIN categories
          ON products.id_category = categories.id_category";

$result = mysqli_query($conn, $query);
?>

<h1>Semua Merchandise</h1>

<a href="cart.php">
Keranjang
</a>

<hr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div style="border:1px solid black;
padding:10px;
margin-bottom:20px;
width:300px;">

<img src="../assets/img/<?= $row['gambar']; ?>"
     width="200">

    <h3>
        <?= $row['nama_product']; ?>
    </h3>

    <p>
        Kategori:
        <?= $row['nama_category']; ?>
    </p>

    <p>
        Harga:
        Rp <?= number_format($row['harga']); ?>
    </p>

    <p>
        Stok:
        <?= $row['stok']; ?>
    </p>

    <a href="detail_produk.php?id=<?= $row['id_product']; ?>">
        Detail Produk
    </a>

</div>

<?php } ?>