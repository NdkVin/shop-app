<?php
    $pesanan_id = $_GET["pesanan_id"];

    $query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'");

    $row=mysqli_fetch_assoc($query);

    $tanggal_pemesanan = $row["tanggal_pemesanan"];
    $nama_penerima = $row["nama_penerima"];
    $nomor_telepon = $row["nomor_telepon"];
    $alamat = $row["alamat"];
    $tarif = $row["tarif"];
    $nama = $row["nama"];
    $kota = $row["kota"];
    $nama_penerima = $row["nama_penerima"];

?>

<div class="frame-faktur">
    <h3><center>Detail Pesanan</center></h3>
    <hr />

    <table>
        <tr>
            <td>Nomer Faktur</td>
            <td>:</td>
            <td><?php echo $pesanan_id ?></td>
        </tr>

        <tr>
            <td>Nama Pemesan</td>
            <td>:</td>
            <td><?php echo $nama ?></td>
        </tr>

        <tr>
            <td>Nama Penerima</td>
            <td>:</td>
            <td><?php echo $nama_penerima ?></td>
        </tr>

        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $alamat ?></td>
        </tr>

        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td><?php echo $nomor_telepon ?></td>
        </tr>

        <tr>
            <td>Tanggal Pemesanan</td>
            <td>:</td>
            <td><?php echo $tanggal_pemesanan ?></td>
        </tr>
    </table>
</div>

<table class="table-list">
    <tr class="baris-title">
        <td>Nomor</td>
        <td>Nama Barang</td>
        <td>Qty</td>
        <td>Harga Satuan</td>
        <td>Total</td>
    </tr>

    <?php
    
        $queryDetail = mysqli_query($koneksi, "SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id=barang.barang_id WHERE pesanan_detail.pesanan_id='$pesanan_id'");

        $no = 1;
        $subtotal = 0;
        while($row=mysqli_fetch_assoc($queryDetail)) {
            $total = $row['quantity'] * $row['harga'];
            echo "
                <tr class='listt-pesanan'>
                    <td  class='list-pesanan'>$no</td>
                    <td  class='list-pesanan'>$row[nama_barang]</td>
                    <td  class='list-pesanan'>$row[quantity]</td>
                    <td  class='list-pesanan'>".rupiah($row['harga'])."</td>
                    <td  class='list-pesanan'>".rupiah($total)."</td>
                </tr>
            ";
            $subtotal += $total;
            $no++;
        }

        $subtotal += $tarif;

    ?>
</table>

<div>
    <div class="div">
        <p>Ongkir<p>
        <p><?php echo rupiah($tarif) ?></p>
    <div>
    <div class="detail">
        <p>SUB TOTAL<p>
        <p><?php echo rupiah($subtotal) ?></p>
    <div>
</div>


<div class="keterangan-pembayaran">
        <p>Silahkan Lakukan pembayaran ke Bank ABC<br/>
		   Nomor Account : 0000-9999-8888 (A/N Weshop).<br/>
		   Setelah melakukan pembayaran silahkan lakukan konfirmasi pembayaran 
		   <a href="<?php echo BASE_URL."index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"?>">Disini</a>.
		</p>
</div>