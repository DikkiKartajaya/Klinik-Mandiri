<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$idPasien = $_POST['idPasien'];
$tb = $_POST['tb'];
$bb = $_POST['bb'];
$suhu = $_POST['suhu'];
$tekananDarah = $_POST['tekananDarah'];
$diagnosa = $_POST['diagnosa'];
$keterangan = $_POST['keterangan'];

// menambah id pasien sesuai format
$query_ass = mysqli_query($kon, "SELECT count(idAssesment) as total FROM assesment");
$idass = mysqli_fetch_assoc($query_ass);
$no_ass = $idass['total'] + 1;
$a_no = 'ASM' . date('Ymd') . str_pad($no_ass, 1, '0', STR_PAD_LEFT);

//eksekusi query
$sql = "INSERT INTO assesment (idAssesment, idPasien, tanggalKunjungan, tinggiBadan, beratBadan, Suhu, tekananDarah, diagnosa, keterangan) VALUES ('$a_no','$idPasien', CURDATE(), '$tb', '$bb', '$suhu', '$tekananDarah', '$diagnosa', '$keterangan')";
$sql = mysqli_query($kon, $sql);

if ($sql) {
        $_SESSION['pesan'] = '
        <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
            <b>Berhasil!</b> Data berhasil ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        ';
        header('location:../../index.php?assesmentObat');
} else {
    $_SESSION['pesan'] = '
        <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
            <b>Gagal!</b> Data gagal ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
    ';
    header('location:../../index.php?daftarPasien');
    echo ($sql);
}

?>
