<?php !defined("index") ? die("hacking"):null;?>
<?php

if ($_SESSION){
    if ($_POST){

       $baslik=strip_tags(trim($_POST["baslik"]));
        $resim=strip_tags(trim($_POST["resim"]));
        $kategori=$_POST["kategori"];
        $aciklama=strip_tags($_POST["aciklama"]);
        if (!$baslik || !$resim || !$aciklama){
            echo '<div class="arama-hata"> <span style="color: red;"> * </span> gerekli alanları doldurmanız gerekiyor</div>';

        } else{

            if (!empty($conn)) {
                $v=$conn->prepare("select * from konular where konu_baslik=?");
                $v->execute(array($baslik));
                $a =$v->fetchAll(PDO::FETCH_ASSOC);
                $g =$v->rowCount();
                if ($g){
                    echo '<div class="hataaynıkonu"><i class="fas fa-times"></i> Böyle Bir Konu Daha Önce Açılmış Başka Konu Deneyin</div>';
                }else{

                        $v = $conn->prepare("insert into konular set 
                                    konu_baslik=?,
                         konu_aciklama=?,
                         konu_katagori=?,
                         konu_resim=?,
                         konu_ekleyen=?




                               
                               ");
                    $kayit =  $v->execute(array($baslik,$aciklama,$kategori,$resim,$_SESSION["uye"]));
                    if (  $kayit){
                        echo '<div class="basarilikonueklendi"> <i class="fas fa-check"></i> Konu Başarıyla Eklendi</div>';
                         header("refresh:2; url=index.php");
                    }else{
                        echo '<div class="hataaynıkonu"><i class="fas fa-times"></i> konu eklerken bir hata oluştu</div>';
                    }

                }

            }
        }

    }else{
        ?>
        <div class="konuekle-div">

            <form action="" method="post">
        <ul>
            <li><i class="fas fa-angle-double-right"></i> Başlık  <span style="color: red;"> * </span></li>
            <li><input type="text" id="1" required name="baslik" placeholder="konu basligi girin" >
                <label for="1" ></label>  </li>
            <li><span style="margin-top: 8px;"><i class="fas fa-images"></i> Konu Resim  <span style="color: red;"> * </span> </span></li>
            <li><input type="text" id="2"   required name="resim" placeholder="resim kodunu girin" >
                <label for="2" ></label> </li>
         <select name="kategori" id="4">
             <?php
             if (!empty($conn)) {
                 $v=$conn->prepare("select * from katagoriler");
                 $v->execute(array());
                 $t =$v->fetchAll(PDO::FETCH_ASSOC);
                 foreach ($t as $w){
                     echo '<option value="'.$w["katagori_id"].'">'.$w["katagori_adi"].'</option>';
                 }
             }
             ?>
         </select>
            <li><i class="fas fa-volume-up"></i> Konu Açıklaması <span style="color: red;"> * </span> </li>
            <li><textarea name="aciklama" id="3" cols="55" rows="10"> </textarea>
            <label for="3"></label></li>
            <li><button type="submit">GÖNDER  </button></li>
        </ul>

            </form>
        </div>

<?php
    }

}else{
    echo '<div>Üye Olmadan Konu Ekleyemessiniz</div>';
}

?>
