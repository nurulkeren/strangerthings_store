<?php
include '../config/koneksi.php';

if (isset($_POST['register'])) {

    $nama     = $_POST['nama'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // enkripsi password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // query insert
    $query = "INSERT INTO users (nama, email, password)
              VALUES ('$nama', '$email', '$hash')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Register berhasil!";
    } else {
        echo "Register gagal!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">

    <input type="text" name="nama" placeholder="Nama" required>
    <br><br>

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit" name="register">
        Register
    </button>

</form>

</body>
</html>