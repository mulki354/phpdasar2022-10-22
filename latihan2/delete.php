<?php
require 'functions.php';
// jika tidak ada id di url
if (!isset($_GET["id"])) {
  header('location: index.php');
  exit;
}
//mengambil id dari url
$id = $_GET["id"];
$gambar = $_GET["gambar"];

if (delete($id, $gambar) > 0) {
  echo "
    <script>
      alert('Data Berhasil Dihapus');
      document.location.href = 'index.php';
    </script>
  ";
} else {
  echo "
    <script>
      alert('Data Gagal Dihapus');
    </script>
  ";
}
