<?php
session_start();
require 'function.php';

if( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];
    //select username beradasarkan id
    $result = mysqli_query($conn ,"SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek useranme
    if( $key === hash('sha256', $row["username"]) ) {
        $_SESSION["login"] = true;
    }
}

if( isset($_SESSION["login"]) ) {
    header('location: index.php');
    exit;
}

if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    //cek username
    if( mysqli_num_rows($result) === 1 ) {
        $row = mysqli_fetch_assoc($result);
        //cek password
        if( password_verify($password, $row["password"]) ) {
            //set session
            $_SESSION["login"] = true;
            //cek remember
            if( isset($_POST["remember"]) ) {
                //set cookie
                setcookie('id', $row["id"], time()+120, "/", "localhost", 1);
                setcookie('key', hash('sha256', $row["username"]), time()+120, "/", "localhost", 1);
            }

            echo "
                <script>
                    alert('Selamat Datang!');
                    document.location.href = 'index.php';
                </script>
                ";
        }

        echo "
            <script>
                alert('Username / Password Anda Salah');
            </script>
            ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="remember">Remember Me?</label>
                <input type="checkbox" name="remember" id="remember">
            </li>
            <li>
                <button type="submit" name="login">Login !</button>
            </li>
        </ul>
    </form>
</body>
</html>