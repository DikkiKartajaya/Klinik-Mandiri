<?php  
session_start();
require '../../../koneksi.php';
require 'rupiah.php';

$idAssesment = $_GET['idAssesment'];
$jumlahdibayar = $_POST['dibayar'];
$q_struk = mysqli_query($kon, "SELECT * FROM assesment WHERE idAssesment = '$idAssesment'");
$struk = mysqli_fetch_assoc($q_struk);
$tanggalKunjunganTimestamp = strtotime($struk['tanggalKunjungan']);
$idPasien = $struk['idPasien'];

$qpasien = mysqli_query($kon, "SELECT * FROM pasien WHERE idPasien = '$idPasien'");
$pasien = mysqli_fetch_assoc($qpasien);
$lahirPasienTimestamp = strtotime($pasien['lahirPasien']);

$qdetail_obat = mysqli_query($kon, "SELECT * FROM detail_obat WHERE idAssesment  = '$idAssesment'");
$detail_obat = mysqli_fetch_assoc($qdetail_obat);
$idObat = $detail_obat['idObat'];

$qtotal_byo = mysqli_query($kon, "SELECT SUM(totalHargaObat) as total_byo FROM detail_obat WHERE idAssesment = '$idAssesment'");
$total_byo = mysqli_fetch_assoc($qtotal_byo);

$qdetail_tindakan = mysqli_query($kon, "SELECT * FROM detail_tindakan WHERE idAssesment  = '$idAssesment'");
$detail_tindakan = mysqli_fetch_assoc($qdetail_tindakan);
$idTindakan = $detail_tindakan['idTindakan'];

$qtotal_byt = mysqli_query($kon, "SELECT SUM(totalHargaTindakan) as total_byt FROM detail_tindakan WHERE idAssesment = '$idAssesment'");
$total_byt = mysqli_fetch_assoc($qtotal_byt);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <title>Struk</title>
    <style>
      hr {
        border-top: 2px dashed;
      }
      @media print {
        .no-print {
            display: none;
        }
    }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 mx-auto" style="border: 1px solid #000;">
          <h4 class="text-center mt-2"><img src="../../../asset/img/logo1.png" width="40" align="middle"><span class="mt-3"> Praktik Mandiri dr. Tati Nuryanti</span></h4>
          <hr>
          <div class="row mt-3">
            <div class="col-md-6">
              Tanggal : <?= date('d-m-Y', $tanggalKunjunganTimestamp) ?><br>
              ID Assesment : <?= $struk['idAssesment'] ?>
            </div>
            <div class="col-md-6">
              Nama Pasien : <?= $pasien['namaPasien'] ?>
              Tanggal Lahir : <?= date('d-m-Y', $lahirPasienTimestamp) ?><br>
              Jenis Kelamin : <?= $pasien['jkPasien'] ?><br>
              Alamat : <?= $pasien['alamat'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <?php foreach ($qdetail_obat as $do) :
              $qobat = mysqli_query($kon, "SELECT * FROM obat WHERE idObat = '$do[idObat]'");
              $obat = mysqli_fetch_assoc($qobat);
              $total_ho = $obat['hargaObat'] * $do['jumlahObat'];
            ?>
              <div class="col-md-3"><?= $obat['namaObat'] ?> x <?= $do['jumlahObat'] ?></div>
              <div class="col-md-4 text-right">Rp. <?= rupiah($obat['hargaObat']) ?></div>
              <div class="col-md-4 text-right">Rp. <?= rupiah($do['totalHargaObat']) ?></div>
              <!-- <div class="col-md-4 text-right">Rp. <?= rupiah($total_byo['total_byo']) ?></div> -->
            <?php endforeach; ?>
          </div>
          <div class="row">
            <?php foreach ($qdetail_tindakan as $dt) :
              $qtindakan = mysqli_query($kon, "SELECT * FROM tindakan WHERE idTindakan = '$dt[idTindakan]'");
              $tindakan = mysqli_fetch_assoc($qtindakan);
              $total_ht = $tindakan['biayaTindakan'] * $dt['jumlahTindakan'];
            ?>
              <div class="col-md-3"><?= $tindakan['namaTindakan'] ?> x <?= $dt['jumlahTindakan'] ?></div>
              <div class="col-md-4 text-right">Rp. <?= rupiah($tindakan['biayaTindakan']) ?></div>
              <div class="col-md-4 text-right">Rp. <?= rupiah($dt['totalHargaTindakan']) ?></div>
              <!-- <div class="col-md-4 text-right">Rp. <?= rupiah($total_byt['total_byt']) ?></div> -->
            <?php endforeach; ?>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-1"></div>
            <div class="col-md-4 text-right">TOTAL</div>
            <div class="col-md-4 text-right">Rp. <?= rupiah($total_byo['total_byo']+ $total_byt['total_byt']) ?></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-1"></div>
            <div class="col-md-4 text-right">Jumlah Dibayar</div>
            <div class="col-md-4 text-right">Rp. <?= rupiah($jumlahdibayar) ?></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-1"></div>
            <div class="col-md-4 text-right">Kembalian</div>
            <div class="col-md-4 text-right">Rp. <?= rupiah($jumlahdibayar - ($total_byo['total_byo']+ $total_byt['total_byt'])) ?></div>
          </div>
          <hr>
          <div class="row">
            <div class="col text-center">
              <p>
                Terima Kasih Atas Kunjungan Anda <br> Semoga Lekas Sembuh
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
    </script>
  </body>
</html>