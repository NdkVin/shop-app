<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    admin($level, "barang");


    $barang_id = $_GET['barang_id'];
    $kategori_id = $_POST['kategori_id'];
    $nama_barang = $_POST['nama_barang'];
    $spesifikasi = $_POST['spesifikasi'];

    $barang_id = isset($_POST['barang_id']) ? $_POST['barang_id'] : $_GET['barang_id'];
    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : false;
    $nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : false;
    $spesifikasi = isset($_POST['spesifikasi']) ? $_POST['spesifikasi'] : false;
    $stok = isset($_POST['stok']) ? $_POST['stok'] : false;
    $harga = isset($_POST['harga']) ? $_POST['harga'] : false;
    $status = isset($_POST['status']) ? $_POST['status'] : false;

    $update_gambar="";

    if(!empty($_FILES['file']["name"])){
        $nama_file =  $_FILES['file']["name"];
        move_uploaded_file($_FILES['file']["tmp_name"], "../../images/barang/".$nama_file);

        $update_gambar = ", gambar='$nama_file'";
    }
    if($button === "add") {
        mysqli_query($koneksi, "INSERT INTO barang (kategori_id, nama_barang, spesifikasi, gambar, harga, stok, status) VALUES ('$kategori_id', '$nama_barang', '$spesifikasi', '$nama_file', '$harga', '$stok', '$status');");
        
    } else if($button === "update") {
        mysqli_query($koneksi, " UPDATE barang SET kategori_id='$kategori_id', nama_barang = '$nama_barang',spesifikasi = '$spesifikasi',harga='$harga', stok = '$stok', status='$status' $update_gambar  WHERE `barang_id` = $barang_id;"
        );
    } else if($button = "delete") {
        mysqli_query($koneksi, "DELETE FROM barang WHERE barang.barang_id ='$barang_id'");
    }
    header("location: ".BASE_URL."index.php?page=my_profile&module=barang&action=list");