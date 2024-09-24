<div class="content-wrapper">
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header" id="tableTitle">
                Data Pembelian Obat
            </div>
            <!-- INI TABLE -->
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="initabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id History</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama Obat</th>
                            <th>Jumlah Obat Dibeli</th>
                            <th>Harga Obat</th>
                            <th>Golongan Obat</th>
                            <th>Nota Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- mengambil data dari database -->
                        <?php
                        $i = 1;
                        $query = "SELECT historyObat.*, obat.namaObat, obat.idGolongan, obat.hargaObat FROM historyobat INNER JOIN obat ON historyObat.idObat = obat.idObat";
                        $sql = mysqli_query($kon, $query);
                        while ($data = mysqli_fetch_array($sql)): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['idHistory'] ?></td>
                            <td><?= $data['tanggalUpdate'] ?></td>
                            <td><?= $data['namaObat'] ?></td>
                            <td><?= $data['Stok'] ?></td>
                            <td><?= $data['hargaBeli'] ?></td>
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
                            <td><img src="../asset/notaObat/<?= $data['foto'] ?>" alt="" height="100"></td>


                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>