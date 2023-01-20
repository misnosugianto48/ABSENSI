<?php
include("../connection.php");
session_start();

date_default_timezone_set("Asia/Jakarta"); //GMT +07

$employee_id = $_SESSION['employee_id'];
$tgl = date('Y-m-d');
$check_in = date('H:i:s');

$id = $_POST['id'];
$nip = $_POST['employee_id'];
$nama = $_POST['fullname'];
$role = $_POST['role'];
$password = md5($_POST['password']);

if (isset($_POST['absen'])) {

  $check_absensi = "SELECT * FROM attendances WHERE employee_id=$employee_id AND tgl = '$tgl'";
  $check = $db->query($check_absensi);

  if ($check->num_rows > 0) {
    header("location:index.php?message=Anda Sudah Absen");
  } else {
    $sql = "INSERT INTO attendances (id, employee_id, tgl, check_in, check_out) VALUES (NULL, $employee_id, '$tgl', '$check_in', NULL)";

    $result = $db->query($sql);
    if ($result === TRUE) {
      header("location:index.php?message=absen berhasil dilakukan");
    } else {
      header("location:index.php?message=absensi gagal!");
    }
  }
}



// tambah user
if (isset($_POST['btambah'])) {

  if (isset($_POST['btambah'])) {
    $simpan = mysqli_query($db, "INSERT INTO users(id, employee_id, fullname, role, password) 
                                      VALUES (NULL, $nip, '$nama', '$role', '$password')");
    if ($simpan) {
      echo "<script>
              alert('Success');
              document.location = 'user-admin.php';
          </script>";
    } else {
      echo "<script>
              alert('Failed Add New Data');
              document.location = 'user-admin.php';
          </script>";
    }
  }
}

// edit data
if (isset($_POST['bedit'])) {
  $edit = mysqli_query($db, "UPDATE users SET fullname = '$nama', role ='$role', password = '$password' WHERE employee_id = '$nip'");

  if ($edit) {
    echo "<script>
              alert('Edit Success ');
              document.location = 'user-admin.php';
          </script>";
  } else {
    echo "<script>
              alert('Failed To Edit Data');
              document.location = 'user-admin.php';
          </script>";
  }
}

// hapus user
if (isset($_POST['bhapus'])) {
  $sql = ("DELETE FROM users WHERE id = '$id'");
  $result = $db->query($sql);

  if ($result) {
    echo "<script>
              alert('Delete Data Success');
              document.location = 'user-admin.php';
          </script>";
  } else {
    echo "<script>
              alert('Failed To Delete Data');
              document.location = 'user-admin.php';
          </script>";
  }
}
