<?php !defined("index") ? die("hacking"):null;?>


<?php
 /* if ($_SESSION){  */
    $uye=@$_GET["uye"];

    /*
       <?php
    if($_SESSION["uye"]== $uye){
           echo '<span><a href="?do=profil_duzenle&uye='.$_SESSION["uye"].' ">Düzenle</a></span>';
     }
        profil düzenleme kısmı için kullanılabilir.
    ?>


<span><a href="?do=profil_duzenle&uye=<?php echo $_SESSION["uye"]; ?> ">Düzenle</a></span>


      */

    if (!empty($conn)) {
        $profil=$conn->prepare("select * from uyeler where uye_adi=?");
        $profil->execute(array($uye));
        $m =$profil->fetch(PDO::FETCH_ASSOC);
       $v = $profil->rowCount();

       if ($v){
           ?>
             <div class="profil-uye">
                 <div class="profil-alan">
                   <h2>Profil Bölümü
                       <?php
                       if($_SESSION){
                           if($_SESSION["uye"]== $uye){
                            echo '<span><a href="?do=profil_duzenle&uye='.$_SESSION["uye"].' ">Düzenle</a></span>';
                           }
                       }
                      ?>

                   </h2>
                 <ul>
                     <li><span style=" font-weight: 600;">Adı: </span><?php echo $m["uye_adi"];  ?> </li>
                     <li><span style=" font-weight: 600;">eposta: </span><?php echo $m["uye_eposta"];  ?> </li>
                     <li><span style=" font-weight: 600;">Hakkında: </span><?php echo $m["uye_hakkinda"];  ?> </li>
                     <li><span style=" font-weight: 600;">Kayıt Tarihi:  </span><?php echo  date(" d/m/Y ",strtotime( $m["uye_tarih"]));  ?> </li>
                 </ul>
             </div>
             </div>

           <?php
       }else{
           echo "<div class='arama-hata'>Böyle Bir Üye Sistemde Kayıtlı Gözükmüyor</div>";
       }

    }

/*
}else{
    echo '<div class="arama-hata">Üye Olmadan Profil Bölümünü Göremessiniz...</div>';
}
*/

?>
