<?php

$host = "localhost";
$user = "root";
$pass = "nurul008";
$db   = "strangerthings_store";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>