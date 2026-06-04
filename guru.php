<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Ambil input pencarian
$cari = isset($_GET['cari']) ? $_GET['cari'] : "";

// Query aman
$query = "SELECT * FROM guru WHERE nama LIKE '%$cari%'";
$data = mysqli_query($koneksi, $query);

// Cek error query
if (!$data) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Guru</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
}

/* Navbar */
.navbar {
    background: rgba(0,0,0,0.3);
    padding: 15px 30px;
    color: white;
    display: flex;
    justify-content: space-between;
}

.navbar a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}

/* Container */
.container {
    padding: 30px;
}

/* Card */
.card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Input */
input, button {
    padding: 10px;
    margin: 5px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    background: #36d1dc;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background: #2bbac5;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
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

tr:nth-child(even) {
    background: #f2f2f2;
}

img {
    border-radius: 8px;
}
</style>
</head>

<body>

<div class="navbar">
    <div><strong>👩‍🏫 Data Guru</strong></div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="siswa.php">Data Siswa</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

    <!-- SEARCH -->
    <div class="card">
        <form method="GET">
            <input type="text" name="cari" placeholder="🔍 Cari nama guru..." value="<?= htmlspecialchars($cari); ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <!-- FORM TAMBAH -->
    <div class="card">
        <h3>➕ Tambah Guru</h3>
        <form method="POST" action="simpan_guru.php" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama" required><br>
            <input type="text" name="nip" placeholder="NIP" required><br>
            <input type="text" name="mapel" placeholder="Mata Pelajaran" required><br>
            <input type="text" name="alamat" placeholder="Alamat" required><br>
            <input type="file" name="foto" required><br>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <!-- TABEL -->
    <div class="card">
        <h3>📋 Daftar Guru</h3>

        <table>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Mapel</th>
            </tr>

            <?php if (mysqli_num_rows($data) > 0) { ?>
                <?php while($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td>
                        <img src="upload/<?= $row['foto']; ?>" width="60">
                    </td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= htmlspecialchars($row['nip']); ?></td>
                    <td><?= htmlspecialchars($row['mapel']); ?></td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4">Data tidak ditemukan</td>
                </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>