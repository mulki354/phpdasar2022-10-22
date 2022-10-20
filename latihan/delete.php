<?php
session_start();
require 'function.php';

if (!isset($_SESSION["login"])) {
    header('location: login.php');
    exit;
}

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
            document.location.href = 'index.php';
        </script>
        ";
}
