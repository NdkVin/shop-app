<?php

    if($user_id) {
        header("location: ".BASE_URL);
    }

?>

<div id="content-user-akses">

<?php
        $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
        
        if ($notif === 'true'){
            echo "<p class='notif'>Email atau Password tidak sesuai</p>";
        }
    ?> 
    <form action="<?php echo BASE_URL. "proses_login.php" ?>" method="POST">
        <div class="element-form">
            <label for="Email">Email</label>
            <span><input type="text" name="email"></span>
        </div>
        <div class="element-form">
            <label for="password">Password</label>
            <span><input type="password" name="password" ></span>
        </div>
        <div class="element-form">
            <span><input type="submit" value="Login"></span>
        </div>
    </form>
</div>