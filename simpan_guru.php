<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$nip = $_POST['nip'];
$mapel = $_POST['mapel'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

$foto_baru = time() . "_" . $foto;
move_uploaded_file($tmp, "upload/".$foto_baru);

mysqli_query($koneksi, "INSERT INTO guru VALUES('', '$nama','$nip','$mapel','$alamat','$foto_baru')");

echo "<script>
alert('Data guru berhasil ditambahkan!');
window.location='guru.php';
</script>";