<?php !defined("index") ? die("hacking"):null;?>


<div class="left"> <!-- at the start of the left div -->
    <?php
   $ara =@ $_POST["ara"];
    if (!empty($conn)) {
        $konu = $conn->prepare("select * from konular inner join katagoriler
    on katagoriler.katagori_id=konular.konu_katagori inner join uyeler on uyeler.uye_adi=konular.konu_ekleyen where konu_durum=? and konu_baslik  like ?  ");
        $konu->execute(array(1,'%'.$ara.'%'));
        $m =$konu->fetchAll(PDO::FETCH_ASSOC);
        $f =$konu->rowCount();

     if ($f){
         foreach ($m as $x){
             ?>
             <div class="left2">
                 <h2><i class="fa fa-caret-right"></i> <?php echo $x["konu_baslik"]; ?>
                     <div class="h2line"></div>
                 </h2>
                 <h5><i class="fa fa-tags"></i>  <?php echo $x["katagori_adi"]; ?>   <span style="margin-left: 12px;"><i style="color: #c41a16; " class="fa fa-pencil"></i> <a style="color: #242424;  font-weight: 550;" href="?do=profil&uye=<?php echo $x["uye_adi"]; ?>"> <?php echo $x["uye_adi"]; ?></a> </span>
                     <span style="margin-left: 18px;"><i class="fas fa-glasses"></i> okunma: <?php echo $x["konu_hit"]; ?> </span>
                     <span style=" float: right; margin-right: 8px; "><i class="far fa-calendar-alt"></i> : <?php  echo date("d-m-Y",strtotime($x["konu_tarih"])); ?>  </span> </h5>

                 <div class="img-card">
                     <img src="<?php echo $x["konu_resim"]; ?>" alt="konu-resim">
                     <h2>   <i class="fa fa-chevron-down"></i> </h2>
                     <div class="img-yazi">
                         <a href="?do=devam&id=<?php echo $x["konu_id"]; ?>">Devamını Oku</a>
                     </div>
                 </div>
                 <p>
                     <?php echo substr($x["konu_aciklama"],0,520) ?>...
                 </p>

             </div>

             <?php
         }

     }else{
         echo '<div class="arama-hata"><i class="fas fa-search-minus"></i> Aramanıza Ait Hiç Sonuç Bulunamadı. </div>';
     }


    }

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
                    echo '<h3> <a href="?do=devam&id='.$r["konu_id"].'"><i class="fas fa-pencil-alt"></i> '.$r["konu_baslik"].'</a></h3>';
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
            <div class="line3"></div>
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

                    echo ' <h3><i class="fas fa-comments"></i> <a href="?do=devam&id='.$p["yorum_konu_id"].'">'.substr($p["yorum_mesaj"],0,52).'</a>... </h3>';
                }

            }else{
                echo '<div class="">  </div>';
            }
        }

        ?>



    </div> <!-- at the end of the right 4 div -->
</div> <!-- at the end of the RİGHT div -->


