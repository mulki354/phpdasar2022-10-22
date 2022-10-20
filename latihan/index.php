<?php
session_start();
require 'function.php';

if( !isset($_SESSION["login"]) ) {
    header('location: login.php');
    exit;
}

//pagination - konfigurasi
// $dataPerHal = 2;
// $data = count(query("SELECT * FROM datamhs"));
// $halaman = ($data / $dataPerHal);
// $halAktif = isset($_GET["page"]) ? $halAktif = $_GET["page"] : 1;
// $dataAwal = ( $dataPerHal * $halAktif ) - $dataPerHal;

$mahasiswa = query("SELECT * FROM datamhs");

if( isset($_POST["search"]) ) {
    $mahasiswa = search($_POST["key"]);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Mahasiswa</title>
        <style>
            .loader{
                width: 100px;
                position: absolute;
                top: 84px;
                left: 350px;
                z-index: -1;
                display: none;
            }

            @media print{
                .logout, .print, .create, .search {
                    display: none;
                }
            }
            </style>
        <script src="js/jquery-3.6.1.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <a href="logout.php" class="logout">Logout</a> | <a href="print.php" class="print">Cetak</a>
        <h1>Data Mahasiswa</h1>
        
        <form action="" method="post" class="search">
            <input type="text" name="key" size="50" placeholder="cari disini" autofocus autocomplete="off" id="key">
            <button type="submit" name="search" id="search">Cari !</button>
            <img src="img/loader.gif" class="loader">
        </form>
        <br>
        
        <a href="create.php" class="create">Tambah Data</a>
        <br><br>
        
        <div id="container">
            <table border="1" cellspacing="0" cellpadding="15">
                <tr>
                    <th>NO.</th>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                
                <?php $i = 1; ?>
                <?php foreach( $mahasiswa as $mhs ) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["npm"]; ?></td>
                        <td><?= $mhs["jurusan"]; ?></td>
                        <td><?= $mhs["email"]; ?></td>
                        <td>
                            <img src="img/<?= $mhs["gambar"]; ?>" width="75">
                        </td>
                        <td>
                            <a href="update.php?id=<?= $mhs["id"] ?>">Update</a> |
                            <a href="delete.php?id=<?= $mhs["id"] ?>&gambar=<?= $mhs["gambar"] ?>" onclick="return confirm('Yakin?');">Delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
            </table>
        </div>
        
        <!-- naviasi -->
        <?php if( $halAktif > 1 ) : ?>
            <a href="?page=<?= $halAktif - 1 ?>">&laquo;</a>
            <?php endif; ?>
            
            <?php for( $i = 1; $i <= $halaman; $i++ ) : ?>
                <?php if( $i == $halAktif ) : ?>
                    <a href="?page=<?= $i; ?>" style="color:red; font-weight:bold;"> <?= $i; ?> </a>
                <?php else : ?>
                    <a href="?page=<?= $i; ?>"> <?= $i; ?> </a>
                <?php endif; ?>
            <?php endfor; ?>
                        
            <?php if( $halAktif < $halaman ) : ?>
                <a href="?page=<?= $halAktif + 1 ?>">&raquo;</a>
            <?php endif; ?>


    </body>
</html>