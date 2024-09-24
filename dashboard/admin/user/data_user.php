<div class="content-wrapper">
	<br>
<div class="container">
<?php
// Cek apakah ada session 'pesan'
if (isset($_SESSION['pesan'])) {
	$userData = $_SESSION['pesan'];
    // Hapus session setelah digunakan
    unset($_SESSION['pesan']);
    ?>
    <script>
        // Tampilkan SweetAlert jika session ada
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: `<strong><?= $userData ?></strong>`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    </script>
    <?php
}
?>
	<div class="card">
		<div class="card-header text-center" id="tableTitle">
			<strong>Data User</strong>
		</div>
		<!-- INI TABLE -->
		<div class="card-body">
			<a href="index.php?tambahUser"><button class="btn btn-success btn-sm mb-3">Tambah Data</button></a>
			<table class="table table-bordered table-hover table-striped" id="initabel">
				<thead>
					<tr>
						<th>No</th>
						<th>Id User</th>
						<th>Nama User</th>
						<th>Username</th>
						<th>Jabatan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<!-- mengambil data dari database -->
					<?php
					$i = 1;
					$sql = mysqli_query($kon, "SELECT * FROM user");
					while ($data = mysqli_fetch_array($sql)) :?>
					<tr>
						<td><?= $i++; ?></td>
						<td><?= $data['idUser'] ?></td>
						<td><?= $data['namaUser'] ?></td>
						<td><?= $data['username'] ?></td>
						<td><?= $data['jabatan'] ?></td>

						<td>
								<a href="index.php?ubahUser=<?= $data['idUser'] ?>" class="btn btn-warning btn-sm text-small" ><i class="fas fa-edit"></i></a>
								<a href="Logic/user/hapusUser.php?idUser=<?= $data['idUser']; ?>"  class="btn btn-danger btn-sm text-small" onclick="confirmDelete('<?= $data['namaUser'] ?> - <?= $data['jabatan'] ?>', this); return false;"><i class="fas fa-trash"></i>
								</a>
								
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<!-- SCRIPT SWEETALERT -->
<script>
	function confirmDelete(userData, button) {
		Swal.fire({
			icon: "warning",
			title: "Apakah Kamu yakin?",
			html: `Ingin Menghapus <strong>${userData}</strong>`,
			showCancelButton: true,
			confirmButtonText: "Setuju",
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