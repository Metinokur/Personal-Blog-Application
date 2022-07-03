<?php !defined("admin") ? die("hacking"):null;?>

<?php

$id=@$_GET["id"];


?>



<div class="admin-icerik-sag">
    <h2>Üyeyi Sil</h2>
    <div class="konular">
        <?php
        if (!empty($conn)) {
            $v=$conn->prepare("delete from uyeler where uye_id=?");
            $sil=$v->execute(array($id));
            if ($sil){
                echo '<div class="basarili-kayit-olundu"> Uye başarıyla silindi yönlendiriliyorsunuz...</div>';
                header("refresh:2; url=?do=uyeler2");
            } else{
                echo '<div class="arama-hata">Üye  silinirken bir hata oluştu...</div>';
            }
        }
        ?>
    </div>
</div>


