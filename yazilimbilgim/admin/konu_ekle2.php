<?php !defined("admin") ? die("hacking"):null;?>



<div class="admin-icerik-sag">
    <h2>Konu Ekle</h2>
    <?php

    if ($_POST){

        $baslik    =strip_tags(trim($_POST["baslik"]));
        $resim     =strip_tags(trim($_POST["resim"]));
        $kategori  =strip_tags(trim($_POST["kategori"]));
        $aciklama  =$_POST["aciklama"];
        $onay      =strip_tags(trim($_POST["onay"]));


        if (!$baslik || !$resim || !$aciklama){
            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';
        }else{
            if (!empty($conn)) {
                $guncelle=$conn->prepare("insert into  konular set
                        konu_baslik=?,
                         konu_resim=?,
                        konu_katagori=?,
                        konu_aciklama=?,
                        konu_durum=?,
                        konu_ekleyen=?  
                    
                    
                    ");
                $update=$guncelle->execute(array($baslik,$resim,$kategori,$aciklama,$onay,$_SESSION["uye"]));
                if ($update){
                    echo '<div class="basarili-kayit-olundu">Konu Başarıyla eklendi...</div>';
                    header("refresh:2; url=?do=konular");
                }else{
                    echo '<div class="arama-hata">Konu Eklenirken Hata Oluştu...</div>';
                }
            }

        }

    }else{
        ?>
        <div class="konular">
            <form action="" method="post">
                <ul>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Başlık</span></li>
                    <li><input type="text" id="k1" name="baslik" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Konu Resim</span></li>
                    <li><input type="text" id="k2" name="resim" >
                        <label for="k2"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: crimson;"> <i class="fa fa-tags"></i> Kategoriler</span></li>
                    <li>
                        <select name="kategori"  id="k3" >
                            <?php
                            if (!empty($conn)) {
                                $b=$conn->prepare("select * from katagoriler order by katagori_id desc ");
                                $b->execute(array());
                                $d =$b->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($d as $c){
                                    echo '<option value="'.$c["katagori_id"].'">'.$c["katagori_adi"].'</option>';
                                }
                            }


                            ?>
                        </select>
                        <label for="k3"></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Açıklama</span></li>
                    <li><textarea name="aciklama" class="ckeditor" id="k4" cols="50" rows="15" > </textarea>
                        <label for="k4"><span style="color: red;">*</span></label>
                    </li>
                    <li>
                        <select name="onay" id="k5">
                            <option value="1">ONAYLI </option>
                            <option value="0" >ONAYLI DEGİL</option>
                        </select>
                        <label for="k5"></label>
                    </li>

                    <li><button type="submit">Konuyu Ekle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>

