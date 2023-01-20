<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
  header("location:../index.php?message=silahkan login terlebih dahulu");
}

if (isset($_POST['logout'])) {
  session_destroy();
  header("location:../index.php?message=keluar dari sistem");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hi-Tend</title>
  <link rel=" icon" href="../assets/img/calendar-favicon.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Hi-Tendances</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end justify-content-around" id="navbarNavAltMarkup">
        <ul class="nav nav-pills ">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index-admin.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user-admin.php">User-profile</a>
          </li>
          <li class="nav-item mx-3">
            <button class="btn btn-outline-danger text-center" type="button" data-bs-toggle="modal" data-bs-target="#modalout">logout</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="modalout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="" method="POST">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Keluar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Yakin Logout?
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-outline-danger text-center" name="logout" type="submit">Yakin</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal -->
  <div class="container-sm mt-5">
    <div class="container-fluid">
      <section class="wrapper">
        <div class="card">
          <h3 class="card-header ">Selamat Datang <?php echo $_SESSION['fullname']; ?></h3>
          <div class="card-body">
            <h5 class="card-title">Absensi Seluruh Pegawai</h5>
            <table class="table table-sm table-responsive-sm">
              <thead class="table-primary">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">NIP</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Check-in</th>
                  <th scope="col">Check-out</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // menampilkan data
                include("../connection.php");
                $tgl = date('Y-m-d');
                $time = date('H:i:s');
                $employee_id = $_SESSION['employee_id'];

                $sql = "SELECT * FROM attendances ORDER BY id DESC";
                $result = $db->query($sql);
                $no = 1;
                while ($row = $result->fetch_assoc()) :
                  // $tampil = mysqli_query($db, "SELECT * FROM attendances ORDER BY id DESC");
                  // while ($data = mysqli_fetch_array($tampil)) :
                ?>
                  <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['employee_id'] ?></td>
                    <td><?= $row['tgl'] ?></td>
                    <td><?= $row['check_in'] ?></td>
                    <td><?= $row['check_out'] ?></td>

                  </tr>
              </tbody>

            <?php endwhile; ?>
            </table>
          </div>
        </div>
        <?php if (isset($_GET['message'])) {
          echo $_GET['message'];
        } ?>

        <!-- table absen -->
      </section>
    </div>
  </div>


  <!-- footer -->
  <footer class="navbar fixed-bottom bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Tend-Foot</a>
      <h6>Made By Misno. Build With Bootsrap dan <a href="https://www.youtube.com/@deaafrizal" class="alert-info" target="_blank">DeaCourse</a></h6>
    </div>
  </footer>
  <!-- footer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>