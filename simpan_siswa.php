<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama   = htmlspecialchars($_POST['nama']);
    $nisn   = htmlspecialchars($_POST['nisn']);
    $kelas  = htmlspecialchars($_POST['kelas']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    $folder = "upload/";
    
    // Rename foto biar unik
    $foto_baru = time() . "_" . $foto;
    $path = $folder . $foto_baru;

    if ($nama == "" || $nisn == "" || $kelas == "" || $alamat == "") {
        $status = "error";
        $pesan = "Data tidak boleh kosong!";
    } else {

        if (move_uploaded_file($tmp, $path)) {

            $query = "INSERT INTO siswa VALUES('', '$nama','$nisn','$kelas','$alamat','$username','$password','$foto_baru')";
            $simpan = mysqli_query($koneksi, $query);

            if ($simpan) {
                $status = "success";
                $pesan = "Data siswa berhasil disimpan!";
            } else {
                $status = "error";
                $pesan = "Gagal menyimpan ke database!";
            }

        } else {
            $status = "error";
            $pesan = "Upload foto gagal!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Proses Data</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

/* Card */
.box {
    background: white;
    padding: 40px;
    border-radius: 15px;
    text-align: center;
    width: 350px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    animation: fadeIn 0.6s ease;
}

h2 {
    margin-bottom: 10px;
}

/* Icon */
.icon {
    font-size: 60px;
    margin-bottom: 15px;
}

.success {
    color: #2ecc71;
}

.error {
    color: #e74c3c;
}

/* Button */
.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
}

.btn:hover {
    background: #5a67d8;
}

/* Animasi */
@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>
</head>

<body>

<div class="box">

    <?php if ($status == "success") { ?>
        <div class="icon success">✔</div>
        <h2>Berhasil!</h2>
        <p><?php echo $pesan; ?></p>
    <?php } else { ?>
        <div class="icon error">✖</div>
        <h2>Gagal!</h2>
        <p><?php echo $pesan; ?></p>
    <?php } ?>

    <a href="siswa.php" class="btn">Kembali ke Data Siswa</a>

</div>

</body>
</html>