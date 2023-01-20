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
            <a class="nav-link " aria-current="page" href="index-admin.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="user-admin.php">User-Profile</a>
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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-success mb-3" data-bs-toggle="modal" data-bs-target="#newModal">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
              </svg>
            </button>
            <h5 class="card-title">User Login</h5>
            <table class="table table-sm table-responsive-sm">
              <thead class="table-primary">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">NIP</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Role</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // menampilkan data
                include("../connection.php");
                $tgl = date('Y-m-d');
                $time = date('H:i:s');
                $employee_id = $_SESSION['employee_id'];

                $sql = "SELECT * FROM users ORDER BY id DESC";
                $result = $db->query($sql);
                $no = 1;
                while ($row = $result->fetch_assoc()) :
                  // $tampil = mysqli_query($db, "SELECT * FROM attendances ORDER BY id DESC");
                  // while ($data = mysqli_fetch_array($tampil)) :
                ?>
                  <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['employee_id'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><a href="#" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $no ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg></a>
                      <a href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $no ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                          <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg></a>
                    </td>
                  </tr>
                  <!-- modal edit -->
                  <div class="modal fade" id="editModal<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data User</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="action.php">
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">NIP</label>
                              <input type="number" name="employee_id" class="form-control" value="<?= $row['employee_id'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Nama</label>
                              <input type="text" name="fullname" class="form-control" value="<?= $row['fullname'] ?>">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Role</label>
                              <input type="text" name="role" class="form-control" value="<?= $row['role'] ?>">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Password</label>
                              <input type="password" name="password" class="form-control" value="<?= $row['password'] ?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-warning" name="bedit">Edit</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Keluar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- AKhir Edit Modal -->

                  <!-- modal Hapus -->
                  <div class="modal fade" id="hapusModal<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="action.php">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                          <div class="modal-body">
                            <h5 class="text-center">Yakin Menghapus Data?</h5> <br>
                            <span class="text-danger">User <?= $row['fullname'] ?> - NIP <?= $row['employee_id'] ?></span>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-danger" name="bhapus">Yakin</button>
                            <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Tidak Yakin</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- AKhir Hapus Modal -->
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

  <!--Awal Modal -->
  <div class="modal fade" id="newModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User Baru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="action.php">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">NIP</label>
              <input type="number" name="employee_id" class="form-control" placeholder="Input NIP">
            </div>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="fullname" class="form-control" placeholder="Input Nama">
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <input type="text" name="role" class="form-control" placeholder="Input Role">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Input Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-success" name="btambah">Tambah</button>
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Keluar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- AKhir Modal -->

  <!-- footer -->
  <footer class="navbar fixed-bottom bg-body-tertiary">
    <div class="container-fluid">
      <h6>Made By Misno. Build With Bootsrap dan <a href="https://www.youtube.com/@deaafrizal" class="alert-info" target="_blank">DeaCourse</a></h6>
    </div>
  </footer>
  <!-- footer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>