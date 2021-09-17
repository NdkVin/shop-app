<?php
    include_once("../../function/koneksi.php");
    include_once("../../function/helper.php");
    admin($level, "kategori");


    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : "";
    $status = isset($_POST['status']) ? $_POST['status'] : "";
    $button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : "";
    if($button === "add") {
        mysqli_query($koneksi, "INSERT INTO kategori (kategori, status) VALUES ('$kategori', '$status')");
        
    } else if($button === "update") {
        mysqli_query($koneksi, "UPDATE kategori SET 
                                                    status='$status',
                                                    kategori='$kategori' WHERE kategori_id='$kategori_id'" );
    } else if($button = "delete") {
        mysqli_query($koneksi, "DELETE FROM kategori WHERE kategori.kategori_id ='$kategori_id'");
    }
    header("location: ".BASE_URL."index.php?page=my_profile&module=kategori&action=list");
    
?>