<?php !defined("index") ? die("hacking"):null;?>




<div class="left"> <!-- at the start of the left div -->
    <?php

    $id=@$_GET["id"];
    if (!empty($conn)) {
        $konu = $conn->prepare("select * from konular  inner join katagoriler on 
    katagoriler.katagori_id=konular.konu_katagori inner join uyeler on uyeler.uye_adi=konular.konu_ekleyen
where konu_id=? and konu_durum=?  ");
        $konu->execute(array($id,1));
        $x =$konu->fetch(PDO::FETCH_ASSOC);
        $d =$konu->rowCount();


        /* konu hit bölümü   */
        if (!@$_COOKIE["hit".$id]){
            $hit=$conn->prepare("update konular set konu_hit = konu_hit +1 where konu_id=? ");
            $hit->execute(array($id));
            setcookie("hit".$id,"_",time()+(60*60*24*30));
        }
        /* konu hit bölümü   */

        /* <a href="?do=profil&uye=<?php echo $x["uye_adi"]; ?>"> <?php echo $x["uye_adi"]; ?></a>   */

                   ?>

                   <div class="left2">
                       <h2><i class="fa fa-caret-right"></i> <?php echo $x["konu_baslik"]; ?>
                       <div class="h2line"></div>
                       </h2>

                       <h5> <i class="fa fa-tags"></i>  <?php echo $x["katagori_adi"]; ?>  <span style="margin-left: 12px;"><i style="color: #c41a16; " class="fa fa-pencil"></i> <a style="color: #242424;  font-weight: 550;" href="?do=profil&uye=<?php echo $x["uye_adi"]; ?>"> <?php echo $x["uye_adi"]; ?></a> </span>
                           <span style="margin-left: 18px;"><i class="fas fa-glasses"></i> okunma:<?php echo $x["konu_hit"]; ?> </span>
                           <span style=" float: right; margin-right: 8px; "><i class="far fa-calendar-alt"></i>: <?php  echo date("d-m-Y",strtotime($x["konu_tarih"])); ?>  </span> </h5>

                       <div class="devam-img">
                           <img src="<?php echo $x["konu_resim"]; ?>" alt="konu-resim">
                       </div>
                       <div class="devam-p">
                           <p>
                               <?php echo $x["konu_aciklama"]; ?>
                           </p>
                       </div>

                       <div class="lesson-done">
                           <div class="done-line"></div>
                           <i>konu sonu</i>
                       </div>

                   </div>



                   <div class="iliskili-yazılar">
                       <h4>İLİŞKİLİ KONULAR
                           <div class="iliski-line"></div>
                       </h4>

                       <?php
                          $kategori_id = $x["katagori_id"];
                           $kategori = $conn->prepare("select * from konular  inner join katagoriler on katagoriler.katagori_id=konular.konu_katagori
where  katagori_id=? and konu_durum=? order by konu_id desc limit 2");
                           $kategori->execute(array($kategori_id,1));
                           $m = $kategori->fetchAll(PDO::FETCH_ASSOC);
                           $d = $kategori->rowCount();
                           if ($d) {
                                foreach ($m as $c){
                                ?>
                                    <div class="iliski-konu">
                                   <div class="img-card-iliski">
                                       <img src="<?php echo $c["konu_resim"]; ?>" alt="konu-resim">
                                       <a href="?do=devam&id=<?php echo $c["konu_id"]; ?>"> <h2> <i class="fa fa-chevron-right"></i> <?php echo substr($c["konu_baslik"],0,23); ?>... </h2>   </a>
                                       <div class="img-yazi-iliski">
                                           <a href="?do=devam&id=<?php echo $c["konu_id"]; ?>"><?php echo substr($c["konu_baslik"],0,23); ?>...  </a>
                                       </div>
                                   </div>

                                      </div>
                               <?php

                                }

                           }

                      ?>

                   </div>

                   <div style="clear: both;margin-bottom: 10px;"></div>

                   <?php

    }



    /* comment send area   */
    /* comment  get from database   */
    if (!empty($conn)) {
    $yorumcekme=$conn->prepare("select * from yorumlar where yorum_konu_id=? and yorum_onay=? order by yorum_id desc");
    $yorumcekme->execute(array($id,1));
    $c =$yorumcekme->fetchAll(PDO::FETCH_ASSOC);
    $f =$yorumcekme->rowCount();
    if ($f){
        foreach ($c as $y){
            ?>
            <div class="comment-database">

                <h4>  <i class="fas fa-user fa-2x"></i> <div>  <?php echo $y["yorum_ekleyen"]?></div>
                      <?php echo date(" d/m/Y ",strtotime($y["yorum_tarih"]));  ?> </h4>
                <p>
                  <?php echo nl2br($y["yorum_mesaj"]); ?>
                </p>
            </div>

            <?php
        }
    }
    // else yazılıpta yorum yok yazdırılabilir.
 //   else{
 //     echo '<div class="yorum-yok-mesaj"><i class="far fa-comment"></i> Henüz Bu Konuya Hiç Yorum Eklenmemiş</div>';
//    }
        // sonu

    }

    /*  /* comment  get from database  done  */

if ($_POST){

    $name=strip_tags(trim($_POST["isim"]));
    $mail= strip_tags(trim($_POST["mail"]));
    $mesaj=strip_tags(trim($_POST["mesaj"]));
    if (!$name || !$mail || !$mesaj){

        echo '<div class="yorum-hata"> <span style="color: red;">*</span> Lütfen Boş Alanları Doldurunuz</div>';

    }else{

        if (!empty($conn)) {
            $yorum = $conn->prepare("insert into yorumlar set 
             yorum_ekleyen=?,
             yorum_eposta=?,
            yorum_mesaj=?,
            yorum_konu_id=?
   ");
            if ( !filter_var($mail,FILTER_VALIDATE_EMAIL)){
                echo '<div class="gecerli-mail-hata"><i class="fa fa-times"></i> Lütfen Geçerli Bir Mail Adresi Giriniz.</div>';
            }else{
                $ekle = $yorum->execute(array($name, $mail, $mesaj, $id));
                if ($ekle){

                    echo '<div class="yorum-basarili-gönderme"><i class="fas fa-check"></i>Yorumunuz Başarıyla Gönderildi Yönlendiriliyorsunuz</div>';
                    $url =$_SERVER["HTTPS_REFERER"];
                    header("refresh:2; url=$url");

                }else{
                    echo '<div class="yorum-hata"><i class="fa fa-times"></i>Yorum Eklenirken Bir Hata Oluştu </div>';
                }
            }

        }

    }

}else{
   if ($_SESSION){
       ?>
       <div class="yorum-area">
           <div class="mesajgöderme"> YORUM ALANI
              <div class="line8"></div>
           </div>
           <form action="" method="post">
               <ul>

                   <li>
                       <label for="ad-input"></label>
                       <input type="hidden" value="<?php echo $_SESSION["uye"]; ?>" id="ad-input" required name="isim" >
                   </li>

                   <li><label for="mail-input"></label>
                       <input type="hidden" value="<?php echo $_SESSION["eposta"]; ?>" id="mail-input" required name="mail">
                   </li>

                   <li><label for="mesaj-input"></label>
                       <textarea name="mesaj" class="yorum-uye"  id="mesaj-input"  cols="50" rows="8" required> </textarea> *
                   </li>
                   <li><button type="submit" >GÖNDER <i class="fas fa-paper-plane"></i></button></li>
               </ul>
           </form>
       </div>
       <?php
   }else{
       ?>
       <div class="yorum-area">
           <div class="mesajgöderme"> YORUM ALANI
               <div class="line8"></div>
           </div>
           <form action="" method="post">
               <ul>
                   <li><i class="fas fa-thumbtack"></i> Adınız</li>
                   <li>
                       <label for="ad-input"></label>
                       <input type="text" id="ad-input" required name="isim" > *
                   </li>
                   <li><i class="fas fa-pen-fancy"></i> E-mail</li>
                   <li><label for="mail-input"></label>
                       <input type="text" id="mail-input" required name="mail"> *
                   </li>

                   <li><label for="mesaj-input"></label>
                       <textarea name="mesaj" id="mesaj-input" required cols="50" rows="8"> </textarea> *
                   </li>
                   <li><button type="submit" >GÖNDER <i class="fas fa-paper-plane"></i></button></li>
               </ul>
           </form>
       </div>
       <?php
   }
}

    /* comment send area  done   */

    ?>





</div> <!-- at the end of the left div -->

<div class="right"> <!-- at the start of the RİGHT div -->

    <div class="right2">
        <h1> Son Konular
            <div class="line2"></div>
        </h1>
        <?php
        if (!empty($conn)) {
            $son_konular = $conn->prepare("select * from konular where konu_durum=? order by konu_id desc limit 8");
            $son_konular->execute(array(1));
            $l =$son_konular->fetchAll(PDO::FETCH_ASSOC);
            $k =$son_konular->rowCount();

            if ($k){
                foreach ($l as $r){
                    echo '<h3> <a href="?do=devam&id='.$r["konu_id"].'"> <i class="fas fa-pencil-alt"></i> '.$r["konu_baslik"].'</a></h3>';
                }

            }else{
                echo '<div class=""> Son Konu Bulunmuyor </div>';
            }
        }

        ?>

    </div>  <!-- at the end of the right 2 div -->


    <!-- at the start of the RİGHT 5 div -->

    <div class="right5">
        <h1> Web Tasarımlar
            <div class="linew"></div>
        </h1>
        <?php
        if (!empty($conn)) {
            $web = $conn->prepare("select * from katagoriler where  katagori_ust_id=? ");
            $web->execute(array(0));
            $d =$web->fetchAll(PDO::FETCH_ASSOC);
            $t =$web->rowCount();

            if ($t){
                foreach ($d as $c){
                    echo '<h3><a href="?do=kategori&id='.$c["katagori_id"].' "> <i class="fas fa-code"></i> '.$c["katagori_adi"].' </a></h3>';
                }

            }else{
                echo '<div class=""> web tasarım   Bulunmuyor </div>';
            }
        }

        ?>

    </div>


    <!-- at the end of the right 5 div -->



    <div class="right3">  <!-- at the start of the RİGHT3 div -->
        <h1> Çok Okunanlar
            <div class="line3"> </div>
        </h1>
        <?php
        if (!empty($conn)) {
            $son_konular = $conn->prepare("select * from konular where konu_durum=? order by konu_hit desc limit 8");
            $son_konular->execute(array(1));
            $l =$son_konular->fetchAll(PDO::FETCH_ASSOC);
            $k =$son_konular->rowCount();

            if ($k){
                foreach ($l as $r){
                    echo '<h3> <a href="?do=devam&id='.$r["konu_id"].' "><i class="fas fa-book-reader"></i> '.$r["konu_baslik"].'</a></h3>';
                }

            }else{
                echo '<div class=""> Son Konu Bulunmuyor </div>';
            }
        }

        ?>

    </div>  <!-- at the end of the right 3 div -->

    <div class="right4"> <!-- at the start of the right 4 div -->
        <h1>  Son Yorumlar
            <div class="line4"></div>
        </h1>
        <?php
        if (!empty($conn)) {
            $son_yorumlar = $conn->prepare("select * from yorumlar where yorum_onay=? order by yorum_konu_id desc limit 4");
            $son_yorumlar ->execute(array(1));
            $y = $son_yorumlar ->fetchAll(PDO::FETCH_ASSOC);
            $t = $son_yorumlar ->rowCount();

            if ($t){
                foreach ($y as $p){

                    echo ' <h3><i class="fas fa-comments"></i> <a href="?do=devam&id='.$p["yorum_konu_id"].'">'.substr($p["yorum_mesaj"],0,52).'</a>...  </h3>';
                }

            }else{
                echo '<div class=" "> </div>';
            }
        }

        ?>

    </div> <!-- at the end of the right 4 div -->

</div> <!-- at the end of the RİGHT div -->
