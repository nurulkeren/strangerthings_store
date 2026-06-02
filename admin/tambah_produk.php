<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['tambah'])) {

    $nama       = $_POST['nama_product'];
    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];
    $deskripsi  = $_POST['deskripsi'];
    $category   = $_POST['id_category'];
    $ukuran = $_POST['ukuran'];
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp,
    "../assets/img/" . $gambar);

    $query = "INSERT INTO products
              (id_category, nama_product, harga, stok, deskripsi, gambar, ukuran)
              VALUES
              ('$category','$nama','$harga','$stok','$deskripsi','$gambar','$ukuran')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Produk berhasil ditambahkan!";
    } else {
        echo "Produk gagal ditambahkan!";
    }
}
?>

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text"
           name="nama_product"
           placeholder="Nama Produk"
           required>
    <br><br>

    <input type="number"
           name="harga"
           placeholder="Harga"
           required>
    <br><br>

    <input type="number"
           name="stok"
           placeholder="Stok"
           required>
    <br><br>

    <textarea name="deskripsi"
              placeholder="Deskripsi"></textarea>
    <br><br>

    <select name="id_category">

        <?php

        $kategori = mysqli_query($conn,
        "SELECT * FROM categories");

        while ($row = mysqli_fetch_assoc($kategori)) {

        ?>

        <option value="<?= $row['id_category']; ?>">
            <?= $row['nama_category']; ?>
        </option>

        <?php } ?>

    </select>
    <br><br>

    <input type="text"
       name="ukuran"
       placeholder="Contoh: S,M,L,XL">
    <br><br>

    <input type="file" name="gambar" required>

    <br><br>

    <button type="submit" name="tambah">
        Tambah Produk
    </button>

</form>