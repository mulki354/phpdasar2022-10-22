<?php

function conn()
{
  return mysqli_connect("localhost", "root", "", "phpdasarlatihan");
}

function query($query)
{
  $conn = conn();
  $result = mysqli_query($conn, $query);

  //jika hasilnya hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function create($data)
{
  $conn = conn();
  $nama = htmlspecialchars($data["nama"]);
  $npm = htmlspecialchars($data["npm"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $email = htmlspecialchars($data["email"]);
  $gambar = htmlspecialchars($data["gambar"]);

  $query = "INSERT INTO datamhs
            VALUES
            (null, '$nama', '$npm', '$jurusan', '$email', '$gambar')
            ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function delete($id, $gambar)
{
  $conn = conn();
  mysqli_query($conn, "DELETE FROM datamhs WHERE id = $id") or die(mysqli_error($conn));
  unlink("img/" . $gambar);
  return mysqli_affected_rows($conn);
}

function update($data)
{
  $conn = conn();
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $npm = htmlspecialchars($data["npm"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $email = htmlspecialchars($data["email"]);
  $gambar = htmlspecialchars($data["gambar"]);

  $query = "UPDATE datamhs SET
            nama = '$nama',
            npm = '$npm',
            jurusan = '$jurusan',
            email = '$email',
            gambar = '$gambar'
            WHERE id = $id
            ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function search($keyword)
{
  $conn = conn();
  $query = "SELECT * FROM datamhs
            WHERE
            nama LIKE '%$keyword%' OR
            npm LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
            ";
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}
