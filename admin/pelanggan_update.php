<?php
// Menghubungkan koneksi
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];

// Update data 
mysqli_query($koneksi, "UPDATE pelanggan set namaPelanggan='$nama', hpPelanggan='$hp', alamatPelanggan='$alamat' WHERE idPelanggan='$id'");

// Mengalihkan halaman kembali ke halaman pelanggan
header("location:pelanggan.php");
?>