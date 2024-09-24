<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$namaPasien = $_POST['namaPasien'];
$lahirPasien = $_POST['lahirPasien'];
$jkPasien = $_POST['jkPasien'];
$namaWali = $_POST['namaWali'];
$alamat = $_POST['alamat'];


// menambah id pasien sesuai format
$query_idp = mysqli_query($kon, "SELECT count(idPasien) as total FROM pasien");
$idpas = mysqli_fetch_assoc($query_idp);
$no_idp = $idpas['total'] + 1;
$a_no = 'IDP' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);

//eksekusi query
$sql = "INSERT INTO pasien (tanggalDaftar, idPasien, namaPasien, lahirPasien, jkPasien, namaWali, alamat) VALUES (CURDATE(), '$a_no','$namaPasien', '$lahirPasien', '$jkPasien', '$namaWali', '$alamat')";
$sql = mysqli_query($kon, $sql);

if ($sql) {
        $_SESSION['pesan'] = '
            <b>Berhasil!</b> Data berhasil ditambahkan
        ';
        header('location:../../index.php?pasien');
} else {
    $_SESSION['pesan'] = '
            <b>Gagal!</b> Data gagal ditambahkan
    ';
    header('location:../../index.php?pasien');
    echo ($sql);
}

?>
