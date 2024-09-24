<?php  
session_start();
require '../../../koneksi.php';

$idAssesment = $_GET['idAssesment'];
$resep = mysqli_query($kon, "SELECT * FROM detail_obat WHERE idAssesment = '$idAssesment'");
$assesment = mysqli_query($kon, "SELECT tanggalKunjungan, idPasien FROM assesment WHERE idAssesment = '$idAssesment'");
$cassesment = mysqli_fetch_assoc($assesment);
$tanggalKunjunganTimestamp = strtotime($cassesment['tanggalKunjungan']);
$idPasien = $cassesment['idPasien'];
$pasien = mysqli_query($kon, "SELECT namaPasien, lahirPasien , jkPasien, alamat FROM pasien WHERE idPasien = '$idPasien'");
$cpasien = mysqli_fetch_assoc($pasien);
$lahirPasienTimestamp = strtotime($cpasien['lahirPasien']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title class="no-print">RESEP OBAT</title>

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
<div class="container mt-5">

      <div class="row">
        <div class="col-md-6 mx-auto" style="border: 1px solid #000;">
        <img class="position-absolute mt-2" src="../../../asset/img/logo1.png" alt="" width="100px">
        <div class="col-md-12">
          <h1 class="text-center">Praktik Mandiri</h1>
          <h1 class="text-center"> dr. Tati Nuryanti</h1>
          <p class="text-center m-0">SIP: 503/788/SIPD/DPMPTSP/2022</p>
          <p class="text-center mb-0">Jalan Warung Bitung - Campaka Cianjur HP 082246886498</p>
        </div>
        <hr style="height: 3px; background: black;" class="m-0">
        <h4 class="text-center mt-4"><u>RESEP OBAT</u></h4>
        <div class="info">
        </div>
          <div class="row mt-3">
            <div class="col-md-6">
              Tanggal : <?= date('d-m-Y', $tanggalKunjunganTimestamp) ?><br>
              ID Assesment : <?= $idAssesment ?>
            </div>
            <div class="col-md-6">
              Nama Pasien : <?= $cpasien['namaPasien'] ?>
              Tanggal Lahir : <?= date('d-m-Y', $lahirPasienTimestamp) ?><br>
              Jenis Kelamin : <?= $cpasien['jkPasien'] ?><br>
              Alamat : <?= $cpasien['alamat'] ?>
            </div>
          </div>
          <hr>
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Nama Obat</th>
                  <th>Jumlah (Strip/Sachet/Botol)</th>
                  <th>Dosis (Per Hari)</th>
                  <th>Keterangan</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($resep as $rs) :
                  $q_obat = mysqli_query($kon, "SELECT * FROM obat WHERE idObat = '{$rs['idObat']}'");
                  $obat = mysqli_fetch_assoc($q_obat);
              ?>
                  <tr>
                      <td><?= $obat['namaObat'] ?></td>
                      <td><?= $rs['jumlahObat'] ?></td>
                      <td><?= $rs['dosisObat'] ?></td>
                      <td><?= $rs['keteranganObat'] ?></td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
      </table>
          <hr>
          <div class="row">
            <div class="col text-center">
              <p>
                Terima Kasih <br> Atas Kunjungan Anda
              </p>
            </div>
            <button id="printButton" class="btn btn-secondary no-print" type ="submit" name="tambah" style="margin : 5px;"><i class="fas fa-print"></i></button>
          </div>
        </div>
      </div>
    </div>
<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>