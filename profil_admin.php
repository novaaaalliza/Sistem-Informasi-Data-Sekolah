<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: dashboard.php");
    exit;
}

$username = $_SESSION['username'];

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$user = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Admin</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:#0f172a;
    color:white;
}

.box{
    width:400px;
    margin:80px auto;
    background:#1e293b;
    padding:20px;
    border-radius:12px;
    text-align:center;
}

h2{
    margin-bottom:20px;
}

/* FOTO */
.foto{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:15px;
    border:3px solid #334155;
}

.info{
    text-align:left;
    margin-top:10px;
    line-height:1.8;
}
</style>
</head>

<body>

<div class="box">

    <h2>👤 Profil Admin</h2>

    <!-- FOTO -->
    <?php if(!empty($user['foto'])) { ?>
        <img class="foto" src="upload/<?= $user['foto'] ?>">
    <?php } else { ?>
        <img class="foto" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
    <?php } ?>

    <div class="info">
        <p><b>Nama:</b> <?= $user['nama'] ?? '-' ?></p>
        <p><b>Username:</b> <?= $user['username'] ?></p>
        <p><b>Role:</b> <?= $user['role'] ?></p>
    </div>

</div>

</body>
</html>