<?php

    if($user_id) {
        header("location: ".BASE_URL);
    }

?>


<div id="content-user-akses">
    <?php
        $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
        $nama_lengkap = isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap'] : false;
        $alamat = isset($_GET['alamat']) ? $_GET['alamat'] : false;
        $email = isset($_GET['email']) ? $_GET['email'] : false;
        $phone = isset($_GET['phone']) ? $_GET['phone'] : false;
        $password = isset($_GET['password']) ? $_GET['password'] : false;
        $re_password = isset($_GET['re_password']) ? $_GET['re_password'] : false;

        if ($notif === 'require'){
            echo "<p class='notif'>Masukan data dengan lengkap</p>";
        }

        if ($notif === 'email'){
            echo "<p class='notif'>Maaf email telah digunakan</p>";
        }
        
        if($notif === 'password') {
            echo "<p class='notif'>Password tidak sama</p>";
        }
    ?> 
    <form action="<?php echo BASE_URL. "proses_register.php" ?>" method="POST">
        <div class="element-form">
            <label for="nama_lengkap">Nama Lengkap</label>
            <span><input type="text" name="nama_lengkap" value="<?php echo $nama_lengkap ?>"></span>
        </div>

        <div class="element-form">
            <label for="email">Email</label>
            <span><input type="text" name="email" value="<?php echo $email ?>"></span>
        </div>

        <div class="element-form">
            <label for="phone">Phone Number</label>
            <span><input type="text" name="phone" value="<?php echo $phone ?>"></span>
        </div>

        <div class="element-form">
            <label for="email">Alamat</label>
            <span><textarea name="alamat" value="<?php echo $alamat ?>"></textarea></span>
        </div>

        <div class="element-form">
            <div class="pasword">
                <label for="password">password</label>
                <span><i class="hide-show fa fa-eye"></i></span>
            </div>
            
            <span><input class="input-password" type="password" name="password" value="<?php echo $password ?>"></span>
        </div>

        <div class="element-form">
            <label for="retype">Retype Password</label>
            <span><input type="password" name="re_password" value="<?php echo $re_password ?>"></span>
        </div>

        <div class="element-form">
            <span><input type="submit" value="Register"></span>
        </div>
    </form>
</div>