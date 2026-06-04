<?php
session_start();
include "koneksi.php";

/* =========================
   CEK LOGIN
========================= */
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

/* =========================
   AMBIL DATA USER
========================= */
$search = isset($_GET['search']) ? $_GET['search'] : '';

if ($search != '') {
    $data = mysqli_query($koneksi,
        "SELECT * FROM user 
         WHERE username LIKE '%$search%' 
         OR role LIKE '%$search%' 
         ORDER BY id DESC"
    );
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data User</title>

<style>
body{
    margin:0;
    font-family:Segoe UI, sans-serif;
    background:#0f172a;
    color:white;
}

/* HEADER */
.header{
    text-align:center;
    padding:25px;
    font-size:24px;
    font-weight:bold;
}

/* CONTAINER */
.container{
    width:95%;
    margin:auto;
}

/* BACK BUTTON */
.back{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 15px;
    background:#facc15;
    color:black;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

/* SEARCH */
.search-box{
    text-align:center;
    margin-bottom:15px;
}

.search-box input{
    padding:10px;
    width:250px;
    border-radius:8px;
    border:none;
}

.search-box button{
    padding:10px 15px;
    border:none;
    border-radius:8px;
    background:#facc15;
    font-weight:bold;
    cursor:pointer;
}

/* TABLE */
.table-box{
    background:#1e293b;
    padding:15px;
    border-radius:12px;
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#334155;
    padding:12px;
    font-size:13px;
    text-align:center;
}

td{
    padding:10px;
    text-align:center;
    font-size:13px;
    border-bottom:1px solid #334155;
}

tr:hover{
    background:#1f2937;
}

/* BADGE ROLE */
.badge{
    padding:5px 10px;
    border-radius:8px;
    font-size:12px;
}

.admin{background:#ef4444;}
.guru{background:#3b82f6;}
.siswa{background:#22c55e;}

/* BUTTON */
.btn{
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
    color:white;
}

.hapus{
    background:#ef4444;
}
.hapus:hover{
    background:#dc2626;
}
</style>

</head>

<body>

<div class="header">👤 DATA USER</div>

<div class="container">

<!-- BACK -->
<a class="back" href="dashboard.php">⬅ Kembali</a>

<!-- SEARCH -->
<form method="GET" class="search-box">
    <input type="text" name="search" placeholder="Cari username / role..." value="<?= $search ?>">
    <button type="submit">🔍 Cari</button>
</form>

<div class="table-box">

<table>
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Password</th>
    <th>Role</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
while ($row = mysqli_fetch_assoc($data)) {
?>

<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['password'] ?></td>

    <td>
        <span class="badge <?= $row['role'] ?>">
            <?= $row['role'] ?>
        </span>
    </td>

    <td>
        <a class="btn hapus"
           href="hapus_user.php?id=<?= $row['id'] ?>"
           onclick="return confirm('Yakin hapus user ini?')">
           Hapus
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>