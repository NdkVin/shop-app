<div id="frame-tambah">
    <a class="tombol-action" href="<?php echo BASE_URL. "index.php?page=my_profile&module=kategori&action=form" ?>" class="tombol-action">Tambah Kategori</a>
</div>

<?php 
    $pagenation = isset($_GET['pagenation']) ? $_GET['pagenation'] : 1;
    $data_perhalaman = 3;

    $mulai_dari = ($pagenation-1) * $data_perhalaman;

    
    $queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori LIMIT $mulai_dari, $data_perhalaman");

    if(mysqli_num_rows($queryKategori) === 0) {
        echo "Maaf belum ada data kategori";
    } else {
        echo "<table class='table-list'>";
        
        echo "  <tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Kategori</th>
                    <th class='tengah'>Status</th>
                    <th class='tengah'>Action</th>
                <tr>
        ";
        $no=1+$mulai_dari;
        while($row=mysqli_fetch_assoc($queryKategori)) {
            echo "  <tr class='tr' height='25px'>
                        <td class='kolom-nomor'>$no</td>
                        <td class='kiri'>$row[kategori]</td>
                        <td class='tengah'>$row[status]</td>
                        <td class='tengah'>
                            <a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=kategori&action=form&kategori_id=$row[kategori_id]'>Edit<a>
                            <a class='tombol-action' href='".BASE_URL."module/kategori/action.php?button=delete&kategori_id=$row[kategori_id]'>Delete<a>    
                        </td>
                    <tr>
        ";

        $no++;
        }

        echo "</table>";
    }

    $hitungJumlah = mysqli_query($koneksi, "SELECT * FROM kategori");
    $url = "index.php?page=my_profile&module=kategori&action=list";
    pagenation($hitungJumlah, $data_perhalaman, $pagenation, $url);
?>