<?php
session_start();
require_once "koneksi.php";

if (isset($_POST['login'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    // mengambil data user
    $data = mysqli_query(
        $koneksi,
        "SELECT * FROM user 
        WHERE username='$user' 
        AND password='$pass'"
    );

    $cek = mysqli_num_rows($data);

    if ($cek > 0) {

        $row = mysqli_fetch_assoc($data);

        $_SESSION['login']    = true;
        $_SESSION['role']     = $row['role'];
        $_SESSION['username'] = $row['username'];

        // redirect sesuai role

        if ($row['role'] == 'admin') {

            header("Location: dashboard.php");

        } elseif ($row['role'] == 'guru') {

            header("Location: dashboard_guru.php");

        } elseif ($row['role'] == 'siswa') {

            header("Location: dashboard_siswa.php");

        }

        exit;

    } else {

        $error = "Username atau Password Salah!";

    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login Sistem Sekolah</title>

<style>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}

body{
    height: 100vh;
    background: linear-gradient(135deg,#6a11cb,#2575fc);
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box{

    width: 350px;
    padding: 40px;

    background: rgba(255,255,255,0.15);

    backdrop-filter: blur(10px);

    border-radius: 20px;

    box-shadow: 0 8px 25px rgba(0,0,0,0.3);

    text-align: center;

    color: white;
}

.logo{
    font-size: 60px;
    margin-bottom: 10px;
}

.login-box h2{
    margin-bottom: 10px;
}

.login-box p{
    margin-bottom: 25px;
    opacity: 0.8;
}

.login-box input{

    width: 100%;
    padding: 13px;

    margin-bottom: 15px;

    border: none;
    border-radius: 10px;

    outline: none;
}

.login-box button{

    width: 100%;
    padding: 13px;

    border: none;
    border-radius: 10px;

    background: #ff7eb3;

    color: white;

    font-size: 16px;
    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;
}

.login-box button:hover{
    background: #ff4f91;
}

.error{

    background: rgba(255,0,0,0.2);

    padding: 12px;

    border-radius: 10px;

    margin-bottom: 15px;
}

.info{

    margin-top: 20px;
    font-size: 13px;
    opacity: 0.8;
}

</style>

</head>

<body>

<form method="POST" class="login-box">

    <div class="logo">
        🎓
    </div>

    <h2>Login Sistem Sekolah</h2>

    <p>
        Admin • Guru • Siswa
    </p>

    <?php if(isset($error)){ ?>

        <div class="error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <input 
    type="text" 
    name="username" 
    placeholder="Masukkan Username"
    required>

    <input 
    type="password" 
    name="password" 
    placeholder="Masukkan Password"
    required>

    <button type="submit" name="login">
        Login
    </button>

    <div class="info">

        File yang terhubung dengan sistem ini:

        <br><br>

        📄 koneksi.php
        <br>

        📄 dashboard.php
        <br>

        📄 dashboard_guru.php
        <br>

        📄 dashboard_siswa.php
        <br>

        📄 data_siswa.php
        <br>

        📄 data_guru.php
        <br>

        📄 tambah_siswa.php
        <br>

        📄 tambah_guru.php
        <br>

        📄 simpan_siswa.php
        <br>

        📄 simpan_guru.php
        <br>

        📄 logout.php
        <br>

        📄 welcome.php

    </div>

</form>

</body>
</html>