<?php
session_start();
include 'koneksi.php';

// proteksi guru
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'guru') {
    header("Location: index.php");
    exit;
}

// ambil data guru
$data = mysqli_query($koneksi, "SELECT * FROM guru");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Guru</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
}

.navbar {
    background: rgba(0,0,0,0.3);
    padding: 15px 30px;
    color: white;
    display: flex;
    justify-content: space-between;
}

.container {
    padding: 40px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* table */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

th {
    background: #36d1dc;
    color: white;
    padding: 10px;
}

td {
    padding: 10px;
    text-align: center;
}

img {
    border-radius: 8px;
}
</style>
</head>

<body>

<div class="navbar">
    <div><strong>👨‍🏫 Data Guru</strong></div>
    <div><a href="logout.php" style="color:white;">Logout</a></div>
</div>

<div class="container">

<div class="card">
    <h2>📋 Data Guru</h2>

    <table border="1">
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Mapel</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><img src="upload/<?= $row['foto']; ?>" width="60"></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nip']; ?></td>
            <td><?= $row['mapel']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</div>

</body>
</html>