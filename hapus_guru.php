<?php
session_start();
include 'koneksi.php';

/* CEK LOGIN */
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

/* CEK ID */
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id == '') {
    die("❌ ID tidak ditemukan. Akses dari tombol Hapus di Data Guru!");
}

/* CEK DATA GURU */
$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE id='$id' LIMIT 1");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("❌ Data guru tidak ditemukan!");
}

/* HAPUS FOTO (JIKA ADA) */
if (!empty($data['foto'])) {
    $path = "upload/" . $data['foto'];
    if (file_exists($path)) {
        unlink($path);
    }
}

/* HAPUS DATA DARI DATABASE */
$hapus = mysqli_query($koneksi, "DELETE FROM guru WHERE id='$id'");

if ($hapus) {
    echo "
    <script>
        alert('✅ Data guru berhasil dihapus!');
        window.location.href = 'data_guru.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('❌ Gagal menghapus data!');
        window.location.href = 'data_guru.php';
    </script>
    ";
}
?>