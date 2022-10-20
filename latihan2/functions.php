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
