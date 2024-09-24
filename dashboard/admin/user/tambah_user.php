<div class="content-wrapper">
	<br>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
		  		<div class="card-header">
		  			<strong>Tambah User</strong>
		  		</div>
			  	<div class="card-body">
			  		<form action="Logic/user/tambahUser.php" method="post" enctype="multipart/form-data">
				  		<div class="form-group">
				  			<label class="form-label" for="namaUser">Nama User</label>
				  			<input type="text" class="form-control" id="namaUser" name="namaUser" required>
				  		</div>
				  		<div class="form-group">
				  			<label class="form-label" for="username">Username</label>
				  			<input type="text" class="form-control" id="username" name="username" required>
				  		</div>
						  <div class="form-group">
				  			<label class="form-label" for="password">Password</label>
				  			<input type="password" class="form-control" id="password" name="password" required>
						</div>
						<div class="form-group">
				  			<label class="form-label" for="jabatan">Jabatan</label>
				  			<select name="jabatan" id="jabatan" class="form-control">
				  				<option value="" selected disabled>PILIH JABATAN</option>
				  				<option value="2">Dokter</option>
				  				<option value="3">Apoteker</option>
				  				<option value="1">administrasi</option>
								<option value="5">Pemilik</option>
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