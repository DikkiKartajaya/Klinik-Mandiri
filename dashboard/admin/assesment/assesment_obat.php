<?php
    
    $query_ass = mysqli_query($kon, "SELECT COUNT(idAssesment) AS total FROM assesment");
    $idass = mysqli_fetch_assoc($query_ass);
    $no_ass = $idass['total'];
    $a_no = 'ASM' . date('Ymd') . str_pad($no_ass, 1, '0', STR_PAD_LEFT);

   
    if (isset($_POST['tambah'])) {

        $idAssesment = $a_no;
        $idObat = $_POST['obatSelect'];
        $jumlah = $_POST['jumlah'];
        $dosis = $_POST['dosis'];
        $keterangan = $_POST['keterangan'];

        // Mendapatkan harga obat dan stok
        $dobat = mysqli_query($kon, "SELECT * FROM obat WHERE idObat = '$idObat'");
        $obat = mysqli_fetch_array($dobat);
        $harga = $obat['hargaObat'];
        $stok = $obat['stokObat'];
        $total = $harga * $jumlah;

        // Cek detail
        $scek = mysqli_query($kon, "SELECT * FROM detail_obat WHERE idAssesment = '$idAssesment' AND idObat = '$idObat'");
        $hcek = mysqli_num_rows($scek);

        if ($stok < 5){
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Stok Obat Habis
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';  header('location: index.php?assesmentObat');
        }
        elseif ($stok < $jumlah){
            $_SESSION['pesan'] = '
            <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                <b>Gagal!</b> Stok Obat Kurang
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';  header('location: index.php?assesmentObat');
        
        } elseif ($hcek > 0) {
            $dcek = mysqli_fetch_array($scek);
            $newqty = $jumlah + $dcek['jumlahObat'];
            $proses = mysqli_query($kon,"UPDATE detail_obat SET jumlahObat = '$newqty' WHERE idAssesment = '$idAssesment' AND idObat = '$idObat'");

        } else {
            $proses = mysqli_query($kon, "INSERT INTO detail_obat (idAssesment, idObat, jumlahObat, dosisObat, totalHargaObat, keteranganObat) VALUES ('$idAssesment', '$idObat', '$jumlah', '$dosis', '$total', '$keterangan')");
        }

        if ($proses) {
            header("Location: index.php?assesmentObat");
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }

    } else if (isset($_POST['hapusdetail'])) {
        $idDo = $_POST['idDo'];
        $proses = mysqli_query($kon, "DELETE FROM detail_obat WHERE idDo = '$idDo'");
        if ($proses) {
            $_SESSION['pesan'] = '
            <div class="alert alert-success mb-2 alert-dismissible text-small " role="alert">
                <b>Berhasil!</b> Data berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
        header('location: index.php?assesmentObat');
        } else {
            $_SESSION['pesan'] = '
                <div class="alert alert-danger mb-2 alert-dismissible text-small " role="alert">
                    <b>Gagal!</b> Data gagal diubah
                    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                </div>
            ';
            header('location:index.php?assesmentObat');
        }}
?>
<div class="content-wrapper">
    <div class="container mt-3">
        <?php if (isset($_SESSION['pesan'])) : ?>
            <?= $_SESSION['pesan'] ?>
            <?php unset($_SESSION['pesan']); endif; ?>
        <div class="card">
            <div class="card-header">
                Pengobatan
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered table-hover table-striped" id="pengobatan">
                            <thead>
                                <tr> 
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah (Strip/Botol/Pcs)</th>
                                    <th>Dosis (Per Hari)</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

   
                                $nodetail = 1;
                                $sdetail = mysqli_query($kon,"SELECT detail_obat.*, obat.namaObat FROM detail_obat, obat WHERE detail_obat.idObat = obat.idObat AND detail_obat.idAssesment = '$a_no'");
                                while ($ddetail = mysqli_fetch_array($sdetail)) {
                                    echo "
                                        <tr>
                                            <td class='text-center'>".$nodetail.".</td>
                                            <td>".$ddetail['namaObat']."</td>
                                            <td>".$ddetail['jumlahObat']."</td>
                                            <td>".$ddetail['dosisObat']."</td>
                                            <td>".$ddetail['keteranganObat']."</td>
                                            <td class='text-center'>
                                                <form method='post' class='btn-group'>
                                                    <input type='hidden' name='idDo' value='".$ddetail['idDo']."'>
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
                                <label for="obatSelect">Pengobatan</label>
                                <select class="form-control" id="obatSelect" name="obatSelect" >
                                    <?php
                                    $obat_query = mysqli_query($kon, "SELECT * FROM obat");
                                    while ($obat = mysqli_fetch_assoc($obat_query)) {
                                        echo '<option value="'.$obat['idObat'].'">'.$obat['namaObat'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" name="jumlah"  class="form-control" placeholder="Per Strip/Sachet/Botol" required>
                            </div>
                            <div class="form-group">
                                <label for="dosis">Dosis</label>
                                <input type="text" class="form-control" name="dosis" placeholder="Per Hari" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control"  name="keterangan" placeholder="" required>
                            </div>
                            <button class="btn btn-primary " type ="submit" name="tambah">Tambah</button>
                            <a href="Logic/assesment/printResep.php?idAssesment=<?= $a_no ?>" target="_blank" class="btn btn-secondary text-white btn-sm text-large p-2 ml-1">Print Resep <i class="fas fa-print"></i></a>
                            <br>
                        </form>
                        <form action="Logic/assesment/selesaiObat.php" method="POST">
                        <input type="hidden" name="idAssesment" value="<?= $a_no ?>">
                        <button type="submit" class="btn btn-warning btn-block mt-3" name="selesaikan">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
