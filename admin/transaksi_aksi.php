<?php
// Menghubungkan dengan koneksi
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$pelanggan = $_POST['pelanggan'];
$berat = $_POST['berat'];
$tgl_selesai = $_POST['tgl_selesai'];
$tgl_hari_ini = date('Y-m-d');
$status = 0;

// Mengambil data harga per kilo dari database
$h = mysqli_query($koneksi,"SELECT harga_perkilo FROM harga");
$harga_per_kilo = mysqli_fetch_assoc($h);

// Menghitung harga laundry, harga perkilo x berat cucian
$harga = $berat * $harga_per_kilo['harga_perkilo'];

// Input data ke tabel transaksi
mysqli_query($koneksi,"INSERT INTO transaksi VALUES('','$tgl_hari_ini','$pelanggan','$harga','$berat','$tgl_selesai','$status')");

// Menyimpan id dari data yang disimpan pada query insert data sebelumnya
$id_terakhir = mysqli_insert_id($koneksi);

// Menangkap data form input array (jenis pakaian dan jumlah pakaian)
$jenis_pakaian = $_POST['jenis_pakaian'];
$jumlah_pakaian = $_POST['jumlah_pakaian'];

//Input data cucian berdasarkan id transaksi (invoice) ke tabel pakaian
for($x=0; $x<count($jenis_pakaian); $x++){
    if($jenis_pakaian[$x] != ""){
        mysqli_query($koneksi,"INSERT INTO pakaian VALUES('','$id_terakhir','$jenis_pakaian[$x]','$jumlah_pakaian[$x]')");

    }
}
header("location:transaksi.php");
?>