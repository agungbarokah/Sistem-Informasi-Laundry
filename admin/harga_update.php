<?php
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$harga = $_POST['harga'];

// Update data 
mysqli_query($koneksi, "UPDATE harga set harga_perkilo='$harga'");

// Mengalihkan halaman kembali ke halaman pelanggan
header("location:harga.php");
?>