<?php !defined("admin") ? die("hacking"):null;?>

<?php

$id=@$_GET["id"];

if (!empty($conn)) {
    $v=$conn->prepare("select * from uyeler where uye_id=?");
    $v->execute(array($id));
    $m =$v->fetch(PDO::FETCH_ASSOC);
}

?>




<div class="admin-icerik-sag">
    <h2>Uye Düzenle</h2>
    <?php
    if ($_POST){

        $name      =strip_tags(trim($_POST["name"]));
        $sifre     =strip_tags(trim($_POST["sifre"]));
        $eposta    =strip_tags(trim($_POST["eposta"]));
        $rutbe     =strip_tags(trim($_POST["rutbe"]));
        $hakkinda  =strip_tags(trim($_POST["hakkinda"]));
        $onay      =strip_tags(trim($_POST["onay"]));


        if (!$name || !$eposta  ){
            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';
        }elseif (!filter_var($eposta,FILTER_VALIDATE_EMAIL)){

            echo '<div class="gecerli-mail-hata"><i class="fa fa-times"></i> Lütfen Geçerli Bir Mail Adresi Girin</div>';

        }else{

            if ($sifre){
                $sifre=md5($sifre);
            }else{
                $sifre=$m["uye_sifre"];
            }

            $guncelle=$conn->prepare("update  uyeler set
                    uye_adi=?,
                     uye_sifre=?,
                    uye_eposta=?,
                    uye_rutbe=?,
                    uye_hakkinda=?,
                    uye_onay=? where uye_id=?
                
                
                ");
            $update=$guncelle->execute(array($name,$sifre,$eposta,$rutbe,$hakkinda,$onay,$id));
            if ($update){
                echo '<div class="basarili-kayit-olundu">Uye Başarıyla Güncellendi...</div>';
                header("refresh:2; url=?do=uyeler2");
            }else{
                echo '<div class="arama-hata">Uye Eklenirken Hata Oluştu...</div>';
            }
        }

    }else{
        ?>
        <div class="konular">
            <form action="" method="post">
                <ul>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Başlık</span></li>
                    <li><input type="text" id="k1" name="name" value="<?php echo $m["uye_adi"]; ?>">
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Şifre</span></li>
                    <li><input type="text" id="k2" name="sifre" placeholder=" yeni sifre giriniz">
                        <label for="k2"></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fas fa-envelope"></i> e-posta </span></li>
                    <li><input type="text" id="k6" name="eposta" value="<?php echo $m["uye_eposta"]; ?>">
                        <label for="k6"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: crimson;"> <i class="fa fa-tags"></i>  Rutbe </span></li>
                      <li><select name="rutbe" id="k3">
                        <option value="0" <?php echo $m["uye_rutbe"]== 0  ? 'selected':null; ?> >UYE</option>
                         <option value="1" <?php echo $m["uye_rutbe"]== 1  ? 'selected':null; ?> >ADMİN</option>
                        </select>
                      <label for="k3"></label>
                      </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Üye hakkında </span></li>
                    <li><textarea name="hakkinda" id="k4" cols="50" rows="15" ><?php echo $m["uye_hakkinda"]; ?></textarea>
                        <label for="k4"></label>
                    </li>
                    <li>
                        <select name="onay" id="k5">
                            <option value="1" <?php echo $m["uye_onay"]==1 ? 'selected':null; ?> >ONAYLI</option>
                            <option value="0" <?php echo $m["uye_onay"]==0 ? 'selected':null; ?> >ONAYLI DEĞİL</option>
                        </select>
                        <label for="k5"></label>
                    </li>

                    <li><button type="submit">Uyeyi Düzenle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>

