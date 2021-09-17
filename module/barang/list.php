<?php 

    $search = isset($_GET["search"]) ? $_GET["search"] : false;
    $where = "";
    $search_url = "";
    if($search) {
        $search_url = "&search=$search";
        $where = "WHERE barang.nama_barang LIKE '%$search%'";
    }
?>

<div id="frame-tambah">
    <div class="left" >
        <form action="<?php echo BASE_URL. "index.php"?>" method="GET">
            <input type="hidden" name="page" value="<?php echo $_GET['page'];?>">
            <input type="hidden" name="module" value="<?php echo $_GET['module'];?>">
            <input type="hidden" name="action" value="<?php echo $_GET['action'];?>">
            <input type="text" name="search" value="<?php echo $search; ?>">
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="right">
        <a class="tombol-action" href="<?php echo BASE_URL. "index.php?page=my_profile&module=barang&action=form" ?>" class="tombol-action">Tambah Barang</a>
    </div>
    

</div>

<?php 
    $pagenation = isset($_GET['pagenation']) ? $_GET['pagenation'] : 1;
    $data_perhalaman = 5;

    

    $mulai_dari = ($pagenation-1) * $data_perhalaman;   
    $query = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id $where ORDER BY nama_barang ASC LIMIT $mulai_dari, $data_perhalaman " );

    if(mysqli_num_rows($query) === 0) {
        echo "Maaf belum ada data barang";
    } else {
        echo "<table class='table-list'>";
        
        echo "  <tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Barang</th>
                    <th class='kiri'>Kategori</th>
                    <th class='kiri'>Harga</th>
                    <th class='tengah'>Status</th>
                    <th class='tengah'>Action</th>
                <tr>
        ";
        $no=1+$mulai_dari;
        while($row=mysqli_fetch_assoc($query)) {
            echo "  <tr height='25px'>
                        <td class='kolom-nomor'>$no</td>
                        <td class='kiri'>$row[nama_barang]</td>
                        <td class='kiri'>$row[kategori]</td>
                        <td class='kiri'>$row[harga]</td>
                        <td class='tengah'>$row[status]</td>
                        <td class='tengah'>
                            <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>Edit<a>
                            <a class='tombol-action' href='".BASE_URL."module/barang/action.php?button=delete&barang_id=$row[barang_id]'>Delete<a>
                        </td>
                    <tr>
            ";

            $no++;
        }

        echo "</table>";
    }

    $hitungJumlah = mysqli_query($koneksi, "SELECT * FROM barang $where");
    $url = "index.php?page=my_profile&module=barang&action=list";
    pagenation($hitungJumlah, $data_perhalaman, $pagenation, $url);
?>