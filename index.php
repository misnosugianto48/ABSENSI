<?php
session_start();
if (isset($_SESSION['status']) && $_SESSION['role'] == "admin") {
  return header("location: dashboard/index-admin.php");
};
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
  return header("location: dashboard/index.php");
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel=" icon" href="assets/img/calendar-favicon.png" type="image/x-icon">

  <link href="../assets/img/calendar-favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
</head>

<body>

  <div class="container">
    <section class="wrapper">
      <?php
      // notification
      if (isset($_GET['message'])) {
        $message = $_GET['message'];
        echo "<div class='notif-login'>$message</div>";
      }
      ?>


      <div class="card">
        <div class="card-header bg-primary text-white text-center">
          LOGIN PAGE
        </div>
        <form action="login.php" method="POST" class="form-login">
          <div class="card-body">
            <label for="username" class="form-label">Nomor Induk Pegawai</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                </svg></span>
              <input type="number" class="form-control" id="nip" name="nip" aria-describedby="basic-addon3" required placeholder="Masukan NIP Anda">
            </div>
            <label for="password" class="form-label">Password</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                </svg></span>
              <input type="password" class="form-control" id="password" required name="password" aria-describedby="basic-addon3" placeholder="Masukan Password Anda">
            </div>
            <div class="row mb-3">
              <button type="submit" name="login" class="btn btn-outline-info">Login</button>
            </div>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>