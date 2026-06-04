<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'guru') {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

$edit = $data ? true : false;

// SIMPAN / UPDATE
if (isset($_POST['simpan'])) {

    $nama   = $_POST['nama'];
    $jk     = $_POST['jk'];
    $nuptk  = $_POST['nuptk'];
    $nik    = $_POST['nik'];
    $email  = $_POST['email'];
    $no_hp  = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $foto = $data['foto'] ?? '';

    // upload foto
    if (!empty($_FILES['foto']['name'])) {
        $file = time() . "_" . $_FILES['foto']['name'];
        $tmp  = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "upload/" . $file);
        $foto = $file;
    }

    if ($edit) {
        mysqli_query($koneksi, "
            UPDATE guru SET
                nama='$nama',
                jk='$jk',
                nuptk='$nuptk',
                nik='$nik',
                email='$email',
                no_hp='$no_hp',
                alamat='$alamat',
                foto='$foto'
            WHERE username='$username'
        ");
    } else {
        mysqli_query($koneksi, "
            INSERT INTO guru
            (username, nama, jk, nuptk, nik, email, no_hp, alamat, foto)
            VALUES
            ('$username','$nama','$jk','$nuptk','$nik','$email','$no_hp','$alamat','$foto')
        ");
    }

    header("Location: dashboard_guru.php?status=sukses");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Data Guru</title>

<style>
body{
    font-family:Segoe UI;
    margin:0;
    background:linear-gradient(135deg,#4f46e5,#7c3aed,#a855f7);
}

.container{
    width:650px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 25px 60px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    color:#6d28d9;
    margin-bottom:15px;
}

.preview{
    text-align:center;
    margin-bottom:15px;
}

.preview img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #7c3aed;
}

input, select, textarea{
    width:100%;
    padding:12px;
    margin:8px 0;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
}

button{
    width:100%;
    padding:14px;
    background:#7c3aed;
    color:white;
    border:none;
    border-radius:12px;
    cursor:pointer;
    font-weight:bold;
    font-size:15px;
}

button:hover{
    background:#6d28d9;
}

.back{
    display:block;
    text-align:center;
    margin-top:12px;
    text-decoration:none;
    color:#6d28d9;
    font-weight:bold;
}

</style>
</head>

<body>

<div class="container">

<h2><?= $edit ? "Edit Data Guru" : "Isi Data Guru" ?></h2>

<!-- FOTO -->
<div class="preview">
    <img src="upload/<?= $data['foto'] ?? 'default.png' ?>">
</div>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="nama" placeholder="Nama Lengkap"
value="<?= $data['nama'] ?? '' ?>">

<select name="jk">
    <option value="L" <?= (isset($data['jk']) && $data['jk']=='L')?'selected':'' ?>>Laki-laki</option>
    <option value="P" <?= (isset($data['jk']) && $data['jk']=='P')?'selected':'' ?>>Perempuan</option>
</select>

<input type="text" name="nuptk" placeholder="NUPTK"
value="<?= $data['nuptk'] ?? '' ?>">

<input type="text" name="nik" placeholder="NIK"
value="<?= $data['nik'] ?? '' ?>">

<input type="email" name="email" placeholder="Email"
value="<?= $data['email'] ?? '' ?>">

<input type="text" name="no_hp" placeholder="No HP"
value="<?= $data['no_hp'] ?? '' ?>">

<textarea name="alamat" placeholder="Alamat"><?= $data['alamat'] ?? '' ?></textarea>

<input type="file" name="foto">

<button type="submit" name="simpan">Simpan Data</button>

</form>

<a href="dashboard_guru.php" class="back">⬅ Kembali ke Dashboard</a>

</div>

</body>
</html>