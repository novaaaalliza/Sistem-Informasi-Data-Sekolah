<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistem Informasi Sekolah</title>

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
    width:500px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:50px;
    text-align:center;
    color:white;
    box-shadow:0 10px 30px rgba(0,0,0,0.25);
}

.logo{
    font-size:85px;
    margin-bottom:15px;
}

h1{
    font-size:38px;
    margin-bottom:15px;
}

p{
    line-height:1.8;
    font-size:16px;
    margin-bottom:35px;
    opacity:0.95;
}

.btn-group{
    display:flex;
    justify-content:center;
    gap:15px;
    margin-bottom:20px;
}

.btn{
    padding:14px 35px;
    border-radius:14px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.btn-login{
    background:#ff7eb3;
    color:white;
}

.btn-login:hover{
    background:#ff4f91;
    transform:translateY(-3px);
}

.btn-register{
    background:white;
    color:#764ba2;
}

.btn-register:hover{
    transform:translateY(-3px);
    background:#f3f3f3;
}

.info{
    margin-top:15px;
    font-size:14px;
    opacity:0.9;
}

.footer{
    margin-top:25px;
    font-size:13px;
    opacity:0.8;
}

</style>
</head>

<body>

<div class="card">

    <div class="logo">🎓</div>

    <h1>Selamat Datang</h1>

    <p>
        Selamat datang di Sistem Informasi Sekolah.<br>
        Kelola data siswa, data guru, dan informasi sekolah
        secara mudah, cepat, dan terintegrasi.
    </p>

    <div class="btn-group">

        <!-- ke halaman login -->
        <a href="index.php" class="btn btn-login">
            Masuk
        </a>

        <!-- ke halaman register -->
        <a href="register.php" class="btn btn-register">
            Daftar
        </a>

    </div>

    <div class="info">
        Sudah memiliki akun? Klik <b>Masuk</b><br>
        Belum memiliki akun? Klik <b>Daftar</b>
    </div>

    <div class="footer">
        © 2026 Sistem Informasi Sekolah
    </div>

</div>

</body>
</html>