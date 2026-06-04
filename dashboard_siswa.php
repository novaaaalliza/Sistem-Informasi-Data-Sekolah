<?php
session_start();
include 'koneksi.php';

// proteksi siswa
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'siswa') {
    header("Location: index.php");
    exit;
}

// ambil data siswa
$data = mysqli_query($koneksi, "SELECT * FROM siswa");
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Siswa</title>

<link rel="stylesheet" href="style.css">

<style>

/* navbar */

.navbar {

    background: rgba(0,0,0,0.3);

    padding: 15px 30px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    color: white;
}

.navbar a {

    color: white;

    text-decoration: none;
}

/* container */

.container {

    width: 95%;

    margin: 30px auto;
}

/* card */

.card {

    background: white;

    border-radius: 20px;

    padding: 30px;

    box-shadow: 0 8px 20px rgba(0,0,0,0.2);

    margin-bottom: 30px;
}

/* foto */

.foto {

    width: 80px;

    height: 80px;

    object-fit: cover;

    border-radius: 10px;
}

</style>

</head>

<body>

<!-- navbar -->

<div class="navbar">

    <div>
        <strong>🎓 Dashboard Siswa</strong>
    </div>

    <div>
        <a href="logout.php">Logout</a>
    </div>

</div>

<!-- container -->

<div class="container">

    <!-- menu dashboard -->

    <div class="card">

        <h2 style="color:#333;">
            Selamat Datang 👋
        </h2>

        <p>
            Silakan pilih menu di bawah ini.
        </p>

        <div class="menu">

            <!-- menu data siswa -->

            <a href="data_siswa.php" class="menu-card">

                <h3>
                    📋 Data Siswa
                </h3>

                <p>
                    Lihat data siswa lengkap
                </p>

            </a>

        </div>

    </div>

    <!-- tabel siswa -->

    <div class="card">

        <h2 style="color:#333;">
            📚 Data Siswa
        </h2>

        <table>

            <tr>

                <th>Foto</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>NISN</th>
                <th>NIK</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No HP Siswa</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>No HP Orang Tua</th>

            </tr>

            <?php while($row = mysqli_fetch_assoc($data)) { ?>

            <tr>

                <td>

                    <img 
                    src="foto/<?= $row['foto']; ?>" 
                    class="foto">

                </td>

                <td>
                    <?= $row['nama']; ?>
                </td>

                <td>
                    <?= $row['jk']; ?>
                </td>

                <td>
                    <?= $row['nisn']; ?>
                </td>

                <td>
                    <?= $row['nik']; ?>
                </td>

                <td>
                    <?= $row['tempat_lahir']; ?>,
                    <?= $row['tanggal_lahir']; ?>
                </td>

                <td>
                    <?= $row['alamat']; ?>
                </td>

                <td>
                    <?= $row['no_hp']; ?>
                </td>

                <td>
                    <?= $row['nama_ayah']; ?>
                </td>

                <td>
                    <?= $row['nama_ibu']; ?>
                </td>

                <td>
                    <?= $row['hp_ortu']; ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>