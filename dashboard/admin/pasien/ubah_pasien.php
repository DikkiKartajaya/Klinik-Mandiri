<?php
$id = $_GET['ubahPasien'];
$query = "SELECT * FROM pasien WHERE idPasien='$id'";
$sql = mysqli_query($kon, $query);
$data = mysqli_fetch_array($sql);
?>
<div class="content-wrapper">
	<br>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
		  		<div class="card-header">
		  			<strong>Ubah Pasien</strong>
		  		</div>
			  	<div class="card-body">
				  <div class="row">
				  <div class="col-lg-6">
			  		<form action="Logic/pasien/ubahPasien.php?idPasien=<?= $data['idPasien'] ?>" method="post" enctype="multipart/form-data">
					  <div class="form-group">
				  			<label class="form-label" for="namaPasien">ID Pasien</label>
				  			<input type="text" class="form-control" id="idPasien" name="idPasien" value="<?= $data['idPasien'] ?>" disabled>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="namaPasien">Nama Pasien</label>
				  			<input type="text" class="form-control" id="namaPasien" name="namaPasien" value="<?= $data['namaPasien'] ?>" required>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="lahirPasien">Tanggal Lahir Pasien</label>
				  			<input type="date" class="form-control" id="lahirPasien" name="lahirPasien" value="<?= $data['lahirPasien'] ?>" required>
				  		</div>
						  <div class="form-group">
				  			<label class="form-label" for="namaWali">Nama Wali Pasien</label>
				  			<input type="text" class="form-control" id="namaWali" name="namaWali" value="<?= $data['namaWali'] ?>" required>
				  		</div>
						
						
						  </div>
					<div class="col-lg-6">
					<div class="form-group">
				  			<label class="form-label" for="jkPasien">Jenis Kelamin</label>
				  			<select name="jkPasien" id="jkPasien" class="form-control">
                              <?php  
									if ($data['jkPasien']=="Laki-laki") {
										$l = "Selected";
									} elseif ($data['jkPasien']=="Perempuan") {
										$p = "Selected";
									}
								?>
				  				<option value="Laki-laki" <?= $l; ?>>Laki-laki</option>
				  				<option value="Perempuan" <?= $p; ?>>Perempuan</option>
				  			</select>
				  		</div>
					</div>
				</div>
						<div class="form-group">
				  			<label class="form-label" for="alamat">Alamat</label>
				  			<textarea class="form-control" id="alamat" name="alamat" row="3" required><?= $data['alamat'] ?></textarea>
				  		</div>
						<div class="text-right">
							<button type="submit" class="btn btn-primary right-place">Submit</button>
							<button type="button" class="btn btn-danger" onclick="history.back()">Kembali</button>
						</div>
			  		</form>
			  	</div>
			</div>
			</div>
		</div>
	</div>
</div>
</div>