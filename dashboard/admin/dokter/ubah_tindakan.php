<?php
$idTindakan = $_GET['ubahTindakan'];
$query = "SELECT * FROM tindakan WHERE idTindakan='$idTindakan'";
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
		  			<strong>Ubah Tindakan</strong>
		  		</div>
			  	<div class="card-body">
				  <div class="row">
				  <div class="col-lg-6">
			  		<form action="Logic/dokter/ubahTindakan.php?idTindakan=<?= $data['idTindakan'] ?>" method="post" enctype="multipart/form-data">
					  <div class="form-group">
				  			<label class="form-label" for="namaTindakan">Nama Tindakan</label>
				  			<input type="text" class="form-control" id="namaTindakan" name="namaTindakan" value="<?= $data['namaTindakan'] ?>" required >
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="biayaTindakan">Biaya Tindakan</label>
				  			<input type="text" class="form-control" id="biayaTindakan" name="biayaTindakan" value="<?= $data['biayaTindakan'] ?>" required>
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
</div>