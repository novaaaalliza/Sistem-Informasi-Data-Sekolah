<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// search
$searchSiswa = isset($_GET['search_siswa']) ? $_GET['search_siswa'] : '';
$searchGuru  = isset($_GET['search_guru']) ? $_GET['search_guru'] : '';

// count
$siswa = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM siswa"));
$guru  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM guru"));

// data siswa
$dataSiswa = mysqli_query($koneksi,
    "SELECT * FROM siswa WHERE nama LIKE '%$searchSiswa%'"
);

// data guru
$dataGuru = mysqli_query($koneksi,
    "SELECT * FROM guru WHERE nama LIKE '%$searchGuru%'"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

<style>
body{
    margin:0;
    font-family:sans-serif;
    background:linear-gradient(135deg,#667eea,#764ba2);
    padding-bottom:50px;
}

/* navbar */
.navbar{
    background:rgba(0,0,0,0.3);
    padding:15px 30px;
    color:white;
    display:flex;
    justify-content:space-between;
}

/* container */
.container{
    padding:30px;
}

/* card */
.grid{
    display:flex;
    gap:20px;
}

.card{
    flex:1;
    padding:25px;
    border-radius:15px;
    color:white;
    cursor:pointer;
}

.siswa{background:linear-gradient(135deg,#ff9a9e,#fad0c4);}
.guru{background:linear-gradient(135deg,#36d1dc,#5b86e5);}

.card p{
    font-size:35px;
    font-weight:bold;
}

/* search */
input{
    padding:10px;
    border:none;
    border-radius:8px;
    margin-top:10px;
}

/* table */
table{
    width:100%;
    background:white;
    border-collapse:collapse;
    margin-top:15px;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:#667eea;
    color:white;
    padding:10px;
    font-size:13px;
}

td{
    padding:8px;
    text-align:center;
    font-size:13px;
}

img{
    width:50px;
    height:50px;
    object-fit:cover;
    border-radius:8px;
}

.section{
    margin-top:40px;
}

h2{
    color:white;
}
</style>
</head>

<body>

<div class="navbar">
    <div><b>✨ Dashboard Admin</b></div>
    <a href="logout.php" style="color:white;">Logout</a>
</div>

<div class="container">

<!-- STAT -->
<div class="grid">

<div class="card siswa">
    <h3>Total Siswa</h3>
    <p><?= $siswa ?></p>
</div>

<div class="card guru">
    <h3>Total Guru</h3>
    <p><?= $guru ?></p>
</div>

</div>

<!-- SISWA -->
<div class="section">
<h2>📚 Data Siswa</h2>

<form method="GET">
    <input type="text" name="search_siswa" placeholder="Cari siswa..." value="<?= $searchSiswa ?>">
    <button>Search</button>
</form>

<table>
<tr>
    <th>No</th>
    <th>Foto</th>
    <th>Nama</th>
    <th>JK</th>
    <th>NISN</th>
    <th>NIK</th>
    <th>TTL</th>
    <th>Alamat</th>
    <th>No HP</th>
    <th>Ayah</th>
    <th>Ibu</th>
    <th>No HP Ortu</th>
</tr>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($dataSiswa)) {
?>

<tr>
    <td><?= $no++ ?></td>
    <td><img src="foto/<?= $row['foto'] ?>"></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['jk'] ?></td>
    <td><?= $row['nisn'] ?></td>
    <td><?= $row['nik'] ?></td>
    <td><?= $row['tempat_lahir'] ?>, <?= $row['tanggal_lahir'] ?></td>
    <td><?= $row['alamat'] ?></td>
    <td><?= $row['no_hp'] ?></td>
    <td><?= $row['nama_ayah'] ?></td>
    <td><?= $row['nama_ibu'] ?></td>
    <td><?= $row['hp_ortu'] ?></td>
</tr>

<?php } ?>

</table>
</div>

<!-- GURU -->
<div class="section">
<h2>👨‍🏫 Data Guru</h2>

<form method="GET">
    <input type="text" name="search_guru" placeholder="Cari guru..." value="<?= $searchGuru ?>">
    <button>Search</button>
</form>

<table>
<tr>
    <th>No</th>
    <th>Foto</th>
    <th>Nama</th>
    <th>JK</th>
    <th>Tempat, Tgl Lahir</th>
    <th>NUPTK</th>
    <th>NIK</th>
    <th>Email</th>
    <th>No HP</th>
    <th>Alamat</th>
</tr>

<?php
$no = 1;
while($row = mysqli_fetch_assoc($dataGuru)) {
?>

<tr>
    <td><?= $no++ ?></td>
    <td><img src="upload/<?= $row['foto'] ?>"></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['jk'] ?></td>
    <td><?= $row['tempat_lahir'] ?>, <?= $row['tanggal_lahir'] ?></td>
    <td><?= $row['nuptk'] ?></td>
    <td><?= $row['nik'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['no_hp'] ?></td>
    <td><?= $row['alamat'] ?></td>
</tr>

<?php } ?>

</table>
</div>

</div>

</body>
</html>