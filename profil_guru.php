<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'guru') {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];

$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM guru WHERE username='$username'")
);

if (!$data) {
    header("Location: data_guru.php");
    exit;
}

$foto = !empty($data['foto']) ? "upload/".$data['foto'] : "upload/default.png";
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Guru</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f0ff;
}

/* WRAPPER */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:260px;
    background:linear-gradient(180deg,#4f46e5,#7c3aed);
    color:white;
    padding:25px 20px;
}

.profile-side{
    text-align:center;
    margin-bottom:30px;
}

.profile-side img{
    width:90px;
    height:90px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid white;
}

.profile-side h3{
    margin-top:10px;
    font-size:16px;
}

.profile-side small{
    opacity:0.8;
}

.menu{
    margin-top:20px;
}

.menu a{
    display:block;
    padding:12px;
    margin-bottom:8px;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
    font-size:14px;
}

.menu a:hover{
    background:rgba(255,255,255,0.15);
}

/* CONTENT */
.content{
    flex:1;
    padding:30px;
}

/* HEADER */
.header{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
}

.header h2{
    color:#6d28d9;
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
}

/* CARD */
.card{
    background:white;
    padding:15px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
}

.card b{
    display:block;
    font-size:12px;
    color:#7c3aed;
    margin-bottom:5px;
}

/* BUTTON */
.btns{
    margin-top:20px;
    display:flex;
    gap:10px;
}

.btn{
    padding:12px;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
    text-align:center;
    flex:1;
}

.edit{
    background:#7c3aed;
    color:white;
}

.back{
    background:#e9d5ff;
    color:#5b21b6;
}

/* RESPONSIVE */
@media(max-width:900px){
    .wrapper{
        flex-direction:column;
    }

    .sidebar{
        width:100%;
        text-align:center;
    }

    .grid{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="profile-side">
            <img src="<?= $foto ?>">
            <h3><?= $data['nama'] ?></h3>
            <small><?= $data['nuptk'] ?></small>
        </div>

        <div class="menu">
            <a href="dashboard_guru.php">🏠 Dashboard</a>
            <a href="profil_guru.php">👤 Profil</a>
            <a href="data_guru.php">✏ Edit Data</a>
            <a href="logout.php">🚪 Logout</a>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="header">
            <h2>📄 Profil Guru</h2>
        </div>

        <div class="grid">

            <div class="card"><b>Nama</b><?= $data['nama'] ?></div>
            <div class="card"><b>NUPTK</b><?= $data['nuptk'] ?></div>

            <div class="card"><b>NIK</b><?= $data['nik'] ?></div>
            <div class="card"><b>Jenis Kelamin</b><?= $data['jk'] ?></div>

            <div class="card"><b>Email</b><?= $data['email'] ?></div>
            <div class="card"><b>No HP</b><?= $data['no_hp'] ?></div>

            <div class="card"><b>Alamat</b><?= $data['alamat'] ?></div>

        </div>

        <div class="btns">
            <a href="data_guru.php" class="btn edit">✏ Edit Data</a>
            <a href="dashboard_guru.php" class="btn back">⬅ Kembali</a>
        </div>

    </div>

</div>

</body>
</html>