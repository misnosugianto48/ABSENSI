<!-- <div class='container-sm mt-5'>
  <div class='container-fluid'>
    <section class='wrapper'>
      <div class='card'>
        <div class='card-header'>
          <h3 class='card-header'>Selamat Datang</h3>
          <div class='card-body'>
            <h5 class='card-title'>Absensi</h5>
            <table class='table table-sm table-responsive-sm'>
              <thead class='table-primary'>
                <tr>
                  <th scope='col'>Tanggal</th>
                  <th scope='col'>Check-in</th>
                  <th scope='col'>Check-out</th>
                  <th scope='col'>Performa</th>
                </tr>
              </thead> -->

<?php
include "../connection.php";


date_default_timezone_set("Asia/Jakarta"); //GMT +07

$tgl = date('Y-m-d');
$time = date('H:i:s');
$employee_id = $_SESSION['employee_id'];



$sql = "SELECT * FROM attendances WHERE employee_id=$employee_id";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "
                <tbody>
                <tr>
                <td>" . $row['tgl'] . "</td>
                <td>" . $row['check_in'] . "</td>
              ";
  // echo "<tr>";
  // echo "<td>" . $row['tgl'] . "</td>";
  // echo "<td>" . $row['check_in'] . "</td>";

  if (empty($row['check_out']) && !empty($row['check_in']) && $tgl == $row['tgl']) {
    echo "<td>
      <form action='' method='POST'>
      <button type='submit' name='keluar' class='btn btn-outline-danger'>check-out</button>
      </form>
      </td>";
  } else {
    echo "<td>" . $row['check_out'] . "</td>";
  }
  echo "
                    <td>😂</td>
                  <tr>
                </tbody>";
}
?>
<!-- </table> -->
<form action="action.php" method="POST">
  <button type="submit" name="absen" class=" mt-2 mb-2 btn btn-outline-success">ABSEN SEKARANG</button>
</form>
<!-- </div>
        </div>
      </div>
    </section>
  </div>
</div> -->

<?php
if (isset($_POST['keluar'])) {
  $update = mysqli_query($db, "UPDATE attendances SET check_out = '$time' WHERE employee_id = '$employee_id' AND tgl = '$tgl'");
  if ($update === true) {
    session_start();
    session_destroy();
    echo "<script>
    alert('Terimakasih');
    document.location = '../index.php?message=keluar dari sistem';
</script>";
  } else {
    echo "<script>
    alert('Failed To Chech-out');
    document.location = 'absensi.php';
</script>";
  }
}
