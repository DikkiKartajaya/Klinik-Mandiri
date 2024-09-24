<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$namaObat = $_POST['namaObat'];
$stokObat = $_POST['stokObat'];
$hargaObat = $_POST['hargaObat'];
$idGolongan = $_POST['idGolongan'];
$jenisObat = $_POST['jenisObat'];

// menambah id obat sesuai golongan
if($idGolongan == 1){
    $query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 1 AND idObat LIKE 'FO%'");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'FO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
} elseif ($idGolongan == 2){
    $query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 2 AND idObat LIKE 'LF%'");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'LF' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
} elseif ($idGolongan == 3){
    $query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 3 AND idObat LIKE 'PO%'");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'PO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
} elseif ($idGolongan == 4){
    $query_idp = mysqli_query($kon, "SELECT count(idObat) as total FROM obat WHERE idGolongan = 4 AND idObat LIKE 'NO%'");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'NO' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
}

//eksekusi query
$sql = "INSERT INTO obat (idObat, idGolongan, namaObat, jenisObat, stokObat, hargaObat) VALUES ('$a_no', '$idGolongan', '$namaObat', '$jenisObat', '$stokObat', '$hargaObat')";
$query = mysqli_query($kon, $sql);
echo $sql;

if ($sql) {
    $_SESSION['pesan'] = '
        <b>Berhasil!</b> Data berhasil ditambahkan
    ';
    header('location:../../index.php?obat');
} else {
    $_SESSION['pesan'] = '
            <b>Gagal!</b> Data gagal ditambahkan
    ';
    header('location:../../index.php?obat');
    echo ($sql);
}