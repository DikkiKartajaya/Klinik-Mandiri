<?php
include '..dashboard/admin/headerlte.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
		<div class="col d-flex justify-content-center">
			<div class="card shadow-lg bg-light" style="height: 350px; width:250px ; margin-top : 25px;">
			<center>
			<?php 
                $level = $_SESSION['jabatan'];
            if ($level=="Admin") {?>
            <img src="../asset/img/admin.png" class="pt-5" alt="foto" width="150">
            <?php } elseif ($level=="Dokter") {?>
            <img src="../asset/img/dokter.png" class="pt-5" alt="foto" width="150">
            <?php } elseif ($level=="Administrasi") {?>
            <img src="asset/img/admin.png" class="pt-5" alt="foto" width="150">
            <?php } elseif ($level=="Apoteker") {?>
            <img src="../asset/img/apoteker.png" class="pt-5" alt="foto" width="150">
            <?php } elseif ($level=="") {?>
            <img src="../asset/img/pemilik.png" class="pt-5" alt="foto" width="150">
            <?php } elseif ($level=="") {?>
            <img src="" class="pt-5" alt="foto" width="150">
            <?php }?>	
				<div class="card-body">
					<h4 class="card-text text-center">Selamat Datang <?= $_SESSION['jabatan'] ?></h4>
					<h5 class="card-text"><?= $_SESSION['namaUser'] ?></h5>
				</div>
			</center>
    		</div>
  		</div>
    </div>
    </div>
            </div>