<?php
require 'functions.php';
// ambil id dari url
$id = $_GET["id"];
// query mahasiswa berdasarkan id
$mhs = query("SELECT * FROM datamhs WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
</head>

<body>
  <h3>Detail Mahasiswa</h3>
  <ul>
    <li><img src="img/20220811192813-62f53c2ddcb07.jpeg" height="75"></li>
    <li>Nama : <?= $mhs["nama"]; ?></li>
    <li>NPM : <?= $mhs["npm"]; ?></li>
    <li>Email : <?= $mhs["email"]; ?></li>
    <li>Jurusan : <?= $mhs["jurusan"]; ?></li>
    <li>
      <a href="">Update</a> | <a href="">Delete</a>
    </li>
    <li>
      <a href="latihan3.php">Kembali</a>
    </li>
  </ul>
</body>

</html>