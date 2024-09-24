<?php
session_start();
require  '../../../koneksi.php';

$idPasien  = $_GET['idPasien'];
$sql = "DELETE FROM daftarrawat WHERE idPasien = '$idPasien'";
$query = mysqli_query($kon, $sql);
if ($query > 0) {
    $_SESSION['pesan'] = '
		<div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
			<b>Berhasil!</b> Data Rawat berhasil dihapus
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?daftarPasien');
} else {
    $_SESSION['pesan'] = '
		<div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
			<b>Gagal!</b> Data Rawat gagal dihapus
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?daftarPasien');
}
