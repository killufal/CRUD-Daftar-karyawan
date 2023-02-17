<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TUGAS-BESAR</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>Daftar Karyawan</h2>
    <a class="btn btn-primary" href="/TUGAS-BESAR/create.php" role="button">Tambah Karyawan</a>
   
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>Id Karyawan</th>
          <th>Nama</th>
          <th>Id divisi</th>
          <th>Nomor Telepon</th>
          <th>Alamat</th>
          <th>Dibuat Pada</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername  = "localhost";
        $username = "root";
        $password = "";
        $database= "myshop";

        //create conenction
        $connection = new mysqli($servername, $username, $password, $database);

        // check connection
        if ($connection->connect_error) {
          die("connection failed : " . $connection->connect_error);
        }

        // read all row from database table
        $sql = "SELECT * FROM karyawan";
        $result = $connection->query($sql);

        if(!$result) {
          die("invalid query: " . $connection->error);
        }

        // read data each row
        while ($row = $result->fetch_assoc()) {
          echo "
            <tr>
            <td>$row[id_karyawan]</td>
            <td>$row[nama]</td>
            <td>$row[id_divisi]</td>
            <td>$row[no_tlp]</td>
            <td>$row[alamat]</td>
            <td>$row[dibuat]</td>
            <td>
              <a class='btn btn-primary btn-sm' href='/TUGAS-BESAR/Edit.php?id_karyawan=$row[id_karyawan]'>Edit</a>
              <a class='btn btn-danger btn-sm' href='/TUGAS-BESAR/Hapus.php?id_karyawan=$row[id_karyawan]'>Hapus</a>
            </td>
          </tr>
          ";
        }
        ?>

        
      </tbody>
    </table>
  </div>
</body>
</html>