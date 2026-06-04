<?php
session_start();
include 'koneksi.php';

/* =========================
   CEK LOGIN
========================= */
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

/* =========================
   AMBIL DATA BERDASARKAN ID
========================= */
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

/* =========================
   PROSES UPDATE
========================= */
if (isset($_POST['update'])) {

    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $nik = $_POST['nik'];
    $tempat = $_POST['tempat_lahir'];
    $tgl = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['no_hp'];
    $ayah = $_POST['nama_ayah'];
    $ibu = $_POST['nama_ibu'];
    $hp = $_POST['hp_ortu'];

    /* =========================
       FOTO (OPSIONAL UPDATE)
    ========================= */
    if ($_FILES['foto']['name'] != "") {

        $foto = $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];

        $namaFileBaru = time() . "_" . $foto;

        move_uploaded_file($tmp, "foto/".$namaFileBaru);

        mysqli_query($koneksi, "UPDATE siswa SET
            nisn='$nisn',
            nama='$nama',
            jk='$jk',
            nik='$nik',
            tempat_lahir='$tempat',
            tanggal_lahir='$tgl',
            alamat='$alamat',
            no_hp='$nohp',
            nama_ayah='$ayah',
            nama_ibu='$ibu',
            hp_ortu='$hp',
            foto='$namaFileBaru'
            WHERE id='$id'
        ");

    } else {

        mysqli_query($koneksi, "UPDATE siswa SET
            nisn='$nisn',
            nama='$nama',
            jk='$jk',
            nik='$nik',
            tempat_lahir='$tempat',
            tanggal_lahir='$tgl',
            alamat='$alamat',
            no_hp='$nohp',
            nama_ayah='$ayah',
            nama_ibu='$ibu',
            hp_ortu='$hp'
            WHERE id='$id'
        ");
    }

    header("Location: data_siswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Siswa</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:linear-gradient(135deg,#6a11cb,#2575fc);
    color:white;
}

.card{
    width:450px;
    margin:40px auto;
    background:rgba(255,255,255,0.15);
    padding:25px;
    border-radius:15px;
    backdrop-filter:blur(10px);
}

input, select{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border:none;
    border-radius:8px;
}

button{
    width:100%;
    padding:12px;
    background:#ffe600;
    border:none;
    font-weight:bold;
    border-radius:10px;
    cursor:pointer;
}

img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:8px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="card">

<h3>✏️ Edit Data Siswa</h3>

<form method="POST" enctype="multipart/form-data">

<label>NISN</label>
<input type="text" name="nisn" value="<?= $row['nisn'] ?>" required>

<label>Nama</label>
<input type="text" name="nama" value="<?= $row['nama'] ?>" required>

<label>Jenis Kelamin</label>
<select name="jk">
    <option value="L" <?= $row['jk']=="L"?"selected":"" ?>>Laki-laki</option>
    <option value="P" <?= $row['jk']=="P"?"selected":"" ?>>Perempuan</option>
</select>

<label>NIK</label>
<input type="text" name="nik" value="<?= $row['nik'] ?>" required>

<label>Tempat Lahir</label>
<input type="text" name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>" required>

<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>" required>

<label>Alamat</label>
<input type="text" name="alamat" value="<?= $row['alamat'] ?>" required>

<label>No HP</label>
<input type="text" name="no_hp" value="<?= $row['no_hp'] ?>" required>

<label>Nama Ayah</label>
<input type="text" name="nama_ayah" value="<?= $row['nama_ayah'] ?>" required>

<label>Nama Ibu</label>
<input type="text" name="nama_ibu" value="<?= $row['nama_ibu'] ?>" required>

<label>No HP Ortu</label>
<input type="text" name="hp_ortu" value="<?= $row['hp_ortu'] ?>" required>

<label>Foto Lama</label><br>
<img src="foto/<?= $row['foto'] ?>">

<label>Ganti Foto (opsional)</label>
<input type="file" name="foto">

<br>

<button type="submit" name="update">💾 Update Data</button>

</form>

</div>

</body>
</html>