<div class="main">
    

<div id="kiri">
    <?php
        echo kategori($kategori_id);
    ?>
</div>

<div class="kanan">
    <?php
        $barang_id = $_GET['barang_id'];

        $query = mysqli_query($koneksi , "SELECT * FROM barang WHERE barang_id='$barang_id' AND status='on'");
        $row = mysqli_fetch_assoc($query);

        echo "
            <div class='detail-barang'>
                <h2>$row[nama_barang]</h2>
                <div class='frame-barang'>
                    <img class='detail-img' src='".BASE_URL."images/barang/$row[gambar]'>
                </div>
                <div class='frame-harga'>
                    <span class='harga'>".rupiah($row['harga'])."</span>
                    <span class='card'><a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+add to cart</a></span>
                </div>
                <div class='keterangan'>
                    <b>Keterangan : </b>
                    $row[spesifikasi]
                </div>
            </div>
        ";
    ?>
</div>
</div>