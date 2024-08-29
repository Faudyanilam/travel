<?php
include "koneksi.php";

$id_mandiri = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "DELETE FROM mandiri WHERE id_mandiri = $id_mandiri";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil dihapus'); window.location='modifikasi_mandiri.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus'); window.location='modifikasi_mandiri.php';</script>";
}
?>