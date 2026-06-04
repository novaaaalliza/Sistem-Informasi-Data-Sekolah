<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Data Siswa</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:linear-gradient(135deg,#6a11cb,#2575fc);
    color:white;
}

.card{
    width:450px;
    margin:50px auto;
    background:rgba(255,255,255,0.15);
    padding:25px;
    border-radius:15px;
    backdrop-filter: blur(10px);
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h3{
    text-align:center;
    margin-bottom:15px;
}

a{
    display:block;
    margin-bottom:15px;
    color:white;
    text-decoration:none;
    font-size:14px;
}

input, select{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border:none;
    border-radius:8px;
    outline:none;
}

button{
    width:100%;
    padding:12px;
    background:#ffe600;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#ffd000;
}

label{
    font-size:13px;
}
</style>
</head>

<body>

<div class="card">

<h3>📋 Form Data Siswa</h3>

<a href="dashboard.php">⬅ Kembali ke Dashboard</a>

<form action="simpan_siswa.php" method="POST" enctype="multipart/form-data">

<!-- ❌ SESSION DIHAPUS, DIGANTI INPUT MANUAL -->
<label>NISN</label>
<input type="text" name="nisn" required>

<label>Foto</label>
<input type="file" name="foto" required>

<label>Nama</label>
<input type="text" name="nama" required>

<label>Jenis Kelamin</label>
<select name="jk" required>
    <option value="">-- Pilih --</option>
    <option value="L">Laki-laki</option>
    <option value="P">Perempuan</option>
</select>

<label>NIK</label>
<input type="text" name="nik" required>

<label>Tempat Lahir</label>
<input type="text" name="tempat_lahir" required>

<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" required>

<label>Alamat</label>
<input type="text" name="alamat" required>

<label>No HP</label>
<input type="text" name="no_hp" required>

<label>Nama Ayah</label>
<input type="text" name="nama_ayah" required>

<label>Nama Ibu</label>
<input type="text" name="nama_ibu" required>

<label>No HP Orang Tua</label>
<input type="text" name="hp_ortu" required>

<button type="submit">💾 Simpan Data</button>

</form>

</div>

</body>
</html>