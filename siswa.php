<?php
session_start();
include 'koneksi.php';

$cari = "";
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}

$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nama LIKE '%$cari%'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Siswa</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
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

/* Form */
input, button {
    padding: 10px;
    margin: 5px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button {
    background: #667eea;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background: #5a67d8;
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
    background: #667eea;
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
    <div><strong>📚 Data Siswa</strong></div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">

    <!-- SEARCH -->
    <div class="card">
        <form method="GET">
            <input type="text" name="cari" placeholder="🔍 Cari nama..." value="<?php echo $cari; ?>">
            <button>Cari</button>
        </form>
    </div>

    <!-- FORM TAMBAH -->
    <div class="card">
        <h3>➕ Tambah Siswa</h3>
        <form method="POST" action="simpan_siswa.php" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama" required><br>
            <input type="text" name="nisn" placeholder="NISN" required><br>
            <input type="text" name="kelas" placeholder="Kelas" required><br>
            <input type="text" name="alamat" placeholder="Alamat" required><br>
            <input type="file" name="foto" required><br>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <!-- TABEL -->
    <div class="card">
        <h3>📋 Daftar Siswa</h3>
        <table>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Kelas</th>
            </tr>

            <?php while($row = mysqli_fetch_array($data)) { ?>
            <tr>
                <td>
                    <img src="upload/<?php echo $row['foto']; ?>" width="60">
                </td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['nisn']; ?></td>
                <td><?php echo $row['kelas']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>