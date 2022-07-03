<?php !defined("index") ? die("hacking"):null;?>


<?php

if ($_SESSION){

      $uye=@$_GET["uye"];
    if ($_SESSION["uye"]==$uye){
        if (!empty($conn)) {
            $v=$conn->prepare("select * from uyeler where uye_adi=?");
            $v->execute(array($uye));
            $m  =$v->fetch(PDO::FETCH_ASSOC);
           $t = $v->rowCount();
           if ($t){
               if ($_POST){

                   $mail=strip_tags(trim($_POST["email"]));
                   $sifre=strip_tags(trim($_POST["sifre"]));
                   $hakkinda=strip_tags(trim($_POST["hakkinda"]));
                   if (!$mail){

                       echo '<div class="gecerli-mail-hata"><i class="fas fa-times"></i> Boş Alanları Doldurmalısınız</div>';

                   }elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                       echo '<div class="gecerli-mail-hata"><i class="fa fa-times"></i> Lütfen Geçerli Bir Mail Adresi Girin</div>';
                   }else{

                     if ($sifre){
                         $sifre=md5($sifre);

                     }else{
                         $sifre=$m["uye_sifre"];
                     }
                      $guncelle=$conn->prepare("update uyeler set
                              uye_eposta=?,
                            uye_sifre=?,
                            uye_hakkinda=? where uye_adi=?
                      
                      ");

                    $profilguncelle = $guncelle->execute(array($mail,$sifre,$hakkinda,$_SESSION["uye"]));
                    if ($profilguncelle){
                        echo '<div class="basarili-kayit-olundu"><span style="color: #00b6e7;"><i class="fa fa-check"></i></span> Profiliniz Başarıyla Güncellendi</div>';
                        header("refresh:2; url=?do=profil&uye=$uye");
                    }else{
                        echo '<div class="gecerli-mail-hata"><i class="fa fa-times">Profil güncellenirken bir hata oluştu </div>';
                    }

                   }

               }else{
                ?>
                   <div class="profil-duzenle">

                       <form action="" method="post">
                       <ul>
                           <li><i class="fas fa-envelope"></i> e-mail</li>
                           <li> <input type="text" id="p1" value="<?php echo $m["uye_eposta"]; ?>" required name="email">
                           <label for="p1"></label>
                           </li>

                           <li><i class="fas fa-lock"></i> şifre</li>
                           <li> <input type="text" id="p2" name="sifre" placeholder="yeni şifrenizi giriniz">
                           <label for="p2"></label>

                           </li>
                           <li><i class="fas fa-user-check"></i> Hakkımda</li>
                           <li><textarea name="hakkinda" id="p3"  cols="50" rows="8"> <?php echo $m["uye_hakkinda"]; ?>  </textarea>
                           <label for="p3"></label>
                           </li>
                           <li><button type="submit" >PROFİLİ DÜZENLE </button></li>
                       </ul>
                       </form>
                   </div>


                   <?php
               }
           }else{
               echo '<div class="arama-hata">Böyle bir üye bulunamadı</div>';
           }
        }




    }else{
         echo '<div class="arama-hata">Yanlış bir yere girdiniz</div>';
        session_destroy();
    }




}else{
      echo '<div class="arama-hata">Üye olmadan profil düzenleyemessiniz</div>';
}



?>
