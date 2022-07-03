<?php !defined("index") ? die("hacking"):null;?>
<?php

if ($_SESSION){

    $id= @$_GET["id"];

    if (!empty($conn)) {
        $v = $conn->prepare("delete from mesajlar where mesaj_id=? and mesaj_kime=? ");
        $sil= $v->execute(array($id,$_SESSION["id"]));
        $x = $v->rowCount();
        if ($x){

            if ($sil){
                echo '<div class="basarili-kayit-olundu"><span style="color: #00b6e7;"><i class="fa fa-check"></i></span> mesajınız başarıyla silindi</div>';
                header("refresh:2; url=?do=mesaj");
            }else{
                echo '<div class="arama-hata"> <span style="color: red;"><i class="fa fa-times"></i></span>mesajı silerken bir hata oluştu</div>';
            }

        }else{

            echo '<div class="arama-hata"><span style="color: red;"><i class="fa fa-times"></i></span>Yanlış bir mesajı silmeye çalıştınız</div>';

        }
    }

}

?>
