<?php
session_start();
include '../../../koneksi.php';

$idPasien = $_POST['idPasien'];
$idUser = $_SESSION['idUser'];

// menambah id pasien sesuai format
$query_dft = mysqli_query($kon, "SELECT count(idDaftarRawat) as total FROM daftarrawat");
$iddft = mysqli_fetch_assoc($query_dft);
$no_dft = $iddft['total'] + 1;
$a_no = 'RWT' . str_pad($no_dft, 4, '0', STR_PAD_LEFT);


$sql = "INSERT INTO daftarrawat (idDaftarRawat, idPasien, idUser, tanggalKunjungan, statusRawat) VALUES ('$a_no','$idPasien', '$idUser', CURDATE(), 'uncared')";

if (mysqli_query($kon, $sql)) {
    $_SESSION['pesan'] = '

            <b>Berhasil!</b> Pasien berhasil didaftarkan
    ';
} else {
    $error = mysqli_error($kon);
    $_SESSION['pesan'] = '
            <b>Gagal!</b> Pasien gagal didaftarkan. Error: ' . $error . '
    ';
}

header('location:../../index.php?pasien');
?>
