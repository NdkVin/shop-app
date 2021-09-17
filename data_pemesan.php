<?php
    include_once("function/koneksi.php");
	if($user_id== false) {
		$_SESSION['proses_pemesanan'] = true;
		header("location:".BASE_URL."index.php?page=login");
	}
?>
<div class="data-pemesanan">


	<div class="frame-data-pengiriman">
		<h3 class="label-data-pengiriman">Alamat Pengiriman Barang</h3>
		<div class="frame-form-pengiriman">
			<form action="proses_pemesanan.php" method="POST">

				<div class="element-form">
					<label>Nama Penerima</label>
					<span><input type="text" name="nama_penerima" /></span>
				</div>		

				<div class="element-form">
					<label>Nomor Telepon</label>
					<span><input type="text" name="nomor_telepon" /></span>
				</div>		
				
				<div class="element-form">
					<label>Alamat Pengiriman</label>
					<span><textarea name="alamat"></textarea></span>
				</div>	

				<div class="element-form">
					<label>Kota</label>
					<span>
						<select name="kota">
							<?php
								$query = mysqli_query($koneksi, "SELECT * FROM kota");
								while($row=mysqli_fetch_assoc($query)){
									echo "<option value='$row[kota_id]'>$row[kota] (".rupiah($row['tarif']).")<option>";
								}
							?>
						</select>
					</span>
				</div>

				<div class="element-form">
					<span><input type="submit" value="submit"/></span>
				</div>	
			</form>
		</div>
	</div>

	<div class="frame-data-detail">
		<div class="label-data-pengiriman">
			<h3>Detail Order</h3>
		</div>
		<table class="detail-list">
			<tr>
				<th class="satu">Nama Barang</th>
				<th class="dua">Qty</th>
				<th class="tiga">Total</th>
			</tr>
			
			<?php
				$subtotal = 0;
				foreach($keranjang AS $key => $value){
					
					$barang_id = $key;
					
					$nama_barang = $value['nama_barang'];
					$harga = $value['harga'];
					$quantity = $value['quantity'];
					
					$total = $quantity * $harga;
					$subtotal = $subtotal + $total;
					
					echo "<tr class='listk'>
							<td class='satu'>$nama_barang</td>
							<td class='dua'>$quantity</td>
							<td class='tiga'>".rupiah($total)."</td>
						</tr>";
				}
				
				
			?>
			
		</table>

				<div class="div">
						<b>Sub Total</b>
						<b><?php echo rupiah($subtotal)?></b>
				</div>
	</div>


</div>