<?php !defined("admin") ? die("hacking"):null;?>


<div class="admin-icerik-sag">
    <h2>Üye Ekle</h2>
    <?php
    if ($_POST){

        $name      =strip_tags(trim($_POST["name"]));
        $sifre     =strip_tags(trim($_POST["sifre"]));
        $eposta    =strip_tags(trim($_POST["eposta"]));
        $rutbe     =$_POST["rutbe"];
        $hakkinda  =strip_tags($_POST["hakkinda"]);
        $onay      =$_POST["onay"];


        if (!$name || !$sifre || !$eposta  ){
            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';

        }elseif (!filter_var($eposta,FILTER_VALIDATE_EMAIL)){

            echo '<div class="gecerli-mail-hata"><i class="fa fa-times"></i> Lütfen Geçerli Bir Mail Adresi Girin</div>';

        }else{
            if (!empty($conn)) {
                $v=$conn->prepare("select * from uyeler where uye_adi=?");
                $v->execute(array($name));
                $c =$v->fetch(PDO::FETCH_ASSOC);
                $x =$v->rowCount();

            if ($x){
                   echo '<div class="arama-hata"><span style="color: red;">'.$name.'</span> adlı üye sistemde zaten var başka bir isim deneyin...</div>';
            }else{

                  $sifre=md5($sifre);

            if (!empty($conn)) {
                $ekle=$conn->prepare("insert into  uyeler set
                        uye_adi=?,
                         uye_sifre=?,
                        uye_eposta=?,   
                        uye_rutbe=?,
                         uye_hakkinda=?,
                        uye_onay=?  
                    
                    
                    ");
                $insert=$ekle->execute(array($name,$sifre,$eposta,$rutbe,$hakkinda,$onay));
                if ($insert){
                    echo '<div class="basarili-kayit-olundu">Uye Başarıyla eklendi...</div>';
                    header("refresh:2; url=?do=uyeler2");
                }else{
                    echo '<div class="arama-hata">Uye Eklenirken Hata Oluştu...</div>';
                }
            }
            }
            }
        }

    }else{
        ?>
        <div class="konular">
            <form action="" method="post">
                <ul>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Adi</span></li>
                    <li><input type="text" id="k1" name="name" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Şifre</span></li>
                    <li><input type="password" id="k6" name="sifre" placeholder="sifre giriniz" >
                        <label for="k6"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> e-posta</span></li>
                    <li><input type="text" id="k2" name="eposta" >
                        <label for="k2"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: crimson;"> <i class="fa fa-tags"></i>Rutbe</span></li>
                  <li><select name="rutbe" id="k3">
                          <option value="0">UYE</option>
                          <option value="1">ADMİN</option>
                      </select>
                  <label for="k3"></label>
                  </li>

                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Hakkında</span></li>
                    <li><textarea name="hakkinda" class="ckeditor" id="k4" cols="50" rows="15" > </textarea>
                        <label for="k4"></label>
                    </li>
                    <li>
                        <select name="onay" id="k5">
                            <option value="1"> ONAYLI </option>
                            <option value="0" >ONAYLI DEGİL</option>
                        </select>
                        <label for="k5"></label>
                    </li>

                    <li><button type="submit">Üyeyi Ekle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>

