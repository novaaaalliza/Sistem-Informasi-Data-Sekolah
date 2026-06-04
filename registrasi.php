<?php
include 'koneksi.php';

if(isset($_POST['daftar'])){

    $username = mysqli_real_escape_string($koneksi,$_POST['username']);
    $password = mysqli_real_escape_string($koneksi,$_POST['password']);
    $role     = $_POST['role'];

    $cek = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");

    if(mysqli_num_rows($cek) > 0){
        echo "<script>
                alert('Username sudah digunakan!');
              </script>";
    }else{

        mysqli_query($koneksi,"INSERT INTO user(username,password,role)
                               VALUES('$username','$password','$role')");

        echo "<script>
                alert('Registrasi Berhasil!');
                window.location='index.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Akun</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#667eea,#764ba2);
}

.card{
    width:420px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    padding:40px;
    border-radius:25px;
    color:white;
    box-shadow:0 10px 30px rgba(0,0,0,.25);
}

h2{
    text-align:center;
    margin-bottom:25px;
}

input,select{
    width:100%;
    padding:13px;
    margin-bottom:15px;
    border:none;
    border-radius:10px;
    outline:none;
}

button{
    width:100%;
    padding:13px;
    border:none;
    border-radius:10px;
    background:#ff7eb3;
    color:white;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

button:hover{
    background:#ff4f91;
}

.login{
    text-align:center;
    margin-top:15px;
}

.login a{
    color:white;
    font-weight:bold;
    text-decoration:none;
}

</style>
</head>
<body>

<div class="card">

    <h2>Daftar Akun</h2>

    <form method="POST">

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <select name="role" required>
            <option value="">Pilih Role</option>
            <option value="siswa">Siswa</option>
            <option value="guru">Guru</option>
        </select>

        <button type="submit" name="daftar">
            Daftar
        </button>

    </form>

    <div class="login">
        Sudah punya akun?
        <a href="index.php">Masuk</a>
    </div>

</div>

</body>
</html>