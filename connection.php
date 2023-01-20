<?php

$hostname = "localhost";
$username = "root";
$password = "";
$db_name = "dbabsensi";

$db = new mysqli($hostname, $username, $password, $db_name);

if ($db->connect_error) {
  echo "Koneksi Error";
}
