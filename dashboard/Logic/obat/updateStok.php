<?php  
session_start();
include '../../../koneksi.php';

// ambil data dari form
$idObat = $_GET['idObat'];
$namaObat = $_POST['namaObat'];
$Stok = $_POST['Stok'];
$hargaBeli = $_POST['hargaBeliObat'];
$foto = $_FILES['notaPembelian']['name'];
$tmp = $_FILES['notaPembelian']['tmp_name'];
// set nama dan direktori/penyimpanan foto
$fotobaru = date('dmYHis') . $foto;
$path = "../../../asset/notaObat/" . $fotobaru;

// menambah id pasien sesuai format
$query_idp = mysqli_query($kon, "SELECT count(idHistory) as total FROM historyObat");
$idhis = mysqli_fetch_assoc($query_idp);
$no_his = $idhis['total'] + 1;
$a_no = 'HST' . str_pad($no_his, 4, '0', STR_PAD_LEFT);


// cek jika foto berhasil diupload
if (move_uploaded_file($tmp, $path)) {
    //eksekusi query
    $sql = "INSERT INTO historyObat (idHistory, idObat,tanggalUpdate, Stok, hargaBeli, foto) VALUES ('$a_no', '$idObat', CURDATE(), $Stok ,$hargaBeli ,'$fotobaru')";
    $sql2 = "UPDATE obat SET stokObat = stokObat + $Stok WHERE idObat = '$idObat'";
    $result = mysqli_query($kon, $sql);
    $result2 = mysqli_query($kon, $sql2);

    if ($result && $result2) {
        $_SESSION['pesan'] = '
            <b>Berhasil!</b> Stok Obat Berhasil Ditambahkan
        ';
        header('location:../../index.php?obat');
    } else {
        $_SESSION['pesan'] = '
            <b>Gagal!</b> Data gagal ditambahkan
        ';
        header('location:../../index.php?obat');
    }
} else {
    $_SESSION['pesan'] = '
        <b>Gagal!</b> Foto gagal diupload
    ';
    header('location:../../index.php?obat');
}
?>
