<?php !defined("admin") ? die("hacking"):null;?>

<div class="admin-icerik-sag">
    <h2> Yorumlar İçin Toplu Onay</h2>
    <?php
  error_reporting(0);
    $onayla=$_POST["onayla"];

    $a=implode(",",$onayla);

    if (!empty($conn)) {

        $toplu=$conn->query("update yorumlar set
                    
                    yorum_onay =1  where  yorum_id in($a) ");


        if ($toplu){
                echo '<div class="basarili-kayit-olundu"> seçilen yorum başarıyla güncellendi yönlendiriliyorsunuz...</div>';
            header("refresh:2; url=?do=yorumlar2");
        }else{
            echo '<div class="arama-hata">seçilen yorum onaylanırken bir hata oluştu</div>';
        }
    }

    ?>
</div>
