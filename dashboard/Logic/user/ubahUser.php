<?php  
session_start();
error_reporting(0);
include "../../../koneksi.php";

// ambil data dari form
$idUser = $_GET['idUser'];
$username = $_POST['username'];
$password = $_POST['password'];
$namaUser = $_POST['namaUser'];
$jabatan = $_POST['jabatan'];


// cek form apakah ada yang kosong
if(empty($idUser) || empty($username) || empty($password) || empty($namaUser) || empty($jabatan)) {
	$_SESSION['pesan'] = '
		<div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
			<b>Gagal!</b> Harap lengkapi semua form
			<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
		</div>
	';
	header('location:../../index.php?user');
	exit; // Stop eksekusi script karena input tidak valid
}

// merubah id obat bila golongan obat diubah
if($jabatan == 2){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 2");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'DOC' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Dokter';
} elseif ($jabatan == 3){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 3");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'APO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Apoteker';
} elseif ($jabatan == 4){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 4");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'STR' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Administrasi';
}

//eksekusi query
$sql = "UPDATE user SET idUser = '$a_no', username = '$username', password = '$password', namaUser = '$namaUser', level = '$jabatan', jabatan = '$jab' WHERE idUser = '$idUser'";
$result = mysqli_query($kon, $sql);

	if ($sql) {
		$_SESSION['pesan'] = '
					<b>Berhasil!</b> Data berhasil diubah
			';
			header('location:../../index.php?user');
	} else {
		$_SESSION['pesan'] = '
					<b>Gagal!</b> Data gagal diubah
			';
			header('location:../../index.php?user');
			echo($sql);
	}
?>