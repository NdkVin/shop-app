<?php
    session_start();
    include_once("function/helper.php");
    include_once("function/koneksi.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
    $total_barang = count($keranjang);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL. "css/style.css" ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL. "css/banner.css" ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='js/jquery-3.6.0.min.js'></script>
    <script src='js/sc.js'></script>
    <script src='<?php echo BASE_URL . "js/slidesjs-SlidesJS-3/source/jquery.slides.min.js"; ?>'></script>
    <script>
		$(function() {
			$('#slides').slidesjs({
				height: 350,
				play: { auto : true,
					    interval : 3000
					  },
				navigation : false
			});
		});
		</script>	
    <title>weshop | barang-barang elektronik</title>
</head>
<body>
    <div id="container">
        <div id="header">
                <a href="<?php echo BASE_URL. "index.php" ?>"><img src="<?php echo BASE_URL. "images/logo.png" ?>" alt="logo weshop">
                </a>
            <div id="menu">
                <div id="user">
                <?php
                    if($user_id) {
                        echo "Hai $nama, <a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=list'>My Profile</a>
                        <a href='".BASE_URL."index.php?page=logout'>Logout</a>  ";
                    } else {
                        echo
                        "
                            <a href='".BASE_URL."login.html'>Login</a>
                            <a href='".BASE_URL."register.html'>Register</a>
                        ";
                    }
                ?>

                    
                    <a id="button-cart" href="<?php echo BASE_URL. "keranjang.html" ?>" id="keranjang">
                        <img  src="<?php echo BASE_URL. "images/cart.png" ?>" alt="cart">
                        <?php
                            echo "
                                <span class='total'>$total_barang</span>
                            "
                        ?>
                    </a>
                </div>
            </div>
        </div>
        <div id="content">
            <?php

                $filename = $page  . ".php";
                
                if(file_exists($filename)) {
                    include_once($filename);
                } else {
                    include_once("main.php");
                }

            ?>
        </div>


        <div id="footer">
            <p>&copy Andika 2021</p>
        </div>
    </div>
</body>
</html>