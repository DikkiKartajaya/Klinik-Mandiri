<div class="content-wrapper">
	<br>
	<div class="container">
<?php
// Cek apakah ada session 'pesan'
if (isset($_SESSION['pesan'])) {
	$pasienData = $_SESSION['pesan'];
    // Hapus session setelah digunakan
    unset($_SESSION['pesan']);
    ?>
    <script>
        // Tampilkan SweetAlert jika session ada
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: `<strong><?= $pasienData ?></strong>`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    </script>
    <?php
}
?>
		<div class="card">
			<div class="card-header" id="tableTitle">
				Data Pasien
			</div>
			<!-- INI TABLE -->
			<div class="card-body">
				<a href="index.php?tambahPasien"><button class="btn btn-success btn-sm mb-3">Tambah Data</button></a>
				<table class="table table-bordered table-hover table-striped" id="initabel">
					<thead>
						<tr>
							<th>Tanggal Daftar</th>
							<th>No</th>
							<th>Id Pasien</th>
							<th>Nama Pasien</th>
							<th>Jenis Kelamin</th>
							<th>Usia</th>
							<th>Nama Wali</th>
							<th>Alamat</th>
							<th>Aksi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- mengambil data dari database -->
						<?php
						$i = 1;
						$sql = mysqli_query($kon, "SELECT *, TIMESTAMPDIFF(YEAR, lahirPasien, CURDATE()) AS tahun, TIMESTAMPDIFF(MONTH, lahirPasien, CURDATE()) % 12 AS bulan FROM pasien ORDER BY tanggalDaftar DESC");
						while ($data = mysqli_fetch_array($sql)) : ?>
						<tr>
							<td><?= $data['tanggalDaftar'] ?></td>
							<td><?= $i++; ?></td>
							<td><?= $data['idPasien'] ?></td>
							<td><?= $data['namaPasien'] ?></td>
							<td><?= $data['jkPasien'] ?></td>
							<td><?= $data['tahun'] . ' tahun ' . $data['bulan'] . ' bulan'; ?></td>
							<td><?= $data['namaWali'] ?></td>
							<td><?= $data['alamat'] ?></td>
							<td>
                                    <form method="POST" action="Logic/dokter/daftarPasien.php" style="display:inline;">
                                        <input type="hidden" name="idPasien" value="<?= $data['idPasien']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm text-small" style="margin: 5px;">Daftarkan <i class="fas fa-arrow-right"></i></button>
                                    </form>
                                    <a href="Logic/pasien/kartuPasien.php?idPasien=<?= $data['idPasien']; ?>" class="btn btn-info btn-sm text-small" style="margin: 5px;"target="_blank">Kartu Pasien <i class="fas fa-print"></i></a>
                                    <a href="index.php?rekamMedis=<?= $data['idPasien'] ?>" class="btn btn-success btn-sm text-small" style="margin: 5px;">Rekam Medis <i class="fas fa-archive"></i></a>
                                </td>
								<td>
								<a href="index.php?ubahPasien=<?= $data['idPasien'] ?>" class="btn btn-warning btn-sm text-small" style="margin: 5px;)"><i class="fas fa-edit"></i></a></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

