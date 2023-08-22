<?php
// Menghubungkan dengan koneksi
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$id = $_POST['id'];
$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$status = $_POST['status'];

// Mengambil data harga per kilo dari database
$h = mysqli_query($koneksi,"SELECT harga_perkilo FROM harga");
$harga_per_kilo = mysqli_fetch_assoc($h);

// Menghitung harga laundry, harga perkilo x berat cucian
$harga = $berat * $harga_per_kilo['harga_perkilo'];

// Update data transaksi
mysqli_query($koneksi,"UPDATE transaksi SET transaksi_pelanggan='$pelanggan', transaksi_harga='$harga', transaksi_berat='$berat', transaksi_tgl_selesai='$tgl_selesai', transaksi_status='$status' WHERE transaksi_id='$id'");

// Menangkap data form input array (jenis pakaian dan jumlah pakaian)
$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];

// Menghapus semua pakaian dalam transaksi ini
mysqli_query($koneksi,"DELETE FROM pakaian WHERE pakaian_transaksi='$id'");

//Input ulang data cucian berdasarkan id transaksi (invoice) ke tabel pakaian
for($x=0; $x<count($jenis_pakaian); $x++){
    if($jenis_pakaian[$x] != ""){
        mysqli_query($koneksi,"INSERT INTO pakaian VALUES('','$id','$jenis_pakaian[$x]','$jumlah_pakaian[$x]')");
    }
}
header("location:transaksi.php");
?>