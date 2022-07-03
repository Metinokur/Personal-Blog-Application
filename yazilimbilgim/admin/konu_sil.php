<?php !defined("admin") ? die("hacking"):null;?>

<?php

$id=@$_GET["id"];


?>



<div class="admin-icerik-sag">
    <h2>Konu Sil</h2>
    <div class="konular">
        <?php
        if (!empty($conn)) {
            $v=$conn->prepare("delete from konular where konu_id=?");
            $sil=$v->execute(array($id));
           if ($sil){
               echo '<div class="basarili-kayit-olundu"> Konu başarıyla silindi yönlendiriliyorsunuz...</div>';
               header("refresh:2; url=?do=konular");
           } else{
               echo '<div class="arama-hata">Konu silinirken bir hata oluştu...</div>';
           }
        }
        ?>
    </div>
</div>

