<?php
session_start();
include 'koneksi.php';

// proteksi login
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// ambil nisn dari session
$nisn = $_SESSION['nisn'] ?? '';

// ambil data siswa berdasarkan nisn
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
$data = mysqli_fetch_assoc($query);

// kalau tidak ada data
if(!$data){
    echo "Data profil tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Siswa</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:linear-gradient(135deg,#4facfe,#00f2fe);
}

.container{
    width:60%;
    margin:50px auto;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

img{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:15px;
}

.back{
    display:inline-block;
    margin-bottom:15px;
    text-decoration:none;
    color:white;
    background:#333;
    padding:8px 12px;
    border-radius:8px;
}
</style>
</head>

<body>

<div class="container">

<a href="dashboard_siswa.php" class="back">⬅ Kembali</a>

<div class="card" style="text-align:center;">

    <img src="foto/<?= $data['foto']; ?>">

    <h2><?= $data['nama']; ?></h2>

    <p><b>NISN:</b> <?= $data['nisn']; ?></p>
    <p><b>NIK:</b> <?= $data['nik']; ?></p>
    <p><b>Jenis Kelamin:</b> <?= $data['jk']; ?></p>
    <p><b>TTL:</b> <?= $data['tempat_lahir']; ?>, <?= $data['tanggal_lahir']; ?></p>
    <p><b>Alamat:</b> <?= $data['alamat']; ?></p>
    <p><b>No HP Siswa:</b> <?= $data['no_hp']; ?></p>
    <p><b>Ayah:</b> <?= $data['nama_ayah']; ?></p>
    <p><b>Ibu:</b> <?= $data['nama_ibu']; ?></p>
    <p><b>No HP Orang Tua:</b> <?= $data['hp_ortu']; ?></p>

</div>

</div>

</body>
</html>