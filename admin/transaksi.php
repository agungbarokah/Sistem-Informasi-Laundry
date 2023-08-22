<?php include 'header.php'; ?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Data Transaksi Laundry</h4>
        </div>
        <div class="panel-body">
            <a href="transaksi_tambah.php" class="btn btn-sm btn-info pull-right">Tambah</a>
            <br/>
            <br/>

            <table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Berat (Kg)</th>
                    <th>Tanggal Selesai</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="20%">OPSI</th>
                </tr>

                <?php
                // Koneksi Database
                include '../koneksi.php';
                // Mengambil data pelanggan dari Database
                $data = mysqli_query($koneksi,"SELECT * FROM pelanggan, transaksi WHERE transaksi_pelanggan=idPelanggan ORDER BY transaksi_id DESC");
                $no = 1;
                // Mengubah data ke array dan menampilkannya dengan perulangan while
                while($d = mysqli_fetch_array($data)){ ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td>INVOICE-<?php echo $d['transaksi_id']; ?></td>
                        <td><?php echo $d['transaksi_tgl']; ?></td>
                        <td><?php echo $d['namaPelanggan']; ?></td>
                        <td><?php echo $d['transaksi_berat']; ?></td>
                        <td><?php echo $d['transaksi_tgl_selesai']; ?></td>
                        <td><?php echo "Rp. ".number_format($d['transaksi_harga']) ." ,-"; ?></td>
                        <td>
                            <?php
                            if($d['transaksi_status']=="0"){
                                echo "<div class='label label-warning'>PROSES</div>";
                            }else if($d['transaksi_status']=="1"){
                                echo "<div class='label label-info'>DICUCI</div>";
                            }else if($d['transaksi_status']=="2"){
                                echo "<div class='label label-success'>SELESAI</div>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="transaksi_invoice.php?id=<?php echo $d['transaksi_id']; ?>" target="_blank" class="btn-sm btn-warning">Invoice</a>
                            <a href="transaksi_edit.php?id=<?php echo $d['transaksi_id']; ?>" class="btn-sm btn-info">Edit</a>
                            <a href="transaksi_hapus.php?id=<?php echo $d['transaksi_id']; ?>" class="btn-sm btn-danger" onclick="return confirm('Yakin akan dihapus?')">Batalkan</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>