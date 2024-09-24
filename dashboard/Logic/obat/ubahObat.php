<?php  
session_start();
error_reporting(0);
include "../../../koneksi.php";

// ambil data dari form
$idObat = $_GET['idObat'];
$namaObat = $_POST['namaObat'];
$hargaObat = $_POST['hargaObat'];
$idGolongan = $_POST['idGolongan'];
$jenisObat = $_POST['jenisObat'];


// merubah id obat bila golongan obat diubah
if($idGolongan == 1){
	$query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 1");
	$idpas = mysqli_fetch_assoc($query_idp);
	$no_idp = $idpas['total'] + 1;
	$a_no = 'FO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
} elseif ($idGolongan == 2){
	$query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 2");
	$idpas = mysqli_fetch_assoc($query_idp);
	$no_idp = $idpas['total'] + 1;
	$a_no = 'LF' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
} elseif ($idGolongan == 3){
	$query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 3");
	$idpas = mysqli_fetch_assoc($query_idp);
	$no_idp = $idpas['total'] + 1;
	$a_no = 'PO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
} elseif ($idGolongan == 4){
	$query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 4");
	$idpas = mysqli_fetch_assoc($query_idp);
	$no_idp = $idpas['total'] + 1;
	$a_no = 'NO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
}

//eksekusi query
$sql = "UPDATE obat SET idObat = '$a_no', namaObat = '$namaObat', idGolongan = '$idGolongan',jenisObat = '$jenisObat' ,hargaObat = '$hargaObat' WHERE idObat = '$idObat'";
echo $sql;
$result = mysqli_query($kon, $sql);

	if ($sql) {
		$_SESSION['pesan'] = '
					<b>Berhasil!</b> Data Obat berhasil diubah
			';
			header('location:../../index.php?obat');
	} else {
		$_SESSION['pesan'] = '
					<b>Gagal!</b> Data gagal diubah
			';
			header('location:../../index.php?obat');
			echo($sql);
	}
?>