<?php  
// fungsi untuk membuat format rupiah
function rupiah($angka) {
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
}

?>
<div class="content-wrapper">
    <div class="container mt-3">
    <div class="card mt-3">
                <div class="card-header" id="tableTitle">
                    Daftar Penghasilan
                </div>
                
                <div class="card-body">
                    <table border="0" cellspacing="5" cellpadding="5">
                <tbody><tr>
                    <td>Minimum date:</td>
                    <td><input type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Maximum date:</td>
                    <td><input type="text" id="max" name="max"></td>
                </tr>
            </tbody></table>
                    <table class="table table-bordered table-hover table-striped" id="initabel3">
                        <thead>
                            <tr> 
                                <th>No</th>
                                <th>Tanggal Kunjungan</th>
                                <th>No Assesment</th>
                                <th>Nama Pasien</th>
                                <th>Total Harga Obat</th>
                                <th>Total Harga Tindakan</th>
                                <th>Total Bayar</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        $qassesment = mysqli_query($kon, "SELECT * FROM assesment ORDER BY tanggalKunjungan DESC");
                        $assesment = mysqli_fetch_assoc($qassesment);
                        $tanggalKunjunganTimestamp = strtotime($assesment['tanggalKunjungan']); 
                        foreach ($qassesment as $row) :
                            $qpasien =  mysqli_query($kon, "SELECT * FROM pasien WHERE idPasien = '$row[idPasien]'");
                            $pasien = mysqli_fetch_assoc($qpasien);

                            $qdetail_obat =  mysqli_query($kon, "SELECT * FROM detail_obat WHERE idAssesment = '$row[idAssesment]'");
                            $detail_obat = mysqli_fetch_assoc($qdetail_obat);
                            $qtotal_byo = mysqli_query($kon, "SELECT SUM(totalHargaObat) as total_byo FROM detail_obat WHERE idAssesment = '$row[idAssesment]'");
                            $total_byo = mysqli_fetch_assoc($qtotal_byo); 

                            $qtotal_byt = mysqli_query($kon, "SELECT SUM(totalHargaTindakan) as total_byt FROM detail_tindakan WHERE idAssesment = '$row[idAssesment]'");
                            $total_byt = mysqli_fetch_assoc($qtotal_byt);?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td> <?= $row['tanggalKunjungan'] ?></td>
                                <td><?= $row['idAssesment'] ?></td>
                                <td><?= $pasien['namaPasien'] ?></td>
                                <td><?= rupiah($total_byo['total_byo']) ?></td>
                                <td><?= rupiah($total_byt['total_byt']) ?></td>
                                <td><?= rupiah($total_byo['total_byo'] + $total_byt['total_byt']) ?></td>
                                <td>
                                <a href="Logic/apoteker/printNota.php?idAssesment=<?= $row['idAssesment'] ?>" target="_blank" class="btn btn-success btn-sm text-small" ><i class="fas fa-print"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
    </div>
</div>

