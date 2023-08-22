<?php
include '../koneksi.php';

// Menangkap data id yang dikirim dari url
$id = $_GET['id'];

// Menghapus transaksi
mysqli_query($koneksi, "DELETE FROM transaksi WHERE transaksi_id='$id'");

// Menghapus data pakaian dalam transaksi ini
mysqli_query($koneksi, "DELETE FROM pakaian WHERE pakaian_transaksi='$id'");

// Alihkan halam ke halaman transaksi
header("location:transaksi.php");
?>