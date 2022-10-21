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
    <li><img src="img/<?= $mhs["gambar"]; ?>" height="75"></li>
    <li>Nama : <?= $mhs["nama"]; ?></li>
    <li>NPM : <?= $mhs["npm"]; ?></li>
    <li>Email : <?= $mhs["email"]; ?></li>
    <li>Jurusan : <?= $mhs["jurusan"]; ?></li>
    <li>
      <a href="update.php?id=<?= $mhs["id"]; ?>">Update</a> | <a href="delete.php?id=<?= $mhs["id"]; ?>&gambar=<?= $mhs["gambar"]; ?>" onclick="return alert('Yakin Dihapus?')">Delete</a>
    </li>
    <li>
      <a href="index.php">Kembali</a>
    </li>
  </ul>
</body>

</html>