<?php
    session_start();
    include '../../../koneksi.php';

    $idAssesment = $_POST['idAssesment'];
    $qpasien = mysqli_query($kon, "SELECT * FROM assesment WHERE idAssesment = '$idAssesment'");
    $dpasien = mysqli_fetch_array($qpasien);
    $idPasien = $dpasien['idPasien'];
    $proses = mysqli_query($kon, "UPDATE daftarrawat SET statusRawat = 'cared' WHERE idPasien = '$idPasien' AND statusRawat = 'uncared'");

    if ($proses) {
        $_SESSION['pesan'] = '
            <b>Berhasil!</b> Assesment Selesai Semoga Cepat Sembuh!
        ';
        header('location: ../../index.php?daftarPasien');
    } else {
        $_SESSION['pesan'] = '
                <b>Gagal!</b> Data gagal diubah
        ';
        header('location: ../../index.php?assesmentTindakan');
    }
?>