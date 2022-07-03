<?php !defined("admin") ? die("hacking"):null;?>

<?php

/*  konular için   */
if (!empty($conn)) {
    $konular=$conn->prepare("select * from konular inner join katagoriler on katagoriler.katagori_id=konular.konu_katagori");
    $konular->execute(array());
    $konular->fetchAll(PDO::FETCH_ASSOC);
    $konu = $konular->rowCount();
}


if (!empty($conn)) {
    $ko=$conn->prepare("select * from konular inner join katagoriler on katagoriler.katagori_id=konular.konu_katagori where konu_durum=?");
    $ko->execute(array(0));
    $ko->fetchAll(PDO::FETCH_ASSOC);
    $konuonay = $ko->rowCount();
}

/*  uyeler için  */

if (!empty($conn)) {
    $uyeler=$conn->prepare("select * from  uyeler ");
    $uyeler->execute(array());
    $uyeler->fetchAll(PDO::FETCH_ASSOC);
    $uye  = $uyeler->rowCount();
}


if (!empty($conn)) {
    $uy=$conn->prepare("select * from uyeler  where uye_onay=?");
    $uy->execute(array(0));
    $uy->fetchAll(PDO::FETCH_ASSOC);
    $uyeonay = $uy->rowCount();
}


/*  yorumlar için  */

if (!empty($conn)) {
    $yorumlar=$conn->prepare("select * from  yorumlar ");
    $yorumlar->execute(array());
    $yorumlar->fetchAll(PDO::FETCH_ASSOC);
    $yorum  = $yorumlar->rowCount();
}


if (!empty($conn)) {
    $yor=$conn->prepare("select * from yorumlar  where yorum_onay=?");
    $yor->execute(array(0));
    $yor->fetchAll(PDO::FETCH_ASSOC);
    $yorumonay = $yor->rowCount();
}


/*  kategoriler için   */


if (!empty($conn)) {
    $kategoriler=$conn->prepare("select * from  katagoriler ");
    $kategoriler->execute(array());
    $kategoriler->fetchAll(PDO::FETCH_ASSOC);
    $kategori  = $kategoriler->rowCount();
}

if (!empty($conn)) {
    $kateustid=$conn->prepare("select * from  katagoriler where katagori_ust_id=? ");
    $kateustid->execute(array(1));
    $kateustid->fetchAll(PDO::FETCH_ASSOC);
    $katustid  = $kateustid->rowCount();
}

if (!empty($conn)) {
    $ktust=$conn->prepare("select * from  katagoriler where katagori_ust_id=? ");
    $ktust->execute(array(0));
    $ktust->fetchAll(PDO::FETCH_ASSOC);
    $ktustid  = $ktust->rowCount();
}


/* sabit sayfalar için  */

if (!empty($conn)) {
    $sabitsayfa=$conn->prepare("select * from  sabit_sayfalar ");
    $sabitsayfa->execute(array());
    $sabitsayfa->fetchAll(PDO::FETCH_ASSOC);
    $sbtsayfa  = $sabitsayfa->rowCount();
}


?>



<div class="admin-icerik-sag">
    <h2>Admin Paneli Ana Sayfa</h2>

    <div class="anasayfa">
        <h3><a href="?do=konular"><span style="color: #f1f1f1;">KONULAR</span>  </a></h3>
        <P> <span style="color: #25d366;">Toplam Konu </span> : <?php echo $konu; ?> <br />
            <span style="color: #25d366;"> Onay Bekleyen Konu  </span> : <?php echo $konuonay; ?>
        </P>
    </div>

    <div class="anasayfa">
        <h3><a href="?do=uyeler2"><span style="color: #f1f1f1;">UYELER</span></a></h3>
        <P>
           <span style="color: #25d366;"> Toplam Uye </span> : <?php echo $uye; ?> <br />
           <span style="color: #25d366;"> Onay Bekleyen  Uye </span> : <?php echo $uyeonay; ?>

        </P>
    </div>

    <div class="anasayfa">
        <h3><a href="?do=yorumlar2"><span style="color: #f1f1f1;">YORUMLAR</span></a></h3>
        <P>
          <span style="color: #25d366;">  Toplam Yorum  </span>: <?php echo $yorum; ?> <br />
          <span style="color: #25d366;">  Onay Bekleyen  Yorum  </span>: <?php echo $yorumonay; ?>

        </P>
    </div>

    <div class="anasayfa">
        <h3><a href="?do=kategoriler2"><span style="color: #f1f1f1;">KATEGORİLER</span></a></h3>
        <P>
          <span style="color: #25d366;">  Toplam kategori  </span>: <?php echo $kategori; ?> <br />
          <span style="color: #25d366;">  Programlama Kategori  </span>  : <?php echo $katustid; ?> <br />
         <span style="color: #25d366;">   Web Tasarım Kategori  </span>  : <?php echo $ktustid; ?> <br />

        </P>
    </div>

    <div class="anasayfa">
        <h3><a href="?do=sabit_sayfalar"><span style="color: #f1f1f1;">SABİT SAYFALAR</span></a></h3>
        <P>
          <span style="color: #25d366;">  Sabit Sayfa </span> : <?php echo $sbtsayfa; ?> <br />

        </P>
    </div>

      <div style="clear: both;"></div>

    <div class="sunum">
        <strong style="color: #00b6e7;"> Php Sürümü:  </strong> <?php echo phpversion(); ?> <strong style="color: #00b6e7;">version</strong><br />  <br />
        <em style="color: #25d366; font-size: 18px;"> you shouldn't let them bully you  </em>  <br />


    </div>


</div>
