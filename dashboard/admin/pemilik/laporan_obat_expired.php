<div class="content-wrapper">
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header" id="tableTitle">
                Data Obat Kadaluarsa
            </div>
            <!-- INI TABLE -->
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped" id="initabel">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Obat Kadaluarsa</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama Obat</th>
                            <th>Jumlah Obat Kadaluarsa</th>
                            <th>Golongan Obat</th>
                            <th>Alasan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- mengambil data dari database -->
                        <?php
                        $i = 1;
                        $query = "SELECT obatexpired.*, obat.namaObat, obat.idGolongan, obat.hargaObat FROM obatexpired INNER JOIN obat ON obatexpired.idObat = obat.idObat";
                        $sql = mysqli_query($kon, $query);
                        while ($data = mysqli_fetch_array($sql)): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['idObatExp'] ?></td>
                            <td><?= $data['tanggalUpdate'] ?></td>
                            <td><?= $data['namaObat'] ?></td>
                            <td><?= $data['Stok'] ?></td>
                            
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
                            <td><?= $data['alasan'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 </div>