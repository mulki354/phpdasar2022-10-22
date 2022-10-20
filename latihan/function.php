<?php

$conn = mysqli_connect("localhost", "root", "", "phpdasarlatihan");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function create($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambar = upload();
    //cek upload gambar
    if (!$gambar) {
        return false;
    }
    $query = "INSERT INTO datamhs
                VALUES
                ('', '$nama', '$npm', '$jurusan', '$email', '$gambar')
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload()
{
    global $conn;
    $namaFile = $_FILES["gambar"]["name"];
    $sizeFile = $_FILES["gambar"]["size"];
    $errorFile = $_FILES["gambar"]["error"];
    $tmpFile = $_FILES["gambar"]["tmp_name"];

    //cek upload data
    if ($errorFile === 4) {
        echo "
            <script>
                alert('Silahkan Upload File');
            </script>
        ";
        return false;
    }

    //cek ekstensi file
    $ekstensiValid = ["jpg", "jpeg", "png"];
    $ekstensi = explode(".", $namaFile);
    $ekstensi = strtolower(end($ekstensi));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "
            <script>
                alert('Hanya Bisa JPG, PNG, JPEG');
            </script>
        ";
        return false;
    }

    //cek ukuran file
    if ($sizeFile > 1000000) {
        echo "
            <script>
                alert('Maksimal Upload 1mb');
            </script>
        ";
        return false;
    }

    //nama baru
    $namaBaru = date("YmdHis") . "-" . uniqid() . "." . $ekstensi;
    move_uploaded_file($tmpFile, "img/" . $namaBaru);
    return $namaBaru;
}

function delete($id, $gambar)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM datamhs WHERE id = $id");
    unlink("img/" . $gambar);
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $npm = htmlspecialchars($data["npm"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $error = $_FILES["gambar"]["error"];
    //cek upload gambar
    if ($error === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
        if (!$gambar) {
            return false;
        }
        unlink("img/" . $gambarLama);
    }

    $query = "UPDATE datamhs SET
                nama = '$nama',
                npm = '$npm',
                jurusan = '$jurusan',
                email = '$email',
                gambar = '$gambar'
                WHERE id = $id
                ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function search($key)
{
    $query = "SELECT * FROM datamhs
                WHERE
                nama LIKE '%$key%' OR
                npm LIKE '%$key%' OR
                jurusan LIKE '%$key%' OR
                email LIKE '%$key%'
                ";
    return query($query);
}

function regis($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    //cek username sudah ada yang pakai atau belum
    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Username Sudah Digunakan');
            </script>
        ";
        return false;
    }

    //cek password 1 dan 2 verifikasi
    if ($password !== $password2) {
        echo "
            <script>
                alert('Password Anda Tidak Sesuai');
            </script>
        ";
        return false;
    }

    //masukan password dalam hash
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO users VALUES ('','$username', '$password')") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
