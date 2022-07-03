<?php !defined("index") ? die("hacking"):null;?>

<?php

if ($_SESSION){

if ($_POST){

    $name=strip_tags(trim($_POST["name"]));
    $gonderen=strip_tags(trim($_POST["gonderen"]));
    $baslik=strip_tags(trim($_POST["baslik"]));
    $aciklama=strip_tags(trim($_POST["aciklama"]));

    if (!$name ||  !$baslik || !$aciklama){

        echo '<div class="arama-hata"> <span style="color: red;"> * </span> Boş Alanları Doldurmanız Gerekiyor </div>';
    }else{

        if (!empty($conn)) {
            $v=$conn->prepare("select * from uyeler where uye_adi=?");
            $v->execute(array($name));
            $m =$v->fetch(PDO::FETCH_ASSOC);
            $c =$v->rowCount();

            if ($c){
                $kayit=$conn->prepare("insert into mesajlar set 
                      mesaj_kime=?,
                      mesaj_gonderen=?,
                      mesaj_baslik=?,
                     mesaj_aciklama=?
");
                $k=$kayit->execute(array($m["uye_id"],$gonderen,$baslik,$aciklama));

                if ($k){
                    echo '<div class="basarili-kayit-olundu"><span style="color: #00b6e7;"><i class="fa fa-check"></i> </span>  mesajınız başarıyla gönderildi...</div>';
                    header("refresh:1; url=?do=mesaj");
                }else{
                      echo '<div class="arama-hata"> <i class="fa fa-times"></i>  mesaj gönderirken bir hata oluştu</div>';
                }

            }else{
                echo '<div class="arama-hata"><span style="color: red; font-size: 18px;">'.$name.'</span> adlı üye sistemde kayıtlı gözükmüyor</div>';
            }

        }

    }

}else{
?>
    <div class="mesaj-gonderme-form">
        <form action="" method="post">

        <ul>
            <li><i class="fa fa-user"></i> Alıcı  <span style="color: red;"> * </span></li>
            <li>
                <input type="text" id="msg1" name="name" required>
                <label for="msg1"></label>
            </li>
            <li> <input type="hidden"  value="<?php echo $_SESSION["uye"]; ?>" name="gonderen" >
            </li>
            <li><i class="fa fa-book"></i> Başlık <span style="color: red;"> * </span></li>
            <li> <input type="text" id="msg4" name="baslik" placeholder="mesaj başlığını girin">
            <label for="msg4"></label>
            </li>
            <li><i class="fas fa-volume-up"></i> Açıklama <span style="color: red;"> * </span></li>
            <li><textarea name="aciklama" id="msg3" cols="50" rows="8" required> </textarea>
            <label for="msg3"></label>
            </li>
            <li><button type="submit" >GÖNDER </button></li>
        </ul>
        </form>
    </div>

<?php

}


}else{
    echo '<div class="arama-hata">Üye olmadan Mesaj Gönderemessiniz...</div>';
}

?>
