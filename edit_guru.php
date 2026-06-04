<?php
session_start();
include 'koneksi.php';

/* CEK LOGIN */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'guru') {
    header("Location: index.php");
    exit;
}

/* AMBIL USER */
$username = $_SESSION['username'];

/* AMBIL DATA GURU */
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE username='$username'");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    die("❌ Data guru tidak ditemukan!");
}

/* UPDATE DATA */
if (isset($_POST['update'])) {

    $nama   = $_POST['nama'];
    $jk     = $_POST['jk'];
    $nuptk  = $_POST['nuptk'];
    $nik    = $_POST['nik'];
    $email  = $_POST['email'];
    $no_hp  = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $tempat = $_POST['tempat_lahir'];
    $tgl    = $_POST['tanggal_lahir'];

    $foto = $row['foto'];

    /* upload foto */
    if (!empty($_FILES['foto']['name'])) {

        $foto = time() . "_" . $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "upload/" . $foto);
    }

    mysqli_query($koneksi, "UPDATE guru SET
        nama='$nama',
        jk='$jk',
        nuptk='$nuptk',
        nik='$nik',
        email='$email',
        no_hp='$no_hp',
        alamat='$alamat',
        tempat_lahir='$tempat',
        tanggal_lahir='$tgl',
        foto='$foto'
        WHERE username='$username'
    ");

    header("Location: dashboard_guru.php?status=updated");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data Guru</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:linear-gradient(135deg,#667eea,#764ba2);
    color:white;
}

/* CARD */
.card{
    width:550px;
    margin:40px auto;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(12px);
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:20px;
}

/* FOTO */
.preview{
    text-align:center;
    margin-bottom:15px;
}

.preview img{
    width:100px;
    height:100px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #fff;
}

/* INPUT */
label{
    font-size:13px;
    font-weight:bold;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin:6px 0 12px 0;
    border:none;
    border-radius:10px;
    outline:none;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#ffdd57;
    border:none;
    border-radius:10px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#ffd000;
}

/* BACK */
a{
    display:block;
    text-align:center;
    margin-top:12px;
    color:#fff;
    text-decoration:none;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="card">

<h2>✏️ Edit Data Guru</h2>

<div class="preview">
    <img src="upload/<?= $row['foto'] ?? 'default.png' ?>">
</div>

<form method="POST" enctype="multipart/form-data">

<label>Nama</label>
<input type="text" name="nama" value="<?= $row['nama'] ?>">

<label>Jenis Kelamin</label>
<select name="jk">
    <option value="L" <?= $row['jk']=='L'?'selected':'' ?>>Laki-laki</option>
    <option value="P" <?= $row['jk']=='P'?'selected':'' ?>>Perempuan</option>
</select>

<label>NUPTK</label>
<input type="text" name="nuptk" value="<?= $row['nuptk'] ?>">

<label>NIK</label>
<input type="text" name="nik" value="<?= $row['nik'] ?>">

<label>Tempat Lahir</label>
<input type="text" name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>">

<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>">

<label>Email</label>
<input type="email" name="email" value="<?= $row['email'] ?>">

<label>No HP</label>
<input type="text" name="no_hp" value="<?= $row['no_hp'] ?>">

<label>Alamat</label>
<textarea name="alamat"><?= $row['alamat'] ?></textarea>

<label>Ganti Foto</label>
<input type="file" name="foto">

<button type="submit" name="update">💾 Update Data</button>

</form>

<a href="dashboard_guru.php">⬅ Kembali</a>

</div>

</body>
</html>