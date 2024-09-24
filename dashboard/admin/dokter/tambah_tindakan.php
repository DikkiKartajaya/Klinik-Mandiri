<div class="content-wrapper">
	<br>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
		  		<div class="card-header">
		  			<strong>Tambah Tindakan</strong>
		  		</div>
			  	<div class="card-body">
			  		<form action="Logic/dokter/tambahTindakan.php" method="post" enctype="multipart/form-data" >
				  		<div class="form-group">
				  			<label class="form-label" for="namaTindakan">Nama Tindakan</label>
				  			<input type="text" class="form-control" id="namaTindakan" name="namaTindakan" required>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="biayaTindakan">Biaya Tindakan</label>
				  			<input type="text" class="form-control" id="biayaTindakan" name="biayaTindakan" required>
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