<?php
    $subTotal=0;

    if($total_barang === 0) {
        echo "
            <h3>Anda belum memasukan barang ke keranjang</h3>
        ";
    } else {
        $no = 1;
        echo "
            <table class='table-list'>
                <tr class='baris-title'>
                    <th class=''>No</th>
                    <th class=''>Image</th>
                    <th class=''>Nama Barang</th>
                    <th class=''>Qty</th>
                    <th class=''>Harga Satuan</th>
                    <th class=''>Total</th>
                    <th class=''>Hapus</th>
                </tr>
        ";

        foreach($keranjang AS $key => $value ) {
            $nama_barang = $value["nama_barang"];
            $gambar = $value["gambar"];
            $harga = $value["harga"];
            $quantity = $value["quantity"];
            $barang_id = $value["barang_id"];
            $total = $quantity * $harga;
            $subTotal += $total;
            echo "
                <tr class='keranjang-list'>
                    <th>$no</th>
                    <th><img style='height:100px;'src='".BASE_URL."images/barang/$gambar'></th>
                    <th>$nama_barang</th>
                    <th><input class='update-jumlah' value='$quantity' name='$barang_id'></input></th>
                    <th>".rupiah($harga)."</th>
                    <th>".rupiah($total)."</th>
                    <th class='tengah'>
                            <a class='tombol-action' href='".BASE_URL."hapus_item.php?barang_id=$barang_id'>Hapus<a>    
                    </th>
                </tr>
            ";

            $no++;
        }
    }

    echo "</table>";
    echo "
            <div class='sub-total'>
                <p>Sub Total</p>
                <p>".rupiah($subTotal)."</p>
            </div>
        ";
    echo "
        <div id='frame-button-keranjang'>
            <a id='lanjut-belanja' href='".BASE_URL."index.php'>< Lanjut Belanja</a>
            <a id='lanjut-pemesanan' href='".BASE_URL."data_pemesan.html'>Lanjut Pemesanan ></a>
        </div>";
?>

<script>
    	$(".update-jumlah").on("input", function(e){
		var barang_id = $(this).attr("name");
		var value = $(this).val();
		
		$.ajax({
			method: "POST",
			url: "update_keranjang.php",
			data: "barang_id="+barang_id+"&value="+value
		})
		.done(function(data){
            var json = $.parseJSON(data);
            if(json.status == true) {
                location.reload();
            } else {
                alert(json.pesan);
                location.reload();
            }
        });
		
	});

</script>