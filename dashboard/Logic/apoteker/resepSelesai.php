<?php
    session_start();
    include '../../../koneksi.php';

    $idAssesment = $_GET['idAssesment'];
    $resep = mysqli_query($kon, "UPDATE resep SET statusResep = 'done' WHERE idAssesment = '$idAssesment'");


    if ($resep) {
        $_SESSION['pesan'] = '
            <b>Berhasil!</b> Resep Selesai Semoga Cepat Sembuh!
        ';
        header('location: ../../index.php?resep');
    } else {
        $_SESSION['pesan'] = '
                <b>Gagal!</b> Data gagal diubah
        ';
        header('location: ../../index.php?resep');
    }
?>