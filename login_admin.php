<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$user' AND password='$pass' AND role='admin'");
    $cek = mysqli_num_rows($data);

    if ($cek > 0) {
        $_SESSION['login'] = true;
        $_SESSION['role']  = 'admin';

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login admin gagal!";
    }
}
?>

<form method="POST">
    <h2>Login Admin</h2>
    <?php if (isset($error)) echo $error; ?>
    <input type="text" name="username" placeholder="Username"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button name="login">Login</button>
</form>