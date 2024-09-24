<?php  
// fungsi untuk membuat format rupiah
function rupiah($angka) {
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
}


?>


<div class="content-wrapper">
    <div class="container mt-3">
    <div class="card mt-3">
        <div class="card-header" id="tableTitle">
                Laporan Kunjungan
         </div>
        <div class="card-body">
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody><tr>
                    <td>Dari Tanggal</td>
                    <td><input type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Sampai Tanggal</td>
                    <td><input type="text" id="max" name="max"></td>
                </tr>
            </tbody></table>

                    <table class="table table-bordered table-hover table-striped " id="initabel3">
                        <thead>
                            <tr> 
                                <th>No</th>
                                <th>Tanggal Kunjungan</th>
                                <th>ID Daftar Rawat</th>
                                <th>Nama Pasien</th>
                                <th>ID User</th>
                                <th>statusRawat</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- mengambil data dari database -->
                        <?php
                        $i = 1;
                        $query = "SELECT daftarrawat.*, pasien.*, user.* FROM daftarrawat INNER JOIN pasien ON daftarrawat.idPasien = pasien.idPasien INNER JOIN user ON daftarrawat.idUser = user.idUser WHERE statusRawat = 'cared' ORDER BY daftarrawat.tanggalKunjungan DESC;";
                        $sql = mysqli_query($kon, $query);
                        while ($data = mysqli_fetch_array($sql)): ?>
                        
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['tanggalKunjungan'] ?></td>
                            <td><?= $data['idDaftarRawat'] ?></td>
                            <td><?= $data['namaPasien'] ?></td>
                            <td><?= $data['idUser'] ?></td>
                            <td><?= $data['statusRawat'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    </table>
                </div>
                
            </div>
    </div>
</div>

<script>
</script>
