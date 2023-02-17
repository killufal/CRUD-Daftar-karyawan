<?php
  if (isset($_GET["id_karyawan"])) {
    $id_karyawan = $_GET["id_karyawan"];

$servername  = "localhost";
$username = "root";
$password = "";
$database= "myshop";

//create conenction
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM karyawan WHERE id_karyawan=$id_karyawan";
$connection->query($sql);
}

header("location: /TUGAS-BESAR/index.php");
      exit;

?>