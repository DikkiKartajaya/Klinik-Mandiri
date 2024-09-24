<?php  
// fungsi untuk membuat format rupiah
function rupiah($angka) {
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
}

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
        <br>
    <div class="container">
    <?php
// Cek apakah ada session 'pesan'
if (isset($_SESSION['pesan'])) {
	$resepData = $_SESSION['pesan'];
    // Hapus session setelah digunakan
    unset($_SESSION['pesan']);
    ?>
    <script>
        // Tampilkan SweetAlert jika session ada
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: `<strong><?= $resepData ?></strong>`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    </script>
    <?php
}
?>
            <div class="card mt-3">
                <div class="card-header" id="tableTitle">
                    Daftar Resep
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped" id="initabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Resep</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                                <th>Pengobatan</th>
                                <th>Tindakan</th>
                                <th>Total</th>
                                <?php if ($jabatan == "Apoteker" || $jabatan == "Super Admin") : ?>
                                <th>Resep Selesai</th>
                                <?php endif; ?>
                                <th>Print Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $assesment = mysqli_query($kon, "SELECT resep.*, assesment.idAssesment, assesment.tanggalKunjungan ,assesment.idPasien, pasien.namaPasien FROM resep INNER JOIN assesment ON resep.idAssesment = assesment.idAssesment INNER JOIN pasien ON assesment.idPasien = pasien.idPasien WHERE statusResep = 'undone' ORDER BY assesment.tanggalKunjungan DESC;");
                            while ($data = mysqli_fetch_array($assesment)) 
                            :
                            $qtotal_byt = mysqli_query($kon, "SELECT SUM(totalHargaTindakan) as total_byt FROM detail_tindakan");
                            $total_byt = mysqli_fetch_assoc($qtotal_byt);
                            
                            $qtotal_byo = mysqli_query($kon, "SELECT SUM(totalHargaObat) as total_byo FROM detail_obat");
                            $total_byo = mysqli_fetch_assoc($qtotal_byo);
                            $totalTagihan = $total_byt['total_byt'] + $total_byo['total_byo'];
                            $idPasien = $data['idPasien'];
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $data['tanggalKunjungan'] ?></td>
                                <td><?= $data['namaPasien'] ?></td>
                                <td>
                                    <?php
                                    $status = $data['statusResep'];
                                    if ($status == 'undone') {
                                        echo '<div class="alert alert-danger" role="alert">BELUM SELESAI</div>';
                                    } else {
                                        echo '<div class="alert alert-success" role="alert">SELESAI</div>';
                                    }
                                    ?>
						        </td>
                                <td><button type="button" title="Detail Obat" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailObat_<?= $data['idAssesment'] ?>"><i class="fas fa-eye"></i></button></td>
                                <td><button type="button" title="Detail Tindakan" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailTindakan<?= $data['idAssesment'] ?>"><i class="fas fa-eye"></i></button></td>
                                <td>RP <?= rupiah($totalTagihan) ?></td>
                                <?php if ($jabatan == "Apoteker" || $jabatan == "Super Admin") : ?>
                                <td><a href="Logic/apoteker/resepSelesai.php?idAssesment=<?= $data['idAssesment'] ?>" class="btn btn-warning btn-sm text-small" onclick="confirmDone('<?= $data['namaPasien'] ?>', this); return false;"><i class="fas fa-check"></i></a>
                                </td>
                                <?php endif; ?>
                                <td><a href="index.php?nota=<?= $data['idAssesment'] ?>" class="btn btn-success btn-sm text-small" ><i class="fas fa-print"></i></a></td>
                            </tr>
				        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="card mt-3">
                <div class="card-header" id="tableTitle">
                    Daftar Resep Selesai
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover table-striped" id="initabel2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Resep</th>
                                <th>Nama Pasien</th>
                                <th>Status</th>
                                <th>Pengobatan</th>
                                <th>Tindakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $assesment = mysqli_query($kon, "SELECT resep.*, assesment.idAssesment, assesment.tanggalKunjungan ,assesment.idPasien, pasien.namaPasien FROM resep INNER JOIN assesment ON resep.idAssesment = assesment.idAssesment INNER JOIN pasien ON assesment.idPasien = pasien.idPasien WHERE statusResep = 'done' ORDER BY assesment.tanggalKunjungan DESC;");
                            while ($data = mysqli_fetch_array($assesment)) 
                            :
                            $idPasien = $data['idPasien'];
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $data['tanggalKunjungan'] ?></td>
                                <td><?= $data['namaPasien'] ?></td>
                                <td>
                                    <?php
                                    $status = $data['statusResep'];
                                    if ($status == 'undone') {
                                        echo '<div class="alert alert-danger" role="alert">UnDone</div>';
                                    } else {
                                        echo '<div class="alert alert-success" role="alert">Done</div>';
                                    }
                                    ?>
						        </td>
                                <td><button type="button" title="Detail Obat" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailObat_<?= $data['idAssesment'] ?>"><i class="fas fa-eye"></i></button></td>

                                <td><button type="button" title="Detail Tindakan" class="btn btn-sm btn-secondary text-small text-white" data-toggle="modal" data-target="#detailTindakan<?= $data['idAssesment'] ?>"><i class="fas fa-eye"></i></button></td>
                                <td><a href="index.php?nota=<?= $a_no ?>" class="btn btn-success btn-sm text-small" ><i class="fas fa-print"></i></a></td>
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
$assesment = mysqli_query($kon, "SELECT * FROM assesment ORDER BY tanggalKunjungan DESC");

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
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah(Strip/Botol/Pcs)</th>
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
                <td><?= $obat['jumlahObat'] ?></td>
                <td><?= $obat['dosisObat'] ?></td>
                <td><?= $obat['keteranganObat'] ?></td>
            </tr>
            <?php $i++; endwhile; ?>
            </tbody>
        </table>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Tindakan -->
<div class="modal fade" id="detailTindakan<?= $data['idAssesment'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailTindakanLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
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
                <td><?= $obat['jumlahTindakan'] ?></td>
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
<!-- SCRIPT SWEETALERT -->
<script>
	function confirmDone(resepData, button) {
		Swal.fire({
			icon: "warning",
			title: "Apakah Kamu yakin?",
			html: `Yakin Resep Untuk <strong>${resepData}</strong> Sudah Selesai?`,
			showCancelButton: true,
			confirmButtonText: "Selesai",
			cancelButtonText: "Batal",
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			reverseButtons: true,
		}).then((result) => {
			if (result.isConfirmed) {
				// Menampilkan pesan sukses
				// Swal.fire("Deleted!", `${userData} telah dihapus.`, "pesan");
				
				// Menunda eksekusi URL (penghapusan data) dengan sedikit delay
				setTimeout(() => {
					// Redirect ke URL penghapusan
					window.location.href = button.getAttribute('href');
				}, 1000); // Delay 1 detik
			}
		});
	}
</script>