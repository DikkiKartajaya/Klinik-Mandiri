<?php
$id = $_GET['suratSakit'];
$qassesment = "SELECT idPasien FROM assesment WHERE idAssesment='$id'";
$data = mysqli_query($kon, $qassesment);
$assesment = mysqli_fetch_array($data);

$idPasien = $assesment['idPasien'];
$qpasien = "SELECT * FROM pasien WHERE idPasien='$idPasien'";
$data = mysqli_query($kon, $qpasien);
$pasien = mysqli_fetch_array($data);
?>
<div class="content-wrapper">
	<br>
<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
		  		<div class="card-header">
		  			<strong>Surat Keterangan Sakit</strong>
		  		</div>
			  	<div class="card-body">
			  		<form action="Logic/assesment/printSakit.php?idPasien=<?= $idPasien ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
				  			<label class="form-label" for="idPasien">ID Pasien</label>
				  			<input type="text" class="form-control" id="idPasien" name="idPasien" value="<?= $idPasien ?>" disabled>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="namaPasien">Nama Pasien</label>
				  			<input type="text" class="form-control" id="namaPasien" name="namaPasien" value="<?= $pasien["namaPasien"] ?> " disabled>
				  		</div>
                          <div class="form-group">
				  			<label class="form-label" for="jumlah">Jumlah Hari</label>
				  			<input type="number" class="form-control" id="jumlah" name="jumlah" value="" placeholder="Jumlah Hari">
				  		</div>
						<hr>
				  		<button type="submit" target="_blank" class="btn btn-primary">Print</button>
			  		</form>
			  	</div>
			</div>
			
		</div>
	</div>
</div>
</div>