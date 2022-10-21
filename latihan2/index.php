<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}
require 'functions.php';
$mahasiswa = query("SELECT * FROM datamhs");

//ketika tombol cari ditekan
if (isset($_POST["search"])) {
  $mahasiswa = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>
</head>

<body>
  <a href="logout.php">logout</a>
  <h3>Daftar Mahasiswa</h3>

  <a href="create.php">Tambah Mahasiswa</a>
  <br><br>

  <form action="" method="post">
    <input type="text" name="keyword" size="40" autofocus autocomplete="off" placeholder="Cari disini...">
    <button type="submit" name="search">Cari!</button>
  </form>
  <br>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>NPM</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>

    <?php if (empty($mahasiswa)) : ?>
      <tr>
        <td colspan="5">
          <p style="color: red; font-style: italic;">Data Mahasiswa Tidak Ditemukan</p>
        </td>
      </tr>
    <?php endif; ?>

    <?php $i = 1; ?>
    <?php foreach ($mahasiswa as $mhs) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><?= $mhs["nama"]; ?></td>
        <td><?= $mhs["npm"]; ?></td>
        <td><img src="img/<?= $mhs["gambar"]; ?>" height="75"></td>
        <td><a href="detail.php?id=<?= $mhs["id"]; ?>">Detail</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>