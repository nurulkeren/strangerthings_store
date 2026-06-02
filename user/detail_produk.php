<?php
session_start();

include '../config/koneksi.php';

$id = $_GET['id'];

$query = "SELECT * FROM products
          WHERE id_product='$id'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);
?>

<h1>Detail Produk</h1>

<img src="../assets/img/<?= $data['gambar']; ?>"
     width="300">

<h2>
<?= $data['nama_product']; ?>
</h2>

<p>
Harga:
Rp <?= number_format($data['harga']); ?>
</p>

<p>
Stok:
<?= $data['stok']; ?>
</p>

<p>
<?= $data['deskripsi']; ?>
</p>

<p>
Ukuran:
<?= $data['ukuran']; ?>
</p>

<form method="POST" action="tambah_cart.php">

    <input type="hidden"
           name="id_product"
           value="<?= $data['id_product']; ?>">

    <input type="number"
           name="qty"
           value="1"
           min="1">

    <br><br>

    <button type="submit" name="cart">
        Tambah ke Keranjang
    </button>

</form>