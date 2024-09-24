<?php
$id = $_GET['ubahUser'];
$query = "SELECT * FROM user WHERE idUser='$id'";
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
		  			<strong>Ubah User</strong>
		  		</div>
			  	<div class="card-body">
			  		<form action="Logic/user/ubahUser.php?idUser=<?= $data['idUser'] ?>" method="post" enctype="multipart/form-data">
					  <div class="form-group">
				  			<label class="form-label" for="namaPasien">ID User</label>
				  			<input type="text" class="form-control" id="idUser" name="idUser" value="<?= $data['idUser'] ?>" disabled>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="namaPasien">Nama User</label>
				  			<input type="text" class="form-control" id="namaUser" name="namaUser" value="<?= $data['namaUser'] ?>" required>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="username">Username</label>
				  			<input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>" required>
				  		</div>
						  <div class="form-group">
				  			<label class="form-label" for="password">Password</label>
				  			<input type="password" class="form-control" id="password" name="password" value="<?= $data['password'] ?>" required>
				  		</div>	
					<div class="form-group">
				  			<label class="form-label" for="jabatan">Jabatan</label>
				  			<select name="jabatan" id="jabatan" class="form-control">
                              <?php  
									if ($data['level']=="2") {
										$d = "Selected";
									} elseif ($data['level']=="3") {
										$ap = "Selected";
									} elseif ($data['level']=="4") {
										$str = "Selected";
									} 
								?>
				  				<option value="2" <?= $d; ?>>Dokter</option>
				  				<option value="3" <?= $ap; ?>>Apoteker</option>
				  				<option value="4" <?= $str; ?>>Administrasi</option>
				  			</select>
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