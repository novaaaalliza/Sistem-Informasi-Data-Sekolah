<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

// cek apakah sudah ada data
$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

$edit = $data ? true : false;

// kalau submit
if (isset($_POST['simpan'])) {

    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $nik = $_POST['nik'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $nama_ayah = $_POST['nama_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $hp_ortu = $_POST['hp_ortu'];

    // upload foto
    $foto = $data['foto'];

    if (!empty($_FILES['foto']['name'])) {
        $file = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $path = "foto/".$file;
        move_uploaded_file($tmp, $path);
        $foto = $file;
    }

    if ($edit) {
        // UPDATE
        mysqli_query($koneksi,
            "UPDATE siswa SET
                nisn='$nisn',
                nama='$nama',
                jk='$jk',
                nik='$nik',
                tempat_lahir='$tempat_lahir',
                tanggal_lahir='$tanggal_lahir',
                alamat='$alamat',
                no_hp='$no_hp',
                nama_ayah='$nama_ayah',
                nama_ibu='$nama_ibu',
                hp_ortu='$hp_ortu',
                foto='$foto'
            WHERE username='$username'
        ");
    } else {
        // INSERT
        mysqli_query($koneksi,
            "INSERT INTO siswa
            (username, nisn, nama, jk, nik, tempat_lahir, tanggal_lahir, alamat, no_hp, nama_ayah, nama_ibu, hp_ortu, foto)
            VALUES
            ('$username','$nisn','$nama','$jk','$nik','$tempat_lahir','$tanggal_lahir','$alamat','$no_hp','$nama_ayah','$nama_ibu','$hp_ortu','$foto')
        ");
    }

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Form Data Siswa</title>
<style>
body{
    font-family:Segoe UI;
    background:linear-gradient(135deg,#ddd6fe,#f5d0fe);
    padding:30px;
}
.form{
    background:white;
    padding:20px;
    border-radius:15px;
    width:500px;
    margin:auto;
    box-shadow:0 10px 20px rgba(0,0,0,0.1);
}
input, select{
    width:100%;
    padding:10px;
    margin:8px 0;
}
button{
    padding:10px;
    background:#7c3aed;
    color:white;
    border:none;
    width:100%;
    border-radius:10px;
}
</style>
</head>

<body>

<div class="form">
<h2><?= $edit ? "Edit Data Siswa" : "Isi Data Siswa" ?></h2>

<form method="POST" enctype="multipart/form-data">

    NISN
    <input type="text" name="nisn" value="<?= $data['nisn'] ?? '' ?>">

    Nama
    <input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>">

    Jenis Kelamin
    <select name="jk">
        <option <?= (isset($data['jk']) && $data['jk']=='L')?'selected':'' ?>>L</option>
        <option <?= (isset($data['jk']) && $data['jk']=='P')?'selected':'' ?>>P</option>
    </select>

    NIK
    <input type="text" name="nik" value="<?= $data['nik'] ?? '' ?>">

    Tempat Lahir
    <input type="text" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?? '' ?>">

    Tanggal Lahir
    <input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?? '' ?>">

    Alamat
    <input type="text" name="alamat" value="<?= $data['alamat'] ?? '' ?>">

    No HP
    <input type="text" name="no_hp" value="<?= $data['no_hp'] ?? '' ?>">

    Nama Ayah
    <input type="text" name="nama_ayah" value="<?= $data['nama_ayah'] ?? '' ?>">

    Nama Ibu
    <input type="text" name="nama_ibu" value="<?= $data['nama_ibu'] ?? '' ?>">

    HP Orang Tua
    <input type="text" name="hp_ortu" value="<?= $data['hp_ortu'] ?? '' ?>">

    Foto
    <input type="file" name="foto">

    <button type="submit" name="simpan">Simpan</button>

</form>
</div>

</body>
</html>