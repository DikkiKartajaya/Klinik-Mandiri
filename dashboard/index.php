<?php
session_start();
// make if user idle for 30 minutes, then logout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
	session_unset();
	session_destroy();
	header("location: ../auth");
}

// Update last activity time
$_SESSION['last_activity'] = time();
error_reporting(0);

include 'headerlte.php';


if (isset($_GET['registrasi'])) {
  	include 'admin/registrasi.php';
} 
// THIS IS FOR USER
elseif (isset($_GET['user'])) {
	include 'admin/user/data_user.php';
} elseif (isset($_GET['ubahUser'])) {
	include 'admin/user/ubah_user.php';
} elseif (isset($_GET['tambahUser'])) {
	include 'admin/user/tambah_user.php';
} 
// THIS IS FOR OBAT
elseif (isset($_GET['obat'])) {
	include 'admin/obat/data_obat.php';
} elseif (isset($_GET['tambahObat'])) {
	include 'admin/obat/tambah_obat.php';
} elseif (isset($_GET['ubahObat'])) {
	include 'admin/obat/ubah_obat.php';
} elseif (isset($_GET['stokObat'])) {
	include 'admin/obat/stok_obat.php';
} elseif (isset($_GET['laporanBeliObat'])) {
	include 'admin/obat/laporan_Obat.php';
} elseif (isset($_GET['obatExpired'])) {
	include 'admin/obat/obat_expired.php';
} 

// THIS IS FOR pasien
elseif (isset($_GET['pasien'])) {
	include 'admin/pasien/data_pasien.php';
} elseif (isset($_GET['tambahPasien'])) {
	include 'admin/pasien/tambah_pasien.php';
} elseif (isset($_GET['ubahPasien'])) {
	include 'admin/pasien/ubah_pasien.php';
} elseif (isset($_GET['rekamMedis'])) {
	include 'admin/pasien/rekam_medis.php';
}

//THIS IS FOR DOCTOR

elseif (isset($_GET['daftarPasien'])) {
	include 'admin/dokter/daftar_rawat_pasien.php';
} elseif (isset($_GET['tindakan'])) {
	include 'admin/dokter/tindakan.php';
} elseif (isset($_GET['tambahTindakan'])) {
	include 'admin/dokter/tambah_tindakan.php';
}elseif (isset($_GET['ubahTindakan'])) {
	include 'admin/dokter/ubah_tindakan.php';
}

//THIS IS FOR ASSESMENT
elseif (isset($_GET['assesment'])) {
	include 'admin/assesment/assesment.php';
} elseif (isset($_GET['assesmentObat'])) {
	include 'admin/assesment/assesment_obat.php';
} elseif (isset($_GET['assesmentTindakan'])) {
	include 'admin/assesment/assesment_tindakan.php';
} elseif (isset($_GET['suratSakit'])) {
	include 'admin/assesment/surat_sakit.php';
} elseif (isset($_GET['suratRujukan'])) {
	include 'admin/assesment/rujukan_sakit.php';
}
// THIS IS FOR RESEP
elseif (isset($_GET['resep'])) {
	include 'admin/apoteker/data_resep.php';
} elseif (isset($_GET['dashboard'])) {
	include 'admin/dashboard.php';
} elseif (isset($_GET['nota'])) {
	include 'admin/apoteker/print_nota.php';
}

//THIS IS FOR LAPORAN
elseif (isset($_GET['laporanPenghasilan'])) {
	include 'admin/pemilik/laporan_obat_pasien.php';
} elseif (isset($_GET['laporanKunjugan'])) {
	include 'admin/pemilik/laporan_Kunjungan_pasien.php';
} elseif (isset($_GET['laporanObatExpired'])) {
	include 'admin/pemilik/laporan_obat_expired.php';
} 
 else {
  	include 'admin/index.php';
}

include 'footerlte.php';
?>