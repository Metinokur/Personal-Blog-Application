<?php !defined("admin") ? die("hacking"):null;?>

<div class="admin-icerik-sag">
    <h2>Kategori Ekle</h2>
    <?php
    if ($_POST){

        $name       =strip_tags(trim($_POST["name"]));
        $aciklama   =strip_tags(trim($_POST["aciklama"]));
        $ustid      =strip_tags(trim($_POST["ustid"]));



        if (!$name   || !$aciklama){

            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';

        }else{

            if (!empty($conn)) {
                $kontrol = $conn->prepare("select * from katagoriler where katagori_adi=?");
                $kontrol->execute(array($name));
                $listele = $kontrol->fetch(PDO::FETCH_ASSOC);
                $varmi = $kontrol->rowCount();
                if ($varmi){
                    echo '<div class="arama-hata"><span style="color: red;">'.$name.' </span>adlı kategori zaten var başka kategori deneyin...</div>';
                }else{



            if (!empty($conn)) {
                $guncelle=$conn->prepare("insert into  katagoriler set
                        katagori_adi=?,
                         katagori_aciklama=?,
                          katagori_ust_id=?
                        
                    ");
                $update=$guncelle->execute(array($name,$aciklama,$ustid));
                if ($update){
                    echo '<div class="basarili-kayit-olundu">Kategori Başarıyla eklendi...</div>';
                    header("refresh:2; url=?do=kategoriler2");
                }else{
                    echo '<div class="arama-hata">Kategori Eklenirken Hata Oluştu...</div>';
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
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Kategori Adi </span></li>
                    <li><input type="text" id="k1" name="name" placeholder="kategori adı" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Kategori Açıklama </span></li>
                    <li><input type="text" id="k1" name="aciklama" placeholder="kategorinin kısa açıklaması" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Kategori ust id </span></li>
                    <li><input type="text" id="k1" name="ustid" placeholder="1 ise programlam 0 ise web tasarım" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>






                    <li><button type="submit">Kategoriyi Ekle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>

