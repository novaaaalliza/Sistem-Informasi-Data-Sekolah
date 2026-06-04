<?php
session_start();
include "koneksi.php";

// proteksi guru
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'guru') {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $tempat = $_POST['tempat_lahir'];
    $tgl = $_POST['tanggal_lahir'];
    $nuptk = $_POST['nuptk'];
    $nik = $_POST['nik'];
    $email = $_POST['email'];
    $nohp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // upload foto
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    move_uploaded_file($tmp, "upload/".$foto);

    mysqli_query($koneksi,
    "INSERT INTO guru 
    (username,foto,nama,jk,tempat_lahir,tanggal_lahir,nuptk,nik,email,no_hp,alamat)
    VALUES
    ('$username','$foto','$nama','$jk','$tempat','$tgl','$nuptk','$nik','$email','$nohp','$alamat')"
    );

    header("Location: dashboard_guru.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Guru</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

/* BACKGROUND FULL */
body{
    min-height:100vh;
    background:linear-gradient(135deg,#4facfe,#00f2fe);
    display:flex;
    flex-direction:column;
}

/* NAVBAR */
.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 40px;
    background:rgba(0,0,0,0.25);
    color:white;
}

.logout{
    background:#ff6b6b;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
    color:white;
    font-weight:bold;
}

/* MAIN */
.main{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

/* CARD MODERN */
.card{
    width:900px;
    background:white;
    border-radius:18px;
    box-shadow:0 15px 35px rgba(0,0,0,0.25);
    display:flex;
    overflow:hidden;
}

/* LEFT PROFILE */
.left{
    width:35%;
    background:linear-gradient(135deg,#667eea,#4facfe);
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:white;
    padding:20px;
}

.left img{
    width:160px;
    height:160px;
    border-radius:20px;
    object-fit:cover;
    border:4px solid white;
    box-shadow:0 10px 20px rgba(0,0,0,0.3);
}

/* RIGHT FORM */
.right{
    width:65%;
    padding:25px;
}

h2{
    text-align:center;
    margin-bottom:15px;
    color:#2c3e50;
    font-weight:900;
}

/* INPUT */
input, select{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border:1px solid #ddd;
    border-radius:8px;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#4facfe;
    color:white;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#1f8ef1;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div>👨‍🏫 Sistem Data Guru</div>
    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="main">

<div class="card">

    <!-- LEFT PROFILE -->
    <div class="left">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
        <h3>FORM GURU</h3>
        <p>Isi data guru sekolah</p>
    </div>

    <!-- RIGHT FORM -->
    <div class="right">

        <h2>📋 INPUT DATA GURU</h2>

        <form method="POST" enctype="multipart/form-data">

            <input type="file" name="foto" required>

            <input type="text" name="nama" placeholder="Nama Guru" required>

            <select name="jk" required>
                <option value="">Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" required>

            <input type="date" name="tanggal_lahir" required>

            <input type="text" name="nuptk" placeholder="NUPTK" required>

            <input type="text" name="nik" placeholder="NIK" required>

            <input type="email" name="email" placeholder="Email" required>

            <input type="text" name="no_hp" placeholder="No HP" required>

            <input type="text" name="alamat" placeholder="Alamat" required>

            <button type="submit" name="simpan">Simpan Data</button>

        </form>

    </div>

</div>

</div>

</body>
</html>