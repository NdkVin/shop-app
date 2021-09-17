<div class="main">
    

<div id="kiri">
    <?php
        echo kategori($kategori_id);
    ?>
</div>

<div class="kanan">

    <div id="slides">
        <?php
            $queryBanner=mysqli_query($koneksi, "SELECT * FROM banner WHERE status='on' ORDER BY banner_id DESC LIMIT 3");
            while($rowBanner=mysqli_fetch_assoc($queryBanner)) {
                echo "
                    <a href='".BASE_URL."$rowBanner[link]'><img src='". BASE_URL. "images/slide/$rowBanner[gambar]'></a>
                ";
            }
        ?>
    </div>

    <div class="frame-barang">
        <ul>
            <?php 
                $var = false;
                $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;
                if($kategori_id) {
                    $var = "AND barang.kategori_id='$kategori_id'";
                }
                $query = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id WHERE barang.status='on' $var  ORDER BY rand() DESC LIMIT 9");

                $no =1;
                $style = false;
                if($no == 3) {
                    $no =0;
                    $style = "style: margin-left:0";
                }
                
                while($row=mysqli_fetch_assoc($query)) {
                    $kategori = strtolower($row['kategori']);
                    $nama_barang = strtolower($row['nama_barang']);
    
                    $nama = str_replace(" ", "-", $nama_barang);
                    echo "
                        <li $style class='list-barang'> 
                            <p class='price'>".rupiah($row['harga'])."</p>
                            <a href='".BASE_URL."$row[barang_id]/$kategori/$nama.html'>
                                <img class='gambar-produk' src='".BASE_URL."/images/barang/$row[gambar]'>
                            </a>
                            <div class='keterangan-gambar'>
                                <p><a href='".BASE_URL."$row[barang_id]/$kategori/$nama.html'>$row[nama_barang]</a></p>
                                <span>stok : $row[stok]</span>
                            </div>
                            <div class='add-cart'>
                                <a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+add to cart</a>
                            </div>

                            
                        </li>
                    ";

                    $no++;
                }
            ?>
        </ul>
    </div>
</div>
</div>