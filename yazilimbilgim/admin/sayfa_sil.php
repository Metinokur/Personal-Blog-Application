<?php !defined("admin") ? die("hacking"):null;?>


<?php

$id=@$_GET["id"];


?>



<div class="admin-icerik-sag">
    <h2>Sayfa Sil</h2>
    <div class="konular">
        <?php
        if (!empty($conn)) {
            $v=$conn->prepare("delete from sabit_sayfalar where sayfa_id=?");
            $sil=$v->execute(array($id));
            if ($sil){
                echo '<div class="basarili-kayit-olundu"> Sayfa başarıyla silindi yönlendiriliyorsunuz...</div>';
                header("refresh:2; url=?do=sabit_sayfalar");
            } else{
                echo '<div class="arama-hata"> Sayfa silinirken bir hata oluştu...</div>';
            }
        }
        ?>
    </div>
</div>



