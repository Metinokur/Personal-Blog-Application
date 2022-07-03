<?php !defined("admin") ? die("hacking"):null;?>


<?php

$id=@$_GET["id"];

if (!empty($conn)) {
    $v=$conn->prepare("select * from konular where konu_id=?");
    $v->execute(array($id));
    $m =$v->fetch(PDO::FETCH_ASSOC);
}

?>




<div class="admin-icerik-sag">
    <h2>Konu Düzenle</h2>
    <?php
   if ($_POST){

       $baslik   =strip_tags(trim($_POST["baslik"]));
       $resim     =strip_tags(trim($_POST["resim"]));
       $kategori  =strip_tags(trim($_POST["kategori"]));
       $aciklama  =$_POST["aciklama"];
       $onay      =strip_tags(trim($_POST["onay"]));
       $ekleyen   =strip_tags(trim($m["konu_ekleyen"]));

       if (!$baslik || !$resim || !$aciklama){
             echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';
       }else{
                $guncelle=$conn->prepare("update  konular set
                    konu_baslik=?,
                     konu_resim=?,
                    konu_katagori=?,
                    konu_aciklama=?,
                    konu_durum=?,
                    konu_ekleyen=? where konu_id=?
                
                
                ");
                $update=$guncelle->execute(array($baslik,$resim,$kategori,$aciklama,$onay,$ekleyen,$id));
                if ($update){
                    echo '<div class="basarili-kayit-olundu">Konu Başarıyla Güncellendi...</div>';
                    header("refresh:2; url=?do=konular");
                }else{
                     echo '<div class="arama-hata">Konu düzenlenirken Hata Oluştu...</div>';
                }
       }

   }else{
    ?>
       <div class="konular">
           <form action="" method="post">
           <ul>
               <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Başlık</span></li>
               <li><input type="text" id="k1" name="baslik" value="<?php echo $m["konu_baslik"]; ?>">
               <label for="k1"><span style="color: red;">*</span></label>
               </li>
               <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Konu Resim</span></li>
               <li><input type="text" id="k2" name="resim" value="<?php echo $m["konu_resim"]; ?>">
               <label for="k2"><span style="color: red;">*</span></label>
               </li>
               <li><span style="color: crimson;"> <i class="fa fa-tags"></i> Kategoriler</span></li>
               <li>
                   <select name="kategori"  id="k3" >
                       <?php
                       $b=$conn->prepare("select * from katagoriler order by katagori_id desc ");
                       $b->execute(array());
                       $d =$b->fetchAll(PDO::FETCH_ASSOC);

                       foreach ($d as $c){
                           echo '<option value="'.$c["katagori_id"].'"';
                           echo $m["konu_katagori"] == $c["katagori_id"] ? 'selected':null;
                           echo '>'.$c["katagori_adi"].'</option>';
                       }

                       ?>
                   </select>
                   <label for="k3"></label>
               </li>
               <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Açıklama</span></li>
               <li><textarea name="aciklama" class="ckeditor"  id="k4" cols="50" rows="15" ><?php echo $m["konu_aciklama"]; ?></textarea>
               <label for="k4"><span style="color: red;">*</span></label>
               </li>
               <li>
                   <select name="onay" id="k5">
                       <option value="1" <?php echo $m["konu_durum"]==1 ? 'selected':null; ?> >ONAYLI</option>
                       <option value="0" <?php echo $m["konu_durum"]==0 ? 'selected':null; ?> >ONAYLI DEĞİL</option>
                   </select>
                   <label for="k5"></label>
               </li>

               <li><button type="submit">Konuyu Düzenle <i class="fa fa-check"></i> </button></li>
           </ul>
           </form>
       </div>

    <?php
}

    ?>
</div>

