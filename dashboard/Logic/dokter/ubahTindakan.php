<?php  
session_start();
error_reporting(0);
include "../../../koneksi.php";

// ambil data dari form
$idTindakan = $_GET['idTindakan'];
$namaTindakan = $_POST['namaTindakan'];
$biayaTindakan = $_POST['biayaTindakan'];

if(empty($idTindakan) || empty($namaTindakan) || empty($biayaTindakan) ) {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Harap lengkapi semua form
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
    header('location:../../index.php?tindakan');
    exit; // Stop eksekusi script karena input tidak valid
}
$sql = "UPDATE tindakan SET namaTindakan = '$namaTindakan', biayaTindakan = '$biayaTindakan' WHERE idTindakan = '$idTindakan'";
echo $sql;
$result = mysqli_query($kon, $sql);
    if ($sql) {
        $_SESSION['pesan'] = '
                    <b>Berhasil!</b> Data berhasil diubah
            ';
            header('location:../../index.php?tindakan');
    } else {
        $_SESSION['pesan'] = '
                    <b>Gagal!</b> Data gagal diubah
            ';
            header('location:../../index.php?tindakan');
    }
?>