<?php
    
    $query_ass = mysqli_query($kon, "SELECT COUNT(idAssesment) AS total FROM assesment");
    $idass = mysqli_fetch_assoc($query_ass);
    $no_ass = $idass['total'];
    $a_no = 'ASM' . date('Ymd') . str_pad($no_ass, 1, '0', STR_PAD_LEFT);

    if (isset($_POST['tambah'])) {

        $idAssesment = $a_no;
        $idTindakan = $_POST['idTindakan'];
        $jumlah = $_POST['jumlah'];

        // Mendapatkan harga tindakan
        $sharga = mysqli_query($kon, "SELECT * FROM tindakan WHERE idTindakan = '$idTindakan'");
        $dharga = mysqli_fetch_array($sharga);
        $harga = $dharga['biayaTindakan'];

        $total = $harga * $jumlah;

        // Cek detail
        $scek = mysqli_query($kon, "SELECT * FROM detail_tindakan WHERE idAssesment = '$idAssesment' AND idTindakan = '$idTindakan'");
        $hcek = mysqli_num_rows($scek);

        if ($hcek > 0) {
            $dcek = mysqli_fetch_array($scek);
            $newqty = $jumlah + $dcek['jumlahTindakan'];
            $proses = mysqli_query($kon,"UPDATE detail_tindakan SET jumlahTindakan = '$newqty' WHERE idAssesment = '$idAssesment' AND idTindakan = '$idTindakan'");

        } else {
            $proses = mysqli_query($kon, "INSERT INTO detail_tindakan (idAssesment, idTindakan, jumlahTindakan, totalHargaTindakan) VALUES ('$idAssesment', '$idTindakan', '$jumlah', '$total')");
            echo ($proses);
        }

        if ($proses) {
            header("Location: index.php?assesmentTindakan");
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }

    } else if (isset($_POST['hapusdetail'])) {
        $idDt = $_POST['idDt'];
        $proses = mysqli_query($kon, "DELETE FROM detail_tindakan WHERE idDt = '$idDt'");
        if ($proses) {
            $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil dihapus
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
        header('location: index.php?assesmentTindakan');
        } else {
            $_SESSION['pesan'] = '
                <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                    <b>Gagal!</b> Data gagal dihapus
                    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
            header('location:index.php?assesmentTindakan');
        }}
?>
<div class="content-wrapper">
    <div class="container mt-3">
        <?php if (isset($_SESSION['pesan'])) : ?>
            <?= $_SESSION['pesan'] ?>
            <?php unset($_SESSION['pesan']); endif; ?>
        <div class="card">
            <div class="card-header">
                Tindakan
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered table-hover table-striped" id="Ttindakan">
                            <thead>
                                <tr> 
                                    <th>No</th>
                                    <th>Nama Tindakan</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

   
                                $nodetail = 1;
                                $sdetail = mysqli_query($kon,"SELECT detail_tindakan.*, tindakan.namaTindakan FROM detail_tindakan, tindakan WHERE detail_tindakan.idTindakan = tindakan.idTindakan AND detail_tindakan.idAssesment = '$a_no'");
                                while ($ddetail = mysqli_fetch_array($sdetail)) {
                                    echo "
                                        <tr>
                                            <td class='text-center'>".$nodetail.".</td>
                                            <td>".$ddetail['namaTindakan']."</td>
                                            <td>".$ddetail['jumlahTindakan']."</td>
                                            <td class='text-center'>
                                                <form method='post' class='btn-group'>
                                                    <input type='hidden' name='idDt' value='".$ddetail['idDt']."'>
                                                    <button type='submit' name='hapusdetail' class='btn btn-danger btn-sm'>Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    ";
                                    $nodetail++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <form method="POST">
                        <input type="hidden" name="idAssesment" value="<?= $a_no ?>">
                            <div class="form-group">
                                <label for="idTindakan">Tindakan</label>
                                <select class="form-control" id="idTindakan" name="idTindakan" >
                                    <?php
                                    $tindakan_query = mysqli_query($kon, "SELECT * FROM tindakan");
                                    while ($tindakan = mysqli_fetch_assoc($tindakan_query)) {
                                        echo '<option value="'.$tindakan['idTindakan'].'">'.$tindakan['namaTindakan'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah"  class="form-control" placeholder="" required>
                            </div>
                            <button class="btn btn-primary " type ="submit" name="tambah">Tambah</button>
                            <br>
                        </form>
                        <a href="index.php?suratRujukan=<?= $a_no ?>" target="_blank" class="btn btn-secondary text-white btn-sm text-large"> Print Rujukan <i class="fas fa-print"></i></a>
                        <a href="index.php?suratSakit=<?= $a_no ?>" target="_blank" class="btn btn-secondary text-white btn-sm text-large"> Print Keterangan Sakit <i class="fas fa-print"></i></a>
                        <form action="Logic/assesment/selesaiTindakan.php" method="POST">
                        <input type="hidden" name="idAssesment" value="<?= $a_no ?>">
                        <button type="submit" class="btn btn-warning btn-block mt-3" name="selesaikan">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
