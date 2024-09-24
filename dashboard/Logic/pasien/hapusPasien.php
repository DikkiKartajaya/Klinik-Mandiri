<?php
session_start();
require  '../../../koneksi.php';

$idPasien  = $_GET['idPasien'];
$query = "DELETE FROM pasien WHERE idPasien = '$idPasien'";
$sql = mysqli_query($kon, $query);
// echo($sql);
if ($sql > 0) {
    $_SESSION['pesan'] = '
		<div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
			<b>Berhasil!</b> Pasien berhasil dihapus
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?pasien');
} else {
    $_SESSION['pesan'] = '
		<div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
			<b>Gagal!</b> Pasien gagal dihapus
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?pasien');
}
