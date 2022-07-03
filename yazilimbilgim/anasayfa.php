<?php !defined("index") ? die("hacking"):null;?>

<?php

include "slider.php";

if (!empty($conn)) {
    $kat=$conn->prepare("select * from katagoriler  where katagori_ust_id=? 
   order by katagori_id ");
    $kat->execute(array(1));
    $m = $kat->fetchAll(PDO::FETCH_ASSOC);
    $k = $kat->rowCount();
    if ($k){
        foreach ($m as $x){
            ?>
<div class="page-1">

    <div class="first-field">
        <h1> <?php   echo $x["katagori_adi"]; ?>
            <div class="page1-line"></div>
        </h1>
    </div>
    <div class="lesson-area-ana">
        <div class="lesson-area">
            <?php
                    $lesson=$conn->prepare("select * from konular inner join katagoriler on katagoriler.katagori_id=konular.konu_katagori where   konu_durum=? and katagori_id=? order by konu_id desc limit 6");
                    $lesson->execute(array(1,$x["katagori_id"]));
                    $a = $lesson->fetchAll(PDO::FETCH_ASSOC);
                    $b = $lesson->rowCount();
                    if ($b){
                        foreach ($a as $r){
                            ?>


            <div class="img-card-lesson">
                <img src=" <?php echo $r["konu_resim"]; ?>" alt="konu-resim">
                <h2> <i class="fa fa-chevron-right"></i> <?php echo substr($r["konu_baslik"],0,22); ?>... </h2>
                <div class="img-yazi-leeson">
                    <a href="?do=devam&id=<?php echo $r["konu_id"]; ?> "> Devamını Oku...</a>
                </div>
            </div>

            <?php

                        }

                    }
                    ?>
        </div>
    </div>
    <div class="read-more">
        <a href="?do=kategori&id=<?php echo $r["katagori_id"]; ?>"> daha fazla <?php   echo $x["katagori_adi"]; ?> </a>
    </div>


</div>
<?php
        }

    }

}
?>

<div class="support">
    <i class="fab fa-instagram fa-2x"></i>
    <p> yazılım alanında ilerlemek ve bize destek olmak isterseniz instagram üzerinden
        bizi takip edebilir, daha fazla tasarıma ve bilgiye ulaşabilirsiniz.</p>

    <a href="https://www.instagram.com/okursoft/ " target="_blank"> Takip et </a>



</div>


<?php
if (!empty($conn)) {
    $kat2=$conn->prepare("select * from katagoriler  where katagori_ust_id=? 
   order by katagori_id ");
    $kat2->execute(array(0));
    $p = $kat2->fetchAll(PDO::FETCH_ASSOC);
    $l = $kat2->rowCount();
    if ($l){
        foreach ($p as $e) {
            ?>
<div class="page-1">

    <div class="first-field">
        <h1> <?php echo $e["katagori_adi"]; ?>
            <div class="page1-line"></div>
        </h1>
    </div>
    <div class="lesson-area-ana">
        <div class="lesson-area">
            <?php
                    $lesson = $conn->prepare("select * from konular inner join katagoriler on katagoriler.katagori_id=konular.konu_katagori where   konu_durum=? and katagori_id=? order by konu_id desc limit 3 ");
                    $lesson->execute(array(1, $e["katagori_id"]));
                    $f = $lesson->fetchAll(PDO::FETCH_ASSOC);
                    $d = $lesson->rowCount();
                    if ($d) {
                        foreach ($f as $r) {
                            ?>


            <div class="img-card-lesson">
                <img src=" <?php echo $r["konu_resim"]; ?>" alt="konu-resim">
                <h2><i class="fa fa-chevron-right"></i> <?php echo substr($r["konu_baslik"], 0, 23); ?>... </h2>
                <div class="img-yazi-leeson">
                    <a href="?do=devam&id=<?php echo $r["konu_id"]; ?> "> Devamını Oku...</a>
                </div>
            </div>

            <?php

                        }

                    }
                    ?>
        </div>
    </div>
    <div class="read-more">
        <a href="?do=kategori&id=<?php echo $r["katagori_id"]; ?>"> daha fazla <?php echo $e["katagori_adi"]; ?> </a>
    </div>


</div>
<?php
        }

    }

}
?>


<div class="about-me">
    <i class="fas fa-phone fa-2x"></i>
    <p> Yazılım alanında bilgi almak,yazdığınız kodların hatalarına
        çözüm bulmak,projelerinize katkıda bulunmak ve yazılım alanına nasıl adım atabilirim
        gibi sorunlara cevap arıyorsanız iletişime geçerek yardım alabilirsiniz.
    </p>

    <a href="?do=iletisim"> İletişime geç </a>


</div>