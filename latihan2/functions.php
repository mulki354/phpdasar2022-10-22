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

function login($data)
{
  $conn = conn();
  $username = htmlspecialchars($data["username"]);
  $password = htmlspecialchars($data["password"]);

  // cek username
  if ($user = query("SELECT * FROM users WHERE username = '$username'")) {
    // cek password
    if (password_verify($password, $user["password"])) {
      // set session
      $_SESSION["login"] = true;
      header("location: index.php");
      exit;
    }
  }
  return [
    'error' => true,
    'message' => "Username / Password Salah!"
  ];
}

function regis($data)
{
  $conn = conn();
  $username = htmlspecialchars(strtolower($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  // jika username atau password kosong
  if (empty($username) || empty($password) || empty($password2)) {
    echo "
      <script>
        alert('Username / Password tidak boleh kosong!');
        document.location.href = 'registrasi.php';
      </script>
    ";
    return false;
  }

  // jika username sudah ada
  if (query("SELECT username FROM users WHERE username = '$username'")) {
    echo "
      <script>
        alert('Username sudah digunakan!');
        document.location.href = 'registrasi.php';
      </script>
    ";
    return false;
  }

  // jika konfirmasi password tidak sesuai
  if ($password !== $password2) {
    echo "
      <script>
        alert('Konfirmasi Password tidak sesuai!');
        document.location.href = 'registrasi.php';
      </script>
    ";
    return false;
  }

  // jika password < 5 digit
  if (strlen($password) < 5) {
    echo "
      <script>
        alert('Password terlalu pendek!');
        document.location.href = 'registrasi.php';
      </script>
    ";
    return false;
  }

  // jika username dan password sudah sesuai
  // ekripsi password
  $password_baru = password_hash($password, PASSWORD_DEFAULT);
  // insert ke tabel user
  $query = "INSERT INTO users
            VALUES
            (null, '$username', '$password_baru')
            ";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
