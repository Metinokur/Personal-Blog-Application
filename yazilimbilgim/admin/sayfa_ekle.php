<?php !defined("admin") ? die("hacking"):null;?>

<div class="admin-icerik-sag">
    <h2>Sayfa Ekle</h2>
    <?php
    if ($_POST){

        $name       =strip_tags(trim($_POST["name"]));
        $aciklama   =strip_tags(trim($_POST["aciklama"]));




        if (!$name   || !$aciklama){

            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';

        }else{

            if (!empty($conn)) {
                $kontrol = $conn->prepare("select * from sabit_sayfalar where sayfa_adi=?");
                $kontrol->execute(array($name));
                $listele = $kontrol->fetch(PDO::FETCH_ASSOC);
                $varmi = $kontrol->rowCount();
                if ($varmi){
                    echo '<div class="arama-hata"><span style="color: red;">'.$name.' </span>adlı sayfa zaten var başka sayfa deneyin...</div>';
                }else{



                    if (!empty($conn)) {
                        $guncelle=$conn->prepare("insert into  sabit_sayfalar set
                        sayfa_adi=?,
                         sayfa_aciklama=?
                          
                        
                    ");
                        $update=$guncelle->execute(array($name,$aciklama));
                        if ($update){
                            echo '<div class="basarili-kayit-olundu">Sayfa Başarıyla eklendi...</div>';
                            header("refresh:2; url=?do=sabit_sayfalar");
                        }else{
                            echo '<div class="arama-hata">Sayfa Eklenirken Hata Oluştu...</div>';
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
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Sayfa Adı </span></li>
                    <li><input type="text" id="k1" name="name" placeholder="sayfa adı" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>

                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Sayfa Açıklama </span></li>
                    <li><textarea name="aciklama" class="ckeditor" id="k4" cols="50" rows="15" ></textarea>
                        <label for="k4"><span style="color: red;">*</span></label>
                    </li>


                    <li><button type="submit"> Sayfayı Ekle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>


