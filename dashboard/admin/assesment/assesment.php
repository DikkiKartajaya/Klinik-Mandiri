<?php

$idPasien = $_GET['assesment'];
$query = "SELECT *, TIMESTAMPDIFF(YEAR, lahirPasien, CURDATE()) AS tahun, TIMESTAMPDIFF(MONTH, lahirPasien, CURDATE()) % 12 AS bulan FROM pasien WHERE idPasien='$idPasien'";
$sql = mysqli_query($kon, $query);
$data = mysqli_fetch_array($sql);
?>
<style>
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .form-row .form-group {
        flex: 1;
        min-width: 200px;
    }
    .form-row .form-group.full-width {
        flex: 100%;
    }
    .form-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    /* .card {
        padding: 1rem;
    } */
</style>
    <div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Assesment Pasien
            </div>

            <div class="card-body">
                <form action="Logic/assesment/tambahAssesment.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="idPasien">ID Pasien</label>
                            <input type="text" class="form-control" id="idPasien" name="idPasien" value="<?= $data['idPasien'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namaPasien">Nama Pasien</label>
                            <input type="text" class="form-control" id="namaPasien" name="namaPasien" value="<?= $data['namaPasien'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="usiaPasien">Usia</label>
                            <input type="text" class="form-control" id="usiaPasien" name="usiaPasien" value="<?= $data['tahun'] . ' tahun ' . $data['bulan'] . ' bulan'; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jkPasien">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jkPasien" name="jkPasien" value="<?= $data['jkPasien'] ?>" readonly>
                        </div>
                        <div class="form-group full-width">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-container">
                        <div>
                            <div class="form-group">
                                <label for="tb">Tinggi Badan</label>
                                <input type="number" class="form-control" id="tb" name="tb" placeholder="CentiMeter" required>
                            </div>
                            <div class="form-group">
                                <label for="bb">Berat Badan</label>
                                <input type="number" class="form-control" id="bb" name="bb" placeholder="Kilogram" required>
                            </div>
                            <div class="form-group">
                                <label for="suhu">Suhu</label>
                                <input type="number" class="form-control" id="suhu" name="suhu" placeholder="Celcius" required>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="diagnosa">Diagnosa</label>
                                <input type="text" class="form-control" id="diagnosa" name="diagnosa" placeholder="Diagnosa" required>
                            </div>
                            <div class="form-group">
                                <label for="tekananDarah">Tekanan Darah</label>
                                <input type="text" class="form-control" id="tekananDarah" name="tekananDarah" placeholder="mmHg" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" ></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button  class="btn btn-secondary">Details</button>
                </form>
            <div class="card mt-3">
                <div class="card-header">
                    Rekam Medis
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Diagnosa</th>
                                <th>Pengobatan</th>
                                <th>Tindakan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $sql = mysqli_query($kon, "SELECT * FROM assesment WHERE idPasien = '$idPasien' ORDER BY tanggalKunjungan DESC");
                            while ($data = mysqli_fetch_array($sql)) :?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $data['tanggalKunjungan'] ?></td>
                                <td><?= $data['diagnosa'] ?></td>
                                <td><button type="button" title="Detail Obat" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailObat_<?= $data['idAssesment'] ?>"><i class="fas fa-eye"></i></button></td>
                                <td><button type="button" title="Detail Tindakan" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailTindakan<?= $data['idAssesment'] ?>"><i class="fas fa-eye"></i></button></td>
                                <td><?= $data['keterangan'] ?></td>
                            </tr>
				        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                                </div>
                                </div>
    <br>
    <!-- Modals for Pengobatan and Tindakan -->
<?php
$assesment = mysqli_query($kon, "SELECT * FROM assesment WHERE idPasien = '$idPasien' ORDER BY tanggalKunjungan DESC");

while ($data = mysqli_fetch_array($assesment)) :
?>

<!-- Modal for Pengobatan -->
<div class="modal fade" id="detailObat_<?= $data['idAssesment'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailObatLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailObatLabel">Detail Pengobatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Dosis</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $idAssesment = $data['idAssesment'];
            $obatQuery = mysqli_query($kon, "SELECT detail_obat.*, obat.namaObat FROM detail_obat INNER JOIN obat ON detail_obat.idObat = obat.idObat WHERE detail_obat.idAssesment = '$idAssesment'");
            while ($obat = mysqli_fetch_array($obatQuery)) :
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $obat['namaObat'] ?></td>
                <td><?= $obat['jumlah'] ?></td>
                <td><?= $obat['dosisObat'] ?></td>
                <td><?= $obat['keterangan'] ?></td>
            </tr>
            <?php $i++; endwhile; ?>
            </tbody>
        </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Tindakan -->
<div class="modal fade" id="detailTindakan<?= $data['idAssesment'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailTindakanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTindakanLabel">Detail Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            $idAssesment = $data['idAssesment'];
            $obatQuery = mysqli_query($kon, "SELECT detail_tindakan.*, tindakan.namaTindakan FROM detail_tindakan INNER JOIN tindakan ON detail_tindakan.idTindakan = tindakan.idTindakan WHERE detail_tindakan.idAssesment = '$idAssesment'");
            while ($obat = mysqli_fetch_array($obatQuery)) :
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $obat['namaTindakan'] ?></td>
                <td><?= $obat['jumlah'] ?></td>
            </tr>
            <?php $i++; endwhile; ?>
            </tbody>
        </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>
</body>