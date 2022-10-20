<?php
require '../function.php';
$key = $_GET["key"];
$query = "SELECT * FROM datamhs
            WHERE
            nama LIKE '%$key%' OR
            email LIKE '%$key%' OR
            jurusan LIKE '%$key%' OR
            npm LIKE '%$key%'
        ";
$mahasiswa = query($query);
?>

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
    <?php foreach ($mahasiswa as $mhs) : ?>
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