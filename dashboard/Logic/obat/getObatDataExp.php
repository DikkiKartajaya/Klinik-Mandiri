<?php
session_start();
require  '../../../koneksi.php';


$id = $_GET['idObat'];
$idObat = $kon->real_escape_string($_GET['idObat']); // Escape the input to prevent SQL injection

// Use a prepared statement to avoid SQL injection
$sql = "SELECT * FROM obat WHERE idObat = ?";
$stmt = $kon->prepare($sql);
$stmt->bind_param("s", $idObat); // Bind parameter as string (s) for idObat
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='card-body'>";
    echo "<form action='Logic/obat/updateStokExp.php?idObat=" . $row['idObat'] ."' method='post' enctype='multipart/form-data' id='formstok'>";
    echo "<input type='hidden' name='idObat' value='" . $row['idObat'] . "'>";
    
    echo "<div class='form-group'>";
    echo "<label class='form-label' for='namaObat'>Nama Obat</label>";
    echo "<input type='text' class='form-control' id='namaObat' name='namaObat' value='" . $row['namaObat'] . "' disabled>";
    echo "</div>";
    
    echo "<div class='form-group'>";
    echo "<label class='form-label' for='Stok'>Jumlah Stok Kadaluarsa (strips/botol/pcs)</label>";
    echo "<input type='text' class='form-control' id='Stok' name='Stok' value='' required>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label class='form-label' for='idGolongan'>Golongan</label>";
    echo "</div>";

    $idGolongan = $row['idGolongan'];
    if ($idGolongan == 1) {
        echo '<div class="alert alert-success" role="alert">Obat Bebas</div>';
    } elseif ($idGolongan == 2) {
        echo '<div class="alert alert-primary" role="alert">Obat Bebas Terbatas</div>';
    } elseif ($idGolongan == 3) {
        echo '<div class="alert alert-warning" role="alert">Obat Keras dan Psikotropika</div>';
    } elseif ($idGolongan == 4) {
        echo '<div class="alert alert-danger" role="alert">Obat Golongan Narkotika</div>';
    }

    echo "<div class='form-group'>";
    echo "<label class='form-label' for='alasan'>Alasan</label>";
    echo "<input type='text' class='form-control' id='alasan' name='alasan' required>";
    echo "</div>";

    echo "<hr>";
    echo "<div class='text-right'>";
    echo "<button type='submit' class='btn btn-primary' style='margin-right: 5px;'>Submit</button>";
    echo "<button type='button' class='btn btn-danger' onclick='history.back()''>Kembali</button>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
} else {
    echo "Data obat tidak ditemukan.";
}


$kon->close();
?>
