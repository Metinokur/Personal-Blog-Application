<?php !defined("admin") ? die("hacking"):null;?>

<div class="admin-icerik-sag">
    <h2>ÇIKIŞ YAP</h2>
    <?php

    session_destroy();
    echo '<div class="admin-cikis">Başarıyla çıkış yaptınız anasayfaya yönlendiriliyorsunuz...</div>';
    header("refresh:2; url=../index.php");
    ?>


</div>