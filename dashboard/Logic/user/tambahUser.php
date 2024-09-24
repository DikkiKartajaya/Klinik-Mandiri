<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$namaUser = $_POST['namaUser'];
$username = $_POST['username'];
$password = $_POST['password'];
$jabatan = $_POST['jabatan'];


// menambah id obat sesuai golongan
if($jabatan == 2){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 2");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'DOK' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Dokter';
} elseif ($jabatan == 3){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 3");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'APT' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Apoteker';
} elseif ($jabatan == 1){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 1");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'ADM' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Administrasi';
} elseif ($jabatan == 5){
    $query_idp = mysqli_query($kon, "SELECT count(idUser) as total FROM user WHERE level = 5");
    $idpas = mysqli_fetch_assoc($query_idp);
    $no_idp = $idpas['total'] + 1;
    $a_no = 'PML' . str_pad($no_idp, 4, '0', STR_PAD_LEFT);
    $jab = 'Pemilik';
} 

//eksekusi query
$sql = "INSERT INTO user (idUser, username, password, namaUser, level, jabatan) VALUES ('$a_no', '$username', '$password', '$namaUser', '$jabatan', '$jab')";
$query = mysqli_query($kon, $sql);


if ($sql) {
    $_SESSION['pesan'] = '
        <b>Berhasil!</b> Data berhasil ditambahkan
    ';
    header('location:../../index.php?user');
} else {
    $_SESSION['pesan'] = '
            <b>Gagal!</b> Data gagal ditambahkan
    ';
    header('location:../../index.php?user');
    echo ($sql);
}