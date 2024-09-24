<?php
session_start();
require  '../../../koneksi.php';

$idUser  = $_GET['idUser'];
$query = "DELETE FROM user WHERE idUser = '$idUser'";
$sql = mysqli_query($kon, $query);
// echo($sql);
if ($sql > 0) {
    $_SESSION['pesan'] = '
			<b>Berhasil!</b> User berhasil dihapus	
	';
	header('location:../../index.php?user');
} else {
    $_SESSION['pesan'] = '
			<b>Gagal!</b> User gagal dihapus
	';
	header('location:../../index.php?user');
}
