<?php !defined("index") ? die("hacking"):null;?>


<?php
if ($_POST){
    ob_start();
      $isim=strip_tags(trim($_POST["isim"]));
    $baslik=strip_tags(trim($_POST["baslik"]));
    $kime=$_POST["kime"];
    $aciklama=strip_tags(trim($_POST["aciklama"]));

    if (!$isim || !$baslik || !$aciklama){
        echo '<div class="arama-hata"><span style="color: red;"> * </span>Boş Alanları Doldurmalısınız...</div>';
    }else{

        if (!empty($conn)) {
            $kayit=$conn->prepare("insert into mesajlar set 
               mesaj_gonderen=?,
              mesaj_baslik=?,
             mesaj_kime=?,
             mesaj_aciklama=?
");
            $k =$kayit->execute(array($isim,$baslik,$kime,$aciklama));
            if ($k){

                echo '<div class="basarili-kayit-olundu"><span style="color: #00b6e7;"><i class="fa fa-check"></i></span> Mesajınız Alınmıştır Teşekkürler :) </div>';
                header("refresh:2; url=?do=iletisim");
               exit();
            }else{

                echo '<div class="arama-hata">Mysql hatası :( </div>';
            }

        }

    }

}else{

    if ($_SESSION){
        ?>
        <div class="ana-iletisim-form">

            <form action="" method="post">
                <ul>
                    <li> <input type="hidden" value="<?php echo $_SESSION["uye"]; ?>" id="il1" name="isim" >
                        <label for="il1"></label>
                    </li>
                    <li><i class="fa fa-book"></i> Başlık  <span style="color: red;"> * </span></li>
                    <li> <input type="text" id="il2" name="baslik"  required placeholder="konu başlığı girin">
                        <label for="il2"></label>
                    </li>
                    <li><i class="fas fa-asterisk"></i> Kime</li>
                    <li>
                        <select name="kime" id="il4">
                            <?php
                            if (!empty($conn)) {
                                $v=$conn->prepare("select * from uyeler where uye_rutbe=?");
                                $v->execute(array(1));
                                $m =$v->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($m as $c){
                                    echo '<option value="'.$c["uye_id"].'">'.$c["uye_adi"].'</option>';
                                }

                            }
                            ?>
                        </select>
                        <label for="il4"></label>
                    </li>
                    <li><i class="fas fa-volume-up"></i> Açıklama  <span style="color: red;"> * </span></li>
                    <li><textarea name="aciklama" id="il3" required cols="55" rows="9" > </textarea>
                        <label for="il3"></label>
                    </li>
                    <li><button type="submit" > GÖNDER  </button></li>
                </ul>
            </form>
        </div>

            <?php
    }else{
        ?>


        <div class="ana-iletisim-form">
            <form action="" method="post">
            <ul>
                <li><i class="fa fa-user"></i> Adınız  <span style="color: red;"> * </span></li>
                <li> <input type="text" id="il1" required name="isim" >
                    <label for="il1"></label>
                </li>
                <li><i class="fa fa-book"></i> Başlık  <span style="color: red;"> * </span></li>
                <li> <input type="text" id="il2" name="baslik"  required placeholder="konu başlığı girin">
                    <label for="il2"></label>
                </li>
                <li><i class="fas fa-asterisk"></i> Kime</li>
                <li>
                    <select name="kime" id="il4">
                        <?php
                        if (!empty($conn)) {
                            $v=$conn->prepare("select * from uyeler where uye_rutbe=?");
                            $v->execute(array(1));
                            $m =$v->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($m as $c){
                                echo '<option value="'.$c["uye_id"].'">'.$c["uye_adi"].'</option>';
                            }

                        }
                        ?>
                    </select>
                    <label for="il4"></label>
                </li>
                <li><i class="fas fa-volume-up"></i> Açıklama  <span style="color: red;"> * </span></li>
                <li><textarea name="aciklama" required id="il3" cols="55" rows="9"  > </textarea>
                    <label for="il3"></label>
                </li>
                <li><button type="submit" > GÖNDER   </button></li>
            </ul>
            </form>
        </div>



        <?php
    }

}

?>


