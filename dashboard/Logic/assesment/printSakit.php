<?php  
session_start();
require '../../../koneksi.php';

$idPasien = $_GET['idPasien'];
$jumlah = $_POST['jumlah'];
$jumlahhari = $jumlah - 1;
$cpasien = mysqli_query($kon, "SELECT *, TIMESTAMPDIFF(YEAR, lahirPasien, CURDATE()) AS tahun, TIMESTAMPDIFF(MONTH, lahirPasien, CURDATE()) % 12 AS bulan FROM pasien WHERE idPasien = '$idPasien'");
$pasien = mysqli_fetch_assoc($cpasien);
$lahirPasienTimestamp = strtotime($pasien['lahirPasien']);

// Mendapatkan tanggal saat ini
$currentDate = date('d-m-Y');

// Menambahkan jumlah hari ke tanggal saat ini
$futureDate = date('d-m-Y', strtotime($currentDate . ' + ' . $jumlahhari . ' days'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Surat Sakit</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../asset/plugins/fontawesome-pro/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../asset/dist/css/adminlte.min.css">
  <!-- Icon Website -->
  <link rel="icon" type="image/png" href="../../../asset/img/logo1.png">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css"> -->
  <link rel="stylesheet" href="../../../asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- costum css -->
  <link rel="stylesheet" href="../../../asset/css/custom.css">
  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<style>
@page { size: auto;  margin: 3mm; }
@media print {
        .no-print {
            display: none;
        }
    }
</style>
<body>
    <!-- start surat rujugkan -->
    <div class="container" style="max-width: 900px;">
    <div class="row">
        <img class="position-absolute mt-3" src="../../../asset/img/logo1.png" alt="" width="100px">
      <div class="col-md-12">
        <h1 class="text-center">Praktik Mandiri</h1>
        <h1 class="text-center"> dr. Tati Nuryanti</h1>
        <p class="text-center m-0">SIP 503/788/SIPD/DPMPTSP/2022</p>
        <p class="text-center mb-0">Jalan Lembur Sawah-Campaka Cianjur HP 082246886498</p>
      </div>
  </div>
  <hr style="height: 3px; background: black;" class="m-0">

  <h4 class="text-center mt-4"><u>SURAT KETERANGAN SAKIT</u></h4>
  <div class="info">
    <p>Yang bertanda tangan di bawah ini, saya menerangkan :</p>
  </div>
  <table  style="border:none" class="mb-5">
    <tr>
      <th>Nama:</th>
      <td><?= $pasien['namaPasien'] ?></td>
      <td><?= $pasien['jkPasien'] ?></td>
    </tr>
    <tr>
      <th>Tanggal Lahir / Usia:</th>
      <td><?= date('d-m-Y', $lahirPasienTimestamp) ?> / <?= $pasien['tahun'] . ' tahun ' . $pasien['bulan'] . ' bulan'; ?></td>
    </tr>
    <tr>
      <th>Alamat:</th>
      <td><?= $pasien['alamat'] ?></td>
    </tr>
  </table >
  <p>Bahwa orang tersebut diatas betul-betul dalam keadaan sakit dan perlu mendapat istirahat selama <?php echo $jumlah ?> hari. Terhitung mulai tanggal <?php echo $currentDate; ?> s.d <?php echo $futureDate; ?></span>.</p>
  <p>Demikian surat keterangan sakit ini dibuat dengan sebenarnya, agar dapat digunakan sebagaimana mestinya.</p>
  <div class="mt-5" >
    <div class="row">
      <div class="col-8"></div>
      <div class="col-4">
        <p class="text-center">Cianjur, <?php echo $currentDate; ?></p>
        <p class="text-center mb-5">Pemeriksa,</p>
        <p class="text-center">(dr. Tati Nuryanti)</p>
      </div>
    </div>
    <button id="printButton" class="btn btn-secondary no-print" type ="submit" name="tambah" style="margin : 5px;"><i class="fas fa-print"></i></button>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../asset/dist/js/adminlte.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../../asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../../asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../../asset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../../asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../../asset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../../asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../../asset/plugins/jszip/jszip.min.js"></script>
<script src="../../../asset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../../asset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../../asset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../../asset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../../asset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  document.getElementById('printButton').addEventListener('click', function() {
      window.print();
  });
    </script>
</body>
</html>