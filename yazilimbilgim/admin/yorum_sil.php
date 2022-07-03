<?php !defined("admin") ? die("hacking"):null;?>


<?php

$id=@$_GET["id"];


?>



<div class="admin-icerik-sag">
    <h2>Yorumu Sil</h2>
    <div class="konular">
        <?php
        if (!empty($conn)) {
            $v=$conn->prepare("delete from yorumlar where yorum_id=?");
            $sil=$v->execute(array($id));
            if ($sil){
                echo '<div class="basarili-kayit-olundu"> Yorum başarıyla silindi yönlendiriliyorsunuz...</div>';
                header("refresh:2; url=?do=yorumlar2");
            } else{
                echo '<div class="arama-hata"> Yorum silinirken bir hata oluştu...</div>';
            }
        }
        ?>
    </div>
</div>


