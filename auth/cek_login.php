<?php
// memulai session
session_start();
include '../koneksi.php';

// menerima data username dan password dari form
$username = $_POST['username'];
$password = $_POST['password'];

// cek database
$login = mysqli_query($kon, "SELECT * FROM user WHERE username ='$username' AND password='$password'");
$cek = mysqli_num_rows($login);

// cek privilege dan set session
if ($cek > 0) {
	$data = mysqli_fetch_assoc($login);

	if ($data['level']==1) {
		$_SESSION['namaUser'] = $data['namaUser'];
		$_SESSION['idUser'] = $data['idUser'];
		$_SESSION['jabatan'] = "Admin";
		header("location:../dashboard/index.php?dashboard");

	} elseif ($data['level']==2) {
		$_SESSION['namaUser'] = $data['namaUser'];
		$_SESSION['idUser'] = $data['idUser'];
		$_SESSION['jabatan'] = "Dokter";
		header("location:../dashboard/index.php?dashboard");

	} elseif ($data['level']==3) {
		$_SESSION['namaUser'] = $data['namaUser'];
		$_SESSION['idUser'] = $data['idUser'];
		$_SESSION['jabatan'] = "Apoteker";
		header("location:../dashboard/index.php?dashboard");

	} elseif ($data['level']==4) {
		$_SESSION['namaUser'] = $data['namaUser'];
		$_SESSION['idUser'] = $data['idUser'];
		$_SESSION['jabatan'] = "Administrasi";
		header("location:../dashboard/index.php?dashboard");
	}elseif ($data['level']==5) {
		$_SESSION['namaUser'] = $data['namaUser'];
		$_SESSION['idUser'] = $data['idUser'];
		$_SESSION['jabatan'] = "Pemilik";
		header("location:../dashboard/index.php?dashboard");
	} elseif ($data['level']==6) {
		$_SESSION['namaUser'] = $data['namaUser'];
		$_SESSION['idUser'] = $data['idUser'];
		$_SESSION['jabatan'] = "Super Admin";
		header("location:../dashboard/index.php?dashboard");
	} else  {
		header("location:index.php?pesan=gagal");
	}
} else {
	header("location:index.php?pesan=gagal");
}
?>