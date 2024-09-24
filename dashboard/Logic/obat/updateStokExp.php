<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$idObat = $_GET['idObat'];
$namaObat = $_POST['namaObat'];
$Stok = $_POST['Stok'];
$alasan = $_POST['alasan'];
// menambah id pasien sesuai format
$query_idp = mysqli_query($kon, "SELECT count(idObatExp) as total FROM obatexpired");
$idhis = mysqli_fetch_assoc($query_idp);
$no_his = $idhis['total'] + 1;
$a_no = 'EXP' . str_pad($no_his, 4, '0', STR_PAD_LEFT);

//eksekusi query
$sql = "INSERT INTO obatexpired (idObatExp, idObat, tanggalUpdate, Stok, alasan) VALUES ('$a_no', '$idObat', CURDATE(), $Stok ,'$alasan')";
$sql2 = "UPDATE obat SET stokObat = stokObat - $Stok WHERE idObat = '$idObat'";
$result = mysqli_query($kon, $sql);
$result2 = mysqli_query($kon, $sql2);

if ($result && $result2) {
    $_SESSION['pesan'] = '
        <b>Berhasil!</b> Data Stok Obat Expired ditambahkan
    ';
    header('location:../../index.php?obat');
} else {
    $_SESSION['pesan'] = '
        <b>Gagal!</b> Data gagal ditambahkan
    ';
    header('location:../../index.php?obat');
}
?>
