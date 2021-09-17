<div id="frame-tambah">
	<a class="tombol-action" href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=form"; ?>">+ Tambah Kota</a>
</div>

<?php
    $pagenation = isset($_GET['pagenation']) ? $_GET['pagenation'] : 1;
    $data_perhalaman = 5;

    $mulai_dari = ($pagenation-1) * $data_perhalaman;  
	$queryKota = mysqli_query($koneksi, "SELECT * FROM kota ORDER BY kota ASC LIMIT $mulai_dari, $data_perhalaman");
	
	if(mysqli_num_rows($queryKota) == 0){
		echo "<h3>Saat ini belum ada nama kota yang didalam database.</h3>";
	}
	else{
		echo "<table class='table-list'>";
		
			echo "<tr class='baris-title'>
					<th class='kolom-nomor'>No</th>
					<th class='kiri'>Kota</th>
					<th class='kiri'>Tarif</th>
					<th class='tengah'>Status</th>
					<th class='tengah'>Action</th>
				 </tr>";
				 
			$no = 1;
			while($rowKota=mysqli_fetch_assoc($queryKota)){
				echo "<tr>
						<td class='kolom-nomor'>$no</td>
						<td>$rowKota[kota]</td>
						<td>".rupiah($rowKota['tarif'])."</td>
						<td class='tengah'>$rowKota[status]</td>
						<td class='tengah'>
							<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=kota&action=form&kota_id=$rowKota[kota_id]"."'>Edit</a>
						</td>
					 </tr>";
				
				$no++;
			}
		
		echo "</table>";

		$hitungJumlah = mysqli_query($koneksi, "SELECT * FROM kota");
		$url = "index.php?page=my_profile&module=kota&action=list";
		pagenation($hitungJumlah, $data_perhalaman, $pagenation, $url);
	}
?>