<?php
$id = $_GET['ubahObat'];
$query = "SELECT * FROM obat WHERE idObat='$id'";
$sql = mysqli_query($kon, $query);
$data = mysqli_fetch_array($sql);
$gol = "SELECT golongan.idGolongan FROM obat INNER JOIN golongan ON obat.idGolongan = golongan.idGolongan WHERE obat.idObat='$id'";
$sql_gol = mysqli_query($kon, $gol);
$data_gol = mysqli_fetch_array($sql_gol);
$idGolongan = $data_gol['idGolongan'];
?>
<div class="content-wrapper">
	<br>
<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="card">
		  		<div class="card-header">
		  			<strong>Ubah Obat</strong>
		  		</div>
			  	<div class="card-body">
			  		<form action="Logic/obat/ubahObat.php?idObat=<?= $data['idObat'] ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group">
				  			<label class="form-label" for="idObat">ID Obat</label>
				  			<input type="text" class="form-control" id="idObat" name="idObat" value="<?= $data['idObat'] ?>" disabled>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="namaObat">Nama Obat</label>
				  			<input type="text" class="form-control" id="namaObat" name="namaObat" value="<?= $data['namaObat'] ?> " required>
				  		</div>
                          <div class="form-group">
				  			<label class="form-label" for="stokObat">Stok Obat (Strip/Botol/Pcs)</label>
				  			<input type="text" class="form-control" id="stokObat" name="stokObat" value="<?= $data['stokObat'] ?>" disabled>
				  		</div>
						<div class="form-group">
				  			<label class="form-label" for="idGolongan">Golongan Obat</label>
				  			<select name="idGolongan" id="idGolongan" class="form-control">
                              <!-- Langkah 2: Ambil nilai dari database -->
                              <?php
                            $sql2 = "SELECT * FROM golongan";
                            $hasil2 = mysqli_query($kon, $sql2);

                             // Loop melalui hasil kueri dan tambahkan setiap nilai sebagai opsi dropdown
                             while ($row = mysqli_fetch_assoc($hasil2)) {
                                // Tentukan opsi yang dipilih berdasarkan data yang akan dipilih
                                $selected = ($row['idGolongan'] == $idGolongan) ? "selected" : "";
                                echo "<option value='" . $row['idGolongan'] . "' $selected>" . $row['namaGolongan'] . "</option>";
                            }?>
				  			</select>
				  		</div>
						  <div class="form-group">
				  			<label class="form-label" for="jenisObat">Jenis Obat</label>
				  			<select name="jenisObat" id="jenisObat" class="form-control" require>
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
				  			<input type="text" class="form-control" id="hargaObat" name="hargaObat" value="<?= $data['hargaObat'] ?>" required>
				  		</div>
						
						<hr>
				  		<button type="submit" class="btn btn-primary">Submit</button>
				  		<button type="button" class="btn btn-danger" onclick="history.back()">Kembali</button>
			  		</form>
			  	</div>
			</div>
			
		</div>
	</div>
</div>
</div>