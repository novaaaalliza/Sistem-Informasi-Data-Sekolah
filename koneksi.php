<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "proyek_sistem";

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die("Gagal koneksi database: " . mysqli_connect_error());
}
?>