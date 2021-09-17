<?php
    define("BASE_URL", "http://localhost/weshop/");

	$arrayStatusPesanan[0] = "Menunggu Pembayaran";
	$arrayStatusPesanan[1] = "Pembayaran Sedang Di Validasi";
	$arrayStatusPesanan[2] = "Lunas";
	$arrayStatusPesanan[3] = "Pembayaran Di Tolak";
    function rupiah($nilai = 0) {
        $string = "Rp," . number_format($nilai);
        return $string;
    }

    function kategori($kategori_id = false ) {
        global $koneksi;
        $string = "<div class='menu-kategori'>";
            $string .= "<ul>";
                $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;
                $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE status='on'");
                while($row=mysqli_fetch_assoc($query)) {
                    $kategori = strtolower($row['kategori']);
                    if($kategori_id === $row['kategori_id']) {
                        $string .= "
                            <li><a class='active kategori-list' href='".BASE_URL."$row[kategori_id]/$kategori.html'>$row[kategori]</a></li>
                        ";
                    } else {
                        $string .= "
                            <li><a class='kategori-list' href='".BASE_URL."$row[kategori_id]/$kategori.html'>$row[kategori]</a></li>
                        ";
                    }
                }
            $string .= "</ul>";
        $string .= "</div>";
        return $string;
    }

    function admin($level, $module) {
        if($level != "superadmin") {
            $admin_page = array("kategori", "barang", "barang", "kota", "user");
    
            if(in_array($module, $admin_page)) {
                header("location: ".BASE_URL);
            }
        }
    }

    function pagenation($query, $data_perhalaman, $pagenation,$url) {
        $jumlah = mysqli_num_rows($query);
        $page = ceil($jumlah/$data_perhalaman);
        $batas_nomer = 6;
        $batas_halaman =  10;
        $mulai_pagenation = 1;
        $batas_pagenation = $jumlah;

       
        echo "<ul class='pagenation'>";
        if($pagenation>1) {
            $prev = $pagenation-1;

            echo "
            <li><a class='active page' href='".BASE_URL."$url&pagenation=$prev'><< prev</a></li>
            ";
            
        }
        if($pagenation>$batas_nomer) {
            $mulai_pagenation = $pagenation-($batas_nomer-1);
        }
        $batas_akhir = ($mulai_pagenation-1) + $batas_halaman;
        if($page> $batas_halaman) {
            if($batas_akhir>$page) {
                $batas_akhir = $page;
            }
            for($i = $mulai_pagenation; $i<=$batas_akhir; $i++) {
                if($pagenation === $i) {
                    echo "
                    <li><a class='active page' href='".BASE_URL."$url&pagenation=$i'>$i</a></li>
                ";
                } else {
                echo "
                    <li><a class='page' href='".BASE_URL."$url&pagenation=$i'>$i</a></li>
                ";
                }
            }
        } else {
            for($i = 1; $i<=$page; $i++) {
                if($pagenation === $i) {
                    echo "
                    <li><a class='active page' href='".BASE_URL."$url&pagenation=$i'>$i</a></li>
                ";
                } else {
                echo "
                    <li><a class='page' href='".BASE_URL."$url&pagenation=$i'>$i</a></li>
                ";
                }
            }
        }
        

        if($pagenation<$page) {
            $prev = $pagenation+1;

            echo "
            <li><a class='active page' href='".BASE_URL."$url&pagenation=$prev'>next >></a></li>
            ";
            
        }
        echo "</ul>";
    }
?>