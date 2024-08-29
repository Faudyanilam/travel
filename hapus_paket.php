<?php
include "koneksi.php";

$id_paket = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "DELETE FROM paket_liburan WHERE id_paket = $id_paket";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus'); window.location='modifikasi.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus'); window.location='modifikasi.php';</script>";
}
?>