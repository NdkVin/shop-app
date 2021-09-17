<?php
    session_start();
    include_once("function/helper.php");
    include_once("function/koneksi.php");
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : false;
    $barang_id = $_GET['barang_id'];
    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id'");
    $row= mysqli_fetch_assoc($query);

    $keranjang[$barang_id] = array(
                                    "nama_barang" => $row["nama_barang"],
                                    "gambar" => $row["gambar"],
                                    "harga" => $row["harga"],
                                    "barang_id" => $row["barang_id"],
                                    "quantity" => 1
    );

    $_SESSION["keranjang"] = $keranjang;

    header("location: " .BASE_URL);


?>