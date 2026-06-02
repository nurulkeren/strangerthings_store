<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<h1>Dashboard Admin</h1>

<p>
Selamat datang,
<?php echo $_SESSION['nama']; ?>
</p>

<a href="../auth/logout.php">
Logout
</a>