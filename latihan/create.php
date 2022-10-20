<?php
session_start();
require 'function.php';

if( !isset($_SESSION["login"]) ) {
    header('location: login.php');
    exit;
}

if( isset($_POST["submit"]) ) {
    if( create($_POST) > 0 ) {
        echo "
            <script>
                alert('Data Berhasil Ditambah');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Ditambah');
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
    <title>Tambah Data</title>
    <style>
        label{
            display: block;
        }
    </style>
</head>
<body>
    <h1>Tambah Data</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" required>
            </li>
            <li>
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="gambar">Gambar</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Buat Data!</button>
            </li>
        </ul>
    </form>
</body>
</html>