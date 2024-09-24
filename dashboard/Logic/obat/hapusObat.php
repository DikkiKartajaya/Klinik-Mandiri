<?php
session_start();
require  '../../../koneksi.php';

$idObat  = $_GET['idObat'];
$sql = "DELETE FROM obat WHERE idObat = '$idObat'";
$query = mysqli_query($kon, $sql);
if ($query > 0) {
    $_SESSION['pesan'] = '
		<div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
			<b>Berhasil!</b> Obat berhasil dihapus
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?obat');
} else {
    $_SESSION['pesan'] = '
		<div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
			<b>Gagal!</b> Obat gagal dihapus
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?obat');
}
