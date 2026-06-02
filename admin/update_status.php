<?php
session_start();

include '../config/koneksi.php';

if ($_SESSION['role'] != 'admin') {

    header("Location: ../auth/login.php");
    exit;
}

$id_order = $_GET['id'];

$query = "SELECT * FROM orders
          WHERE id_order='$id_order'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $status = $_POST['status'];

    $update = "UPDATE orders
               SET status='$status'
               WHERE id_order='$id_order'";

    $hasil = mysqli_query($conn, $update);

    if ($hasil) {

        header("Location: data_pesanan.php");

    } else {

        echo "Status gagal diupdate!";
    }
}
?>

<h1>Update Status Pesanan</h1>

<form method="POST">

<select name="status">

    <option value="Menunggu"
    <?= ($data['status'] == 'Menunggu') ? 'selected' : ''; ?>>
    Menunggu
    </option>

    <option value="Dikemas"
    <?= ($data['status'] == 'Dikemas') ? 'selected' : ''; ?>>
    Dikemas
    </option>

    <option value="Dikirim"
    <?= ($data['status'] == 'Dikirim') ? 'selected' : ''; ?>>
    Dikirim
    </option>

    <option value="Selesai"
    <?= ($data['status'] == 'Selesai') ? 'selected' : ''; ?>>
    Selesai
    </option>

    <option value="Dibatalkan"
    <?= ($data['status'] == 'Dibatalkan') ? 'selected' : ''; ?>>
    Dibatalkan
    </option>

</select>

<br><br>

<button type="submit" name="update">
    Update Status
</button>

</form>