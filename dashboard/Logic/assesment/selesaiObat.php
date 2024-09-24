<?php
    session_start();
    include '../../../koneksi.php';

    $query_rsp = mysqli_query($kon, "SELECT COUNT(idResep) AS total FROM resep");
    $idrsp = mysqli_fetch_assoc($query_rsp);
    $no_rsp = $idrsp['total'] + 1;
    $a_no = 'RSP' . date('Ymd') . str_pad($no_rsp, 1, '0', STR_PAD_LEFT);

    $idAssesment = $_POST['idAssesment'];
    $idResep = $a_no;

    $detail_obat = mysqli_query($kon, "SELECT idObat, jumlahObat FROM detail_obat WHERE idAssesment = '$idAssesment'");
    while ($dt = mysqli_fetch_assoc($detail_obat)) {
        $idObat = $dt['idObat'];
        $jumlah = $dt['jumlahObat'];
        
        // Update the stokObat for the current idObat
        $update_obat = mysqli_query($kon, "UPDATE obat SET stokObat = stokObat - '$jumlah' WHERE idObat = '$idObat'");
        
        if (!$update_obat) {
            echo "Error updating stokObat for idObat $idObat: " . mysqli_error($kon);
            exit();
        }
    }

    $proses = mysqli_query($kon, "INSERT INTO resep (idAssesment, idResep, statusResep) VALUES ('$idAssesment', '$idResep', 'undone')");
    if ($proses) {
    $_SESSION['pesan'] = '
    <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
        <b>Berhasil!</b> Data berhasil diubah
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>
    ';
    header('location: ../../index.php?assesmentTindakan');
    } else {
        $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Data gagal diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
        header('location: ../../index.php?assesmentTindakan');
    }
?>