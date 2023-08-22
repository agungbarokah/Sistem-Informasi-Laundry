<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Laundry - Pemrograman Web Dasar</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>
<body>
    <!-- Cek apakah sudah login -->
    <?php
    session_start();
    if ($_SESSION['status']!="login"){
        header("location:../index.php?pesan=belum_login");
    }
    ?>

    <?php
    include '../koneksi.php';
    ?>
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <?php
            // Menangkap id yang dikirim melalui url
            $id = $_GET['id'];
            // Mengambil data pelanggan yang ber id di atas dari tabel pelanggan
            $transaksi = mysqli_query($koneksi,"SELECT * FROM transaksi, pelanggan WHERE transaksi_id='$id' AND transaksi_pelanggan=idPelanggan");
            while($t = mysqli_fetch_array($transaksi)){
                ?>
                <center><h2>Laundry " PWD "</h2></center>
                <h3>INVOICE-<?php echo $t['transaksi_id']; ?></h3>
                <br/>
                <table class="table">
                    <tr>
                        <th width="20%">Tanggal Laundry</th>
                        <th>:</th>
                        <td><?php echo $t['transaksi_tgl']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>:</th>
                        <td><?php echo $t['namaPelanggan']; ?></td>
                    </tr>
                    <tr>
                        <th>HP</th>
                        <th>:</th>
                        <td><?php echo $t['hpPelanggan']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td><?php echo $t['alamatPelanggan']; ?></td>
                    </tr>
                    <tr>
                        <th>Berat Cucian (Kg)</th>
                        <th>:</th>
                        <td><?php echo $t['transaksi_berat']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Selesai</th>
                        <th>:</th>
                        <td><?php echo $t['transaksi_tgl_selesai']; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <td>
                            <?php
                            if($t['transaksi_status']=="0"){
                                echo "<div class='label label-warning'>PROSES</div>";
                            }else if($t['transaksi_status']=="1"){
                                echo "<div class='label label-info'>DICUCI</div>";
                            }else if($t['transaksi_status']=="2"){
                                echo "<div class='label label-success'>SELESAI</div>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <th>:</th>
                        <td><?php echo "Rp. ".number_format($t['transaksi_harga']) ." ,-"; ?></td>
                    </tr>
                </table>
                <br/>
                <h4>Daftar Cucian</h4>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Jenis Pakaian</th>
                        <th width="20%">Jumlah</th>
                    </tr>
                    <?php
                    // Menyimpan id transaksi ke variabel id_transaksi
                    $id = $t['transaksi_id'];
                    // Menampilkan pakaian-pakaian dari transaksi yang ber id di atas
                    $pakaian = mysqli_query($koneksi,"SELECT * FROM pakaian WHERE pakaian_transaksi='$id'");
                    while($p = mysqli_fetch_array($pakaian)){
                        ?>
                        <tr>
                            <td><?php echo $p['pakaian_jenis']; ?></td>
                            <td width="5%"><?php echo $p['pakaian_jumlah']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
                <br/>
                <p><center><i>" Terima kasih telah mempercayakan cucian anda pada kami ".</i></center></p>    
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>