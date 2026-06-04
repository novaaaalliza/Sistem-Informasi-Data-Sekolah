<?php
session_start();
require_once "koneksi.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    // cek user sesuai role
    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM user 
        WHERE username='$username'
        AND password='$password'
        AND role='$role'"
    );

    $cek = mysqli_num_rows($query);

    if($cek > 0){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['login']   = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = $data['role'];

        // pindah dashboard sesuai role

        if($role == "admin"){

            header("Location: dashboard.php");

        }elseif($role == "guru"){

            header("Location: dashboard_guru.php");

        }elseif($role == "siswa"){

            header("Location: dashboard_siswa.php");

        }

        exit;

    }else{

        $error = "Username, Password, atau Role Salah!";

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
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:sans-serif;
}

body{

    height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:linear-gradient(135deg,#667eea,#764ba2);
}

.login-box{

    width:380px;

    padding:40px;

    background:rgba(255,255,255,0.15);

    backdrop-filter:blur(10px);

    border-radius:20px;

    text-align:center;

    color:white;

    box-shadow:0 8px 25px rgba(0,0,0,0.3);
}

.logo{

    font-size:70px;

    margin-bottom:15px;
}

.login-box h2{

    margin-bottom:10px;
}

.login-box p{

    margin-bottom:25px;

    opacity:0.9;
}

input, select{

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

    font-size:16px;

    font-weight:bold;

    cursor:pointer;

    transition:0.3s;
}

button:hover{

    background:#ff4f91;
}

.error{

    background:rgba(255,0,0,0.2);

    padding:12px;

    border-radius:10px;

    margin-bottom:15px;
}

</style>

</head>

<body>

<form method="POST" class="login-box">

    <div class="logo">
        🎓
    </div>

    <h2>
        Login Sistem Sekolah
    </h2>

    <p>
        Silakan login sesuai role pengguna
    </p>

    <?php if(isset($error)){ ?>

        <div class="error">
            <?php echo $error; ?>
        </div>

    <?php } ?>

    <!-- username -->

    <input 
    type="text"
    name="username"
    placeholder="Masukkan Username"
    required>

    <!-- password -->

    <input 
    type="password"
    name="password"
    placeholder="Masukkan Password"
    required>

    <!-- pilih role -->

    <select name="role" required>

        <option value="">
            -- Pilih Role --
        </option>

        <option value="admin">
            Admin
        </option>

        <option value="guru">
            Guru
        </option>

        <option value="siswa">
            Siswa
        </option>

    </select>

    <!-- tombol login -->

    <button type="submit" name="login">
        Login
    </button>

</form>

</body>
</html>