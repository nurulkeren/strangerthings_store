<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE id_product='$id'";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $nama      = $_POST['nama_product'];
    $harga     = $_POST['harga'];
    $stok      = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $category  = $_POST['id_category'];

    $update = "UPDATE products SET
                id_category='$category',
                nama_product='$nama',
                harga='$harga',
                stok='$stok',
                deskripsi='$deskripsi'
                WHERE id_product='$id'";

    $hasil = mysqli_query($conn, $update);

    if ($hasil) {

        header("Location: data_produk.php");

    } else {

        echo "Update gagal!";

    }
}
?>

<h2>Edit Produk</h2>

<form method="POST">

    <input type="text"
           name="nama_product"
           value="<?= $data['nama_product']; ?>"
           required>
    <br><br>

    <input type="number"
           name="harga"
           value="<?= $data['harga']; ?>"
           required>
    <br><br>

    <input type="number"
           name="stok"
           value="<?= $data['stok']; ?>"
           required>
    <br><br>

    <textarea name="deskripsi"><?= $data['deskripsi']; ?></textarea>
    <br><br>

    <select name="id_category">

        <?php

        $kategori = mysqli_query($conn,
        "SELECT * FROM categories");

        while ($row = mysqli_fetch_assoc($kategori)) {

        ?>

        <option
        value="<?= $row['id_category']; ?>"

        <?php
        if ($row['id_category'] == $data['id_category']) {
            echo "selected";
        }
        ?>

        >

        <?= $row['nama_category']; ?>

        </option>

        <?php } ?>

    </select>

    <br><br>

    <button type="submit" name="update">
        Update Produk
    </button>

</form>