<div class="content-wrapper">
	<br>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
		  		<div class="card-header">
		  			<strong>Tambah Obat</strong>
		  		</div>
			  	<div class="card-body">
			  		<form action="Logic/obat/tambahObat.php" method="post" enctype="multipart/form-data">
				  		<div class="form-group">
				  			<label class="form-label" for="namaObat">Nama Obat</label>
				  			<input type="text" class="form-control" id="namaObat" name="namaObat" required>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="stokObat">Stok Obat (Strip/Botol/Pcs)</label>
				  			<input type="text" class="form-control" id="stokObat" name="stokObat" required>
				  		</div>
						<div class="form-group">
				  			<label class="form-label" for="idGolongan">Golongan Obat</label>
				  			<select name="idGolongan" id="idGolongan" class="form-control" required>
				  				<option disabled>Pilih Kategori</option >
                                  // Langkah 2: Ambil nilai dari database
                                <?php
                                $sql = "SELECT idGolongan, namaGolongan FROM golongan";
                                $query = mysqli_query($kon, $sql);

                                // Loop melalui hasil kueri dan tambahkan setiap nilai sebagai opsi dropdown
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo "<option value='" . $row['idGolongan'] . "'>" . $row['namaGolongan'] . "</option>";
                                }?>
				  			</select>
				  		</div>
						<div class="form-group">
				  			<label class="form-label" for="jenisObat">Jenis Obat</label>
				  			<select name="jenisObat" id="jenisObat" class="form-control" required>
				  				<option disabled>Pilih Kategori</option >
								<option value="Tablet">Tablet</option>
								<option value="Kapsul">Kapsul</option>
								<option value="Sirup">Sirup</option>
								<option value="Salep">Salep</option>
								<option value="Injeksi">Kaplet</option>
								<option value="Lainnya">Lainnya</option>
				  			</select>
				  		</div>
                        <div class="form-group">
				  			<label class="form-label" for="hargaObat">Harga</label>
				  			<input type="text" class="form-control" id="hargaObat" name="hargaObat" required>
				  		</div>
						<hr>
						<div class="text-right">
				  		<button type="submit" class="btn btn-primary">Submit</button>
				  		<button type="button" class="btn btn-danger" onclick="history.back()">Kembali</button>
						</div>
			  		</form>
			  	</div>
			</div>
			
		</div>
	</div>
</div>
</div>