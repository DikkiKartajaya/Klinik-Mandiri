<?php  
// fungsi untuk membuat format rupiah
function rupiah($angka) {
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
}

?>
<div class="content-wrapper">
	<br>
<div class="container">
<?php
// Cek apakah ada session 'pesan'
if (isset($_SESSION['pesan'])) {
	$tindakanData = $_SESSION['pesan'];
    // Hapus session setelah digunakan
    unset($_SESSION['pesan']);
    ?>
    <script>
        // Tampilkan SweetAlert jika session ada
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: `<strong><?= $tindakanData ?></strong>`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    </script>
    <?php
}
?>
	<div class="card">
		<div class="card-header text-center" id="tableTitle">
			<strong>Data Tindakan</strong>
		</div>
		<!-- INI TABLE -->
		<div class="card-body">
			<a href="index.php?tambahTindakan"><button class="btn btn-success btn-sm mb-3">Tambah Data</button></a>
			<table class="table table-bordered table-hover table-striped" id="initabel">
				<thead>
					<tr>
						<th>No</th>
						<th>Id Tindakan</th>
						<th>Nama Tindakan</th>
						<th>Biaya Tindakan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<!-- mengambil data dari database -->
					<?php
					$i = 1;
					$sql = mysqli_query($kon, "SELECT * FROM tindakan");
					while ($data = mysqli_fetch_array($sql)) :?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['idTindakan'] ?></td>
						<td><?= $data['namaTindakan'] ?></td>
						<td> Rp. <?= rupiah($data['biayaTindakan']) ?></td>

						<td>
								<a href="index.php?ubahTindakan=<?= $data['idTindakan'] ?>" class="btn btn-warning btn-sm text-small" ><i class="fas fa-edit"></i></a>
								<!-- <a href="Logic/dokter/hapusTindakan.php?idTindakan=<?= $data['idTindakan']; ?>"  class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a> -->
								
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<script>
</script>