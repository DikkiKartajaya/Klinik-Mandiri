<?php  
session_start();
include '../koneksi.php';
include 'fungsi/rupiah.php';
?>

<?php 
    $jabatan = $_SESSION['jabatan'];
if ($jabatan=="Admin"){ ?>
<title>Halaman Administrasi</title>
<?php } elseif ($jabatan=="Dokter") {?>
<title>Halaman Dokter</title>
<?php } elseif ($jabatan=="Administrasi") {?>
<title>Halaman Administrasi</title>
<?php } elseif ($jabatan=="Apoteker") {?>
<title>Halaman Apoteker</title>
<?php } elseif ($jabatan=="Pemilik") {?>
<title>Halaman Pemilik</title>
<?php } elseif ($jabatan=="Super Admin") {?>
<title>Halaman Super Admin</title>
<?php } elseif ($jabatan=="") {?>
<title>Halaman SI Praktik Mandiri</title>
<?php }?>

<?php
$role_images = [
    'Admin' => '../asset/img/admin.png',
    'Dokter' => '../asset/img/dokter.png',
    'Administrasi' => '../asset/img/admin.png',
    'Apoteker' => '../asset/img/apoteker.png',
    'Pemilik' => '../asset/img/pemilik.png',
];

// Default image if role is not found
$default_image = '../asset/img/admin.png';

// Get the profile image based on the role
$profileImageUrl = isset($role_images[$jabatan]) ? $role_images[$jabatan] : $default_image;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../asset/plugins/fontawesome-pro/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../asset/dist/css/adminlte.min.css">
  <!-- Icon Website -->
  <link rel="icon" type="image/png" href="../asset/img/logo.png">
  <!-- DataTables -->
  <link rel="stylesheet" href="../asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css"> -->
  <link rel="stylesheet" href="../asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- costum css -->
  <link rel="stylesheet" href="../asset/css/custom.css">
  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../asset/img/logo1.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?dashboard" class="brand-link">
      <img src="../asset/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Praktik Mandiri</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $profileImageUrl; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block"><?= $_SESSION['namaUser'] ?></a disabled>
          <a class="btn btn-danger btn-sm" href="../auth/logout.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if ($jabatan=="Super Admin"): ?>
          <li class="nav-item">
            <a href="index.php?dashboard" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?user" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Data User</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?pasien" class="nav-link"><i class="nav-icon fas fa-hospital-user"></i><p>Data Pasien</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?daftarPasien" class="nav-link"><i class="nav-icon fas fa-syringe"></i><p>Daftar Rawat Pasien</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?resep" class="nav-link"><i class="nav-icon fas fa-receipt"></i><p>Data Resep</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?obat" class="nav-link"><i class="nav-icon fas fa-pills"></i><p>Data Obat</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?tindakan" class="nav-link"><i class="nav-icon fas fa-stethoscope"></i><p>Tindakan</p></a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"><li class="nav-item">
                <a href="index.php?laporanKunjugan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Kunjungan Pasien Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanBeliObat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Daftar Pesanan Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanObatExpired" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Obat Expired</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanPenghasilan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penghasilan</p>
                </a>
              </li>
        <?php elseif ($jabatan=="Admin"): ?>
          <li class="nav-item">
            <a href="index.php?dashboard" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?user" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Data User</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?pasien" class="nav-link"><i class="nav-icon fas fa-hospital-user"></i><p>Data Pasien</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?daftarPasien" class="nav-link"><i class="nav-icon fas fa-syringe"></i><p>Daftar Rawat Pasien</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?resep" class="nav-link"><i class="nav-icon fas fa-receipt"></i><p>Data Resep</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?obat" class="nav-link"><i class="nav-icon fas fa-pills"></i><p>Data Obat</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?tindakan" class="nav-link"><i class="nav-icon fas fa-stethoscope"></i><p>Tindakan</p></a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"><li class="nav-item">
                <a href="index.php?laporanKunjugan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Kunjungan Pasien Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanBeliObat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Daftar Pesanan Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanObatExpired" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Obat Expired</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanPenghasilan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penghasilan</p>
                </a>
              </li>
        <?php elseif ($jabatan=="Dokter"): ?>
          <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?pasien" class="nav-link"><i class="nav-icon fas fa-hospital-user"></i><p>Data Pasien</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?daftarPasien" class="nav-link"><i class="nav-icon fas fa-syringe"></i><p>Daftar Rawat Pasien</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?obat" class="nav-link"><i class="nav-icon fas fa-pills"></i><p>Data Obat</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?tindakan" class="nav-link"><i class="nav-icon fas fa-stethoscope"></i><p>Tindakan</p></a>
          </li>
        <?php elseif ($jabatan=="Apoteker"): ?>
          <li class="nav-item">
            <a href="index.php?dashboard" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Dashboard</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?resep" class="nav-link"><i class="nav-icon fas fa-receipt"></i><p>Data Resep</p></a>
          </li>
          <li class="nav-item">
            <a href="index.php?obat" class="nav-link"><i class="nav-icon fas fa-pills"></i><p>Data Obat</p></a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="index.php?laporanBeliObat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Daftar Pesanan Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanObatExpired" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Obat Expired</p>
                </a>
              </li>
          <?php elseif ($jabatan=="Pemilik"): ?>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"><li class="nav-item">
                <a href="index.php?laporanKunjugan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Kunjungan Pasien Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanBeliObat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Daftar Pesanan Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanObatExpired" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Obat Expired</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?laporanPenghasilan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Penghasilan</p>
                </a>
              </li>
        </ul>
      </nav>
      <?php endif; ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



