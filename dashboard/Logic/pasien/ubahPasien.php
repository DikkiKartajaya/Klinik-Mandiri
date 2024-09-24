<?php  
session_start();
error_reporting(0);
include "../../../koneksi.php";

// ambil data dari form
$idPasien = $_GET['idPasien'];
$namaPasien = $_POST['namaPasien'];
$lahirPasien = $_POST['lahirPasien'];
$jkPasien = $_POST['jkPasien'];
$namaWali = $_POST['namaWali'];
$alamat = $_POST['alamat'];

    $sql = "UPDATE pasien SET namaPasien = '$namaPasien', lahirPasien = '$lahirPasien', jkPasien = '$jkPasien', namaWali = '$namaWali', alamat = '$alamat' WHERE idPasien = '$idPasien'";
    $result = mysqli_query($kon, $sql);
		if ($sql) {
            $_SESSION['pesan'] = '
    					<b>Berhasil!</b> Data berhasil diubah
    			';
    			header('location:../../index.php?pasien');
		} else {
			$_SESSION['pesan'] = '
    					<b>Gagal!</b> Data gagal diubah
    			';
    			header('location:../../index.php?pasien');
		}
?>