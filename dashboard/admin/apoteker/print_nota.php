<?php
$id = $_GET['nota'];
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
		  			<strong>Surat Rujukan</strong>
		  		</div>
			  	<div class="card-body">
			  		<form id="printForm" action="Logic/apoteker/printNota.php?idAssesment=<?= $id ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
				  			<label class="form-label" for="idPasien">ID Pasien</label>
				  			<input type="text" class="form-control" id="idPasien" name="idPasien" value="<?= $idPasien ?>" disabled>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="namaPasien">Nama Pasien</label>
				  			<input type="text" class="form-control" id="namaPasien" name="namaPasien" value="<?= $pasien["namaPasien"] ?> " disabled>
				  		</div>
                          <div class="form-group">
				  			<label class="form-label" for="dibayar">Jumlah Uang Dibayar</label>
				  			<input type="number" class="form-control" id="dibayar" name="dibayar" value="" placeholder="Jumlah Uang Dibayar">
				  		</div>
						<hr>
				  		<a id="printButton" type="submit" target="_blank" class="btn btn-primary">Print</a>
			  		</form>
			  	</div>
			</div>
			
		</div>
	</div>
</div>
</div>
<script>
	document.getElementById('printButton').addEventListener('click', function(event) {
		event.preventDefault(); // Mencegah aksi default link

		// Arahkan form ke target _blank untuk membuka di tab baru
		var form = document.getElementById('printForm');
		form.target = '_blank';  // Membuka hasil print di tab baru
		form.submit();  // Kirim form
	});
</script>