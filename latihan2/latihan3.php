<?php
require 'functions.php';
$mahasiswa = query("SELECT * FROM datamhs");

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
  <h3>Daftar Mahasiswa</h3>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Nama</th>
      <th>NPM</th>
      <th>Gambar</th>
      <th>Aksi</th>
    </tr>

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