<?php  
// fungsi untuk membuat format rupiah
function rupiah($angka) {
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
}

?>
<div class="content-wrapper">
    <br>
    <div class="container">
    <?php
// Cek apakah ada session 'pesan'
if (isset($_SESSION['pesan'])) {
	$obatData = $_SESSION['pesan'];
    // Hapus session setelah digunakan
    unset($_SESSION['pesan']);
    ?>
    <script>
        // Tampilkan SweetAlert jika session ada
        Swal.fire({
            icon: "success",
            title: "Success!",
            html: `<strong><?= $obatData ?></strong>`,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
        });
    </script>
    <?php
}
?>
        <div class="card">
            <div class="card-header" id="tableTitle">
                Data Obat
            </div>
            <!-- INI TABLE -->
            <div class="card-body">
            <?php if ($jabatan == "Apoteker" || $jabatan == "Super Admin") : ?>
                <a href="index.php?tambahObat"><button class="btn btn-success btn-sm mb-3">Tambah Data Obat</button></a>
                <a href="index.php?stokObat"><button class="btn btn-warning btn-sm mb-3">Update Stok Obat</button></a>
                <a href="index.php?obatExpired"><button class="btn btn-warning btn-sm mb-3">Update Stok Obat Expired</button></a>
            <?php endif; ?>
                <table class="table table-bordered table-hover table-striped" id="initabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Obat</th>
                            <th>Nama Obat</th>
                            <th>Stock Obat</th>
                            <th>Golongan Obat</th>
                            <th>Jenis Obat</th>
                            <th>Harga Obat</th>
                            <?php if ($jabatan == "Apoteker" || $jabatan == "Super Admin") : ?>
                            <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- mengambil data dari database -->
                        <?php
                        $i = 1;
                        $query = "SELECT golongan.idGolongan, obat.idObat, obat.namaObat, obat.jenisObat, obat.stokObat, obat.hargaObat FROM obat INNER JOIN golongan ON obat.idGolongan = golongan.idGolongan;";
                        $sql = mysqli_query($kon, $query);
                        while ($data = mysqli_fetch_array($sql)): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['idObat'] ?></td>
                            <td><?= $data['namaObat'] ?></td>
                            <td><?= $data['stokObat'] ?></td>
                            <td>
                                <?php
                                $idGolongan = $data['idGolongan'];
                                if ($idGolongan == 1) {
                                    echo '<div class="alert alert-success" role="alert">Obat Bebas</div>';
                                } elseif ($idGolongan == 2) {
                                    echo '<div class="alert alert-primary" role="alert">Obat Bebas Terbatas</div>';
                                } elseif ($idGolongan == 3) {
                                    echo '<div class="alert alert-warning" role="alert">Obat Keras dan Psikotropika</div>';
                                } elseif ($idGolongan == 4) {
                                    echo '<div class="alert alert-danger" role="alert">Obat Golongan Narkotika</div>';
                                }
                                ?>
                            </td>
                            <td><?= $data['jenisObat'] ?></td>
                            <td>Rp. <?= rupiah($data['hargaObat']) ?></td>
                            <?php if ($jabatan == "Apoteker" || $jabatan == "Super Admin") : ?>
                            <td>
                                <a href="index.php?ubahObat=<?= $data['idObat'] ?>" class="btn btn-warning btn-sm text-small"><i class="fas fa-edit"></i></a>
                                <a href="Logic/obat/hapusObat.php?idObat=<?= $data['idObat']; ?>"  class="btn btn-danger btn-sm text-small" onclick="return confirm('Yakin ingin menghapus data ini ?')"><i class="fas fa-trash"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header" id="tableTitle">
                Data Obat - Low Stock
            </div>
            <!-- INI TABLE -->
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="initabel2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Obat</th>
                            <th>Nama Obat</th>
                            <th>Stock Obat</th>
                            <th>Golongan Obat</th>
                            <th>Jenis Obat</th>
                            <th>Harga Obat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- mengambil data dari database -->
                        <?php
                        $i = 1;
                        $query2 = "SELECT golongan.idGolongan, obat.idObat, obat.namaObat, obat.stokObat, obat.hargaObat FROM obat INNER JOIN golongan ON obat.idGolongan = golongan.idGolongan WHERE obat.stokObat <= 10;";
                        $sql = mysqli_query($kon, $query2);
                        while ($data = mysqli_fetch_array($sql)): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['idObat'] ?></td>
                            <td><?= $data['namaObat'] ?></td>
                            <td><?= $data['stokObat'] ?></td>
                            <td>
                                <?php
                                $idGolongan = $data['idGolongan'];
                                if ($idGolongan == 1) {
                                    echo '<div class="alert alert-success" role="alert">Obat Bebas</div>';
                                } elseif ($idGolongan == 2) {
                                    echo '<div class="alert alert-primary" role="alert">Obat Bebas Terbatas</div>';
                                } elseif ($idGolongan == 3) {
                                    echo '<div class="alert alert-warning" role="alert">Obat Keras dan Psikotropika</div>';
                                } elseif ($idGolongan == 4) {
                                    echo '<div class="alert alert-danger" role="alert">Obat Golongan Narkotika</div>';
                                }
                                ?>
                            </td>
                            <td><?=$data['jenisObat']?></td>
                            <td>Rp. <?= rupiah($data['hargaObat']) ?></td>
                            <td>
                                <a href="index.php?ubahObat=<?= $data['idObat'] ?>" class="btn btn-warning btn-sm text-small"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
