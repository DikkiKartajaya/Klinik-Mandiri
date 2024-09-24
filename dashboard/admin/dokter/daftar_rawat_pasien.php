<div class="content-wrapper">
	<br>
<div class="container">
<?php
// Cek apakah ada session 'pesan'
if (isset($_SESSION['pesan'])) {
	$daftarData = $_SESSION['pesan'];
    // Hapus session setelah digunakan
    unset($_SESSION['pesan']);
    ?>
    <script>
        // Tampilkan SweetAlert jika session ada
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: `<strong><?= $daftarData ?></strong>`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    </script>
    <?php
}
?>
	<div class="card">
		<div class="card-header" id="tableTitle">
			Data Rawat Pasien
		</div>
		<!-- INI TABLE -->
		<div class="card-body">
			<table class="table table-bordered table-hover table-striped" id="initabel">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Pasien</th>
						<th>Nama Pasien</th>
						<th>Jenis Kelamin</th>
						<th>Usia</th>
						<th>Tanggal Kunjungan</th>
						<th>Status</th>
						<?php if ($jabatan == "Dokter" || $jabatan == "Super Admin") : ?>
						<th>Assesment</th>
						<?php endif; ?>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<!-- mengambil data dari database -->
					<?php
					$i = 1;
					$sql = mysqli_query($kon, "SELECT daftarrawat.idDaftarRawat, daftarrawat.statusRawat, daftarrawat.tanggalKunjungan, pasien.idPasien, pasien.namaPasien, pasien.lahirPasien, pasien.jkPasien FROM pasien INNER JOIN daftarrawat ON pasien.idPasien = daftarrawat.idPasien WHERE daftarrawat.statusRawat = 'uncared';");
					while ($data = mysqli_fetch_array($sql)): 
						$usia = mysqli_query($kon, "SELECT TIMESTAMPDIFF(YEAR, lahirPasien, CURDATE()) AS tahun, TIMESTAMPDIFF(MONTH, lahirPasien, CURDATE()) % 12 AS bulan FROM pasien WHERE idPasien = '" . $data['idPasien'] . "'");
                        $usia_data = mysqli_fetch_assoc($usia);?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['idPasien'] ?></td>
						<td><?= $data['namaPasien'] ?></td>
						<td><?= $data['jkPasien'] ?></td>
                        <td><?= $usia_data['tahun'] . ' tahun ' . $usia_data['bulan'] . ' bulan'; ?></td>
						<td><?= $data['tanggalKunjungan'] ?></td>
						<td>
							<?php
							$status = $data['statusRawat'];
							if ($status == 'uncared') {
								echo '<div class="alert alert-danger" role="alert">BELUM DIPERIKSA</div>';
							} else {
								echo '<div class="alert alert-success" role="alert">SELESAI</div>';
							}
							?>
						</td>
						<?php if ($jabatan == "Dokter" || $jabatan == "Super Admin") : ?>
						<td><a href="index.php?assesment=<?= $data['idPasien'] ?>" class="btn btn-primary btn-sm text-small" >Lakukan Assesment <i class="fas fa-arrow-right"></i></a></td>
						<?php endif; ?>
						<td>		
								<a href="Logic/dokter/hapusRawat.php?idPasien=<?= $data['idPasien']; ?>"  class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
								
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="container mt-3">
<div class="card">
		<div class="card-header" id="tableTitle">
			Data pasien Terawat Tanggal <?= date('d F Y') ?>
		</div>
		<!-- INI TABLE -->
		<div class="card-body">
			<table class="table table-bordered table-hover table-striped" id="initabel2">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Pasien</th>
						<th>Nama Pasien</th>
						<th>Jenis Kelamin</th>
						<th>Usia</th>
						<th>Tanggal Kunjungan</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<!-- mengambil data dari database -->
					<?php
					$i = 1;
					$sql = mysqli_query($kon, "SELECT daftarrawat.idDaftarRawat, daftarrawat.statusRawat, daftarrawat.tanggalKunjungan, pasien.idPasien, pasien.namaPasien, pasien.lahirPasien, pasien.jkPasien FROM pasien INNER JOIN daftarrawat ON pasien.idPasien = daftarrawat.idPasien WHERE daftarrawat.statusRawat = 'cared' AND DATE(daftarrawat.tanggalKunjungan) = CURDATE();");
					while ($data = mysqli_fetch_array($sql)): 
						$usia = mysqli_query($kon, "SELECT TIMESTAMPDIFF(YEAR, lahirPasien, CURDATE()) AS tahun, TIMESTAMPDIFF(MONTH, lahirPasien, CURDATE()) % 12 AS bulan FROM pasien WHERE idPasien = '" . $data['idPasien'] . "'");
                        $usia_data = mysqli_fetch_assoc($usia);?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['idPasien'] ?></td>
						<td><?= $data['namaPasien'] ?></td>
						<td><?= $data['jkPasien'] ?></td>
                        <td><?= $usia_data['tahun'] . ' tahun ' . $usia_data['bulan'] . ' bulan'; ?></td>
						<td><?= $data['tanggalKunjungan'] ?></td>
						<td>
							<?php
							$status = $data['statusRawat'];
							if ($status == 'uncared') {
								echo '<div class="alert alert-danger" role="alert">BELUM DI PERIKSA</div>';
							} else {
								echo '<div class="alert alert-success" role="alert">SELESAI</div>';
							}
							?>
						</td>
						<td>		
								<a href="Logic/pasien/hapusPasien.php?idPasien=<?= $data['idPasien']; ?>"  class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
								
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>