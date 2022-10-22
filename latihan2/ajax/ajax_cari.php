<?php
require '../functions.php';
$mahasiswa = search($_GET["keyword"]);
?>

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