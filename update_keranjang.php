<?php
	session_start();
	include_once("function/koneksi.php");

	$barang_id = $_POST["barang_id"];
	$value = $_POST["value"];

	$keranjang = $_SESSION["keranjang"];

	$status = false;
	$pesan = '';


	$query = mysqli_query($koneksi, "SELECT stok FROM barang WHERE barang_id='$barang_id'");

	$row= mysqli_fetch_array($query);

	if(!$value) {
		$status = true;
		$value = 0;
		$keranjang[$barang_id]["quantity"] = $value;
		$_SESSION["keranjang"] = $keranjang;
	} else if($value > $row['stok']) {
		$status = false;
		$pesan = "stok tersedia" ." ". $row['stok'];
	} else {
		$status = true;
		$keranjang[$barang_id]["quantity"] = $value;
		$_SESSION["keranjang"] = $keranjang;
	}

	$arr = ['status' => $status, 'pesan' => $pesan];
    $json = json_encode($arr);
  
    echo $json;