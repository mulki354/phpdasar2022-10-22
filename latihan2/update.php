<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}
require 'functions.php';
// jika tidak ada id di url
if (!isset($_GET["id"])) {
  header('location: index.php');
  exit;
}
// ambil id dari url
$id = $_GET["id"];
// query mahasiswa berdasarkan id
$mhs = query("SELECT * FROM datamhs WHERE id = $id");
// apakah tombol ubah sudah ditekan
if (isset($_POST["submit"])) {
  if (update($_POST) > 0) {
    echo "
      <script>
        alert('Data Berhasil Diubah');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data Gagal Diubah');
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
  <title>Document</title>
</head>

<body>
  <h3>Form Ubah Data Mahasiswa</h3>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
    <ul>
      <li>
        <label>
          Nama :
          <input type="text" name="nama" autofocus required value="<?= $mhs["nama"]; ?>">
        </label>
      </li>
      <li>
        <label>
          NPM :
          <input type="text" name="npm" required value="<?= $mhs["npm"]; ?>">
        </label>
      </li>
      <li>
        <label>
          Jurusan :
          <input type="text" name="jurusan" required value="<?= $mhs["jurusan"]; ?>">
        </label>
      </li>
      <li>
        <label>
          Email :
          <input type="text" name="email" required value="<?= $mhs["email"]; ?>">
        </label>
      </li>
      <li>
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">
        <label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
        <img src="img/<?= $mhs["gambar"]; ?>" width="75" style="display: block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="submit">Ubah Data!</button>
      </li>
    </ul>
  </form>

  <script src="js/script.js"></script>
</body>

</html>