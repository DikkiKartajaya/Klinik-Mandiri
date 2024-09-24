<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$namaTindakan = $_POST['namaTindakan'];
$biayaTindakan = $_POST['biayaTindakan'];


$query_tdk = mysqli_query($kon, "SELECT count(idTindakan) as total FROM tindakan ");
$idtdk = mysqli_fetch_assoc($query_tdk);
$no_tdk = $idtdk['total'] + 1;
$a_no = 'TDK' . str_pad($no_tdk, 4, '0', STR_PAD_LEFT);

$sql = "INSERT INTO tindakan (idTindakan, namaTindakan, biayaTindakan) VALUES ('$a_no', '$namaTindakan', '$biayaTindakan')";
$query = mysqli_query($kon, $sql);


if ($sql) {
    $_SESSION['pesan'] = '
        <b>Berhasil!</b> Data berhasil ditambahkan
    ';
    header('location:../../index.php?tindakan');
} else {
    $_SESSION['pesan'] = '
            <b>Gagal!</b> Data gagal ditambahkan
    ';
    header('location:../../index.php?tindakan');
    echo ($sql);
}