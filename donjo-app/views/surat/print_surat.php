<!--
*
* Kalau ada file print surat di folder desa, pakai file itu.
* Urutan: (1) LOKASI_SURAT_DESA/<folder_surat_ini>
*         (2) LOKASI_SURAT_PRINT_DESA
* Kalau tidak ada, pakai file print surat yang disediakan di release SID
* di surat/<folder_surat_ini>/print
*
-->
<?php
$nama_file = 'print_' . $url . ".php";
$print_surat = LOKASI_SURAT_PRINT_DESA . $url . "/" . $nama_file;


if (is_file($print_surat)) {
	// echo 1;
	include($print_surat);
} else if (is_file(LOKASI_SURAT_PRINT_DESA . $nama_file)) {
	// echo 2;
	include(LOKASI_SURAT_PRINT_DESA . $nama_file);
} else {
	// echo 3;
	// echo "surat/$url/$nama_file";
	include("template-surat/$url/$nama_file");
}
?>