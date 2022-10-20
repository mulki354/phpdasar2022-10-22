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
  mysqli_query($conn, $query);
  echo mysqli_error($conn);
  return mysqli_affected_rows($conn);
}
