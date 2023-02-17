<?php
$servername  = "localhost";
$username = "root";
$password = "";
$database= "myshop";

//create conenction
$connection = new mysqli($servername, $username, $password, $database);

$id_karyawan = "";
$nama = "";
$id_divisi = "";
$no_tlp = "";
$alamat = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
  // get method: shoe the data of client

  if (!isset($_GET["id_karyawan"])) {
    header("location: /TUGAS-BESAR/index.php");
      exit;
  }

  $id_karyawan= $_GET["id_karyawan"];

  // read the row of the selected client from database table
  $sql = "SELECT * FROM karyawan WHERE id_karyawan=$id_karyawan";
  $result = $connection->Query($sql);
  $row = $result->fetch_assoc();

  if(!$row) {
    header("location: /TUGAS-BESAR/index.php");
      exit;
  }

  $id_karyawan = $row["id_karyawan"];
  $nama = $row["nama"];
  $id_divisi = $row["id_divisi"];
  $no_tlp = $row["no_tlp"];
  $alamat = $row["alamat"];
}
else {
  // post method: update the data of the client

  $id_karyawan = $_POST["id_karyawan"];
  $nama = $_POST["nama"];
  $id_divisi = $_POST["id_divisi"];
  $no_tlp = $_POST["no_tlp"];
  $alamat = $_POST["alamat"];

  do {
    if ( empty($id_karyawan) || empty($nama) || empty($id_divisi) || empty($no_tlp) || empty($alamat) ) {
      $errorMessage = "Isi semua kolom!";
      break;
    }  

    $sql = "UPDATE karyawan " .
          "SET nama = '$nama', id_divisi = '$id_divisi', no_tlp = '$no_tlp', alamat = '$alamat' " .
          "WHERE id_karyawan = $id_karyawan";  

          $result = $connection->query($sql);

          if(!$result) {
            $errorMessage = "invalid query: " . $connection->error;
            break;
          }

          $successMessage = "Berhasil edit karayawan";
          
          {header("location: /TUGAS-BESAR/index.php");
          exit;
          }


  }while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Karyawan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <div class="container my-5">
    <h2>Edit Karyawan</h2>
<?php
if (!empty($errorMessage)) {
  echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
  ";
}
?>

    <form method="post">
      <input type="hidden" name="id_karyawan" value="<?php echo $id_karyawan; ?>">
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Nama</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">id_divisi</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="id_divisi" value="<?php echo $id_divisi; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">No Telepon</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="no_tlp" value="<?php echo $no_tlp; ?>">
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Alamat</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>">
        </div>
      </div>

      <?php
      if (!empty($successMessage)) {
      echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
        }

      ?>
      
      <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <div class="col-sm-3 d-grid">
          <a class="btn btn-outline-primary" href="/TUGAS-BESAR/index.php" role="button">Batal</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>