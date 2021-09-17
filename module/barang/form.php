<?php
    $barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : false;
    // $kategori = "";
    $status = "";
    $nama_barang = "";
    $spesifikasi =  "";
    $stok = "";
    $harga= "";
    $keterangan = "";
    $button = "add";

    if($barang_id) {

        $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");

        $row = mysqli_fetch_assoc($query);
        $status = $row['status'];
        $kategori_id = $row['kategori_id'];
        $nama_barang = $row['nama_barang'];
        $spesifikasi =  $row['spesifikasi'];
        $gambar = $row['gambar'];
 
        $stok = $row['stok'];
        $harga= $row['harga'];
        $button = "update";
        $img = "<img class='gambar' 'src='".BASE_URL."images/barang/$gambar' >";
    }
?>
<script src="<?php echo BASE_URL . "js/ckeditor/ckeditor.js"?>"></script>
<form action="<?php echo BASE_URL. "module/barang/action.php?barang_id=$barang_id"?>" method="POST" enctype="multipart/form-data">
        <div class="element-form">
            <label for="kategori">Kategori</label>
            <span>
                <select name="kategori_id">
                    <?php
                        $query = mysqli_query($koneksi, "SELECT kategori, kategori_id FROM kategori WHERE status='on' ORDER BY kategori ASC");

                        while($row=mysqli_fetch_assoc($query)){
                            if($kategori_id === $row['kategori_id']) {
                                echo "<option value='$row[kategori_id]' selected='true'>$row[kategori]</option>";
                            } else {
                                echo "<option value='$row[kategori_id]'>$row[kategori]</option>";
                            }
                        }
                        
                    ?>
                </select>
            </span>
        </div>

        <div class="element-form">
            <label for="nama barang">Nama Barang</label>
            <span><input type="text" name="nama_barang" value="<?php echo $nama_barang?>"></span>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="spesifikasi" style="font-weight: bold;">Spesifikasi</label>
            <span><textarea name="spesifikasi" id="editor"><?php echo $spesifikasi?></textarea></span>
        </div>

        <div class="element-form">
            <label for="stok">Stok</label>
            <span><input type="text" name="stok" value="<?php echo $stok?>"></span>
        </div>

        <div class="element-form">
            <label for="harga">Harga</label>
            <span><input type="text" name="harga" value="<?php echo $harga?>"></span>
        </div>

        <div class="element-form">
            <label for="harga">Gambar Produk (tekan tombol bila ingin mengganti gambar)</label>
            <span>
                <input type="file" name="file">
                <img class="gambar" src="<?php echo BASE_URL . "images/barang/$gambar"?>" alt="">
            </span>

        </div>
        <div class="element-form">
            <label for="status">Status</label>
            <span>
                <input type="radio" name="status" value="on" <?php if($status === "on") { echo "checked='true'";} ?> >on
                <input type="radio" name="status" value="off" <?php if($status === "off") { echo "checked='true'";} ?> >off
            </span>
        </div>
        <div class="element-form">
            <span><input type="submit" name="button" value="<?php echo $button; ?>"></span>
        </div>
</form>
<script>
var roxyFileman = 'js/ckeditor/fileman/index.html'; 
    $(function(){
        CKEDITOR.replace( 'editor',{filebrowserBrowseUrl:roxyFileman,
                                filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                                removeDialogTabs: 'link:upload;image:upload'}); 
    });

</script>