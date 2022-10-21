<?php
require 'functions.php';

if (isset($_POST["regis"])) {
  if (regis($_POST) > 0) {
    echo "
      <script>
        alert('User Baru Berhasil Ditambahkan');
        document.location.href = 'login.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('User Gagal Ditambahkan');
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
  <title>Registrasi</title>
</head>

<body>
  <h3>Form Registrasi</h3>
  <form action="" method="post">
    <ul>
      <li>
        <label>
          Username :
          <input type="text" name="username" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <label>
          Password :
          <input type="password" name="password" required>
        </label>
      </li>
      <li>
        <label>
          Konfirmasi Password :
          <input type="password" name="password2" required>
        </label>
      </li>
      <li>
        <button name="regis" type="submit">Daftar!</button>
      </li>
    </ul>
  </form>
</body>

</html>