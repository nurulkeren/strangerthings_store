<?php
session_start();

include '../config/koneksi.php';

if (isset($_POST['login'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    // ambil data user berdasarkan email
    $query = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $query);

    // cek apakah email ada
    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        // cek password
        if (password_verify($password, $user['password'])) {

            // simpan session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['role']    = $user['role'];

            // cek role
            if ($user['role'] == 'admin') {

                header("Location: ../admin/dashboard.php");

            } else {

                header("Location: ../user/home.php");

            }

        } else {

            echo "Password salah!";

        }

    } else {

        echo "Email tidak ditemukan!";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

</body>
</html>