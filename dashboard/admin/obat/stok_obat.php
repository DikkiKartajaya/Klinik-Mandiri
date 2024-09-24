
<!DOCTYPE html>
<html>
<head>
    <title>Update Stok Obat</title>

</head>
<body>
    <div class="content-wrapper">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Update Stok Obat</strong>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Pilih Obat</label>
                                    <select name="obatSelect" id="obatSelect" onchange="fetchObatData()" class="form-control">
                                        <option value="">Pilih Obat</option>
                                        <!-- Ambil nilai dari database -->
                                        <?php
                                        $sql = "SELECT idObat, namaObat FROM obat";
                                        $result = $kon->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['idObat'] . "'>" . $row['namaObat'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Tidak ada obat tersedia</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="obatData">
                                    <!-- Di sini akan ditampilkan data obat yang dipilih -->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
        function fetchObatData() {
            const obatId = document.getElementById('obatSelect').value;
			console.log(obatId);
            if (obatId) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'Logic/obat/get_obat_data.php?idObat=' + obatId, true);
                xhr.onload = function() {
                    if (this.status === 200) {
                        console.log(this.responseText); 
                        document.getElementById('obatData').innerHTML = this.responseText;
                    } else {
                        console.error('Error: ' + this.status); 
                    }
                };
                xhr.onerror = function() {
                    console.error('Request error...'); 
                };
                xhr.send();
            } else {
                document.getElementById('obatData').innerHTML = '';
            }
        }
    </script>
</html>

<?php
$kon->close();
?>
