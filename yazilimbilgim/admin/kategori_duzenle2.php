<?php !defined("admin") ? die("hacking"):null;?>

<?php

$id=@$_GET["id"];

if (!empty($conn)) {
    $v=$conn->prepare("select * from katagoriler where katagori_id=?");
    $v->execute(array($id));
    $m =$v->fetch(PDO::FETCH_ASSOC);
}

?>




<div class="admin-icerik-sag">
    <h2>Kategori Düzenle</h2>
    <?php
    if ($_POST){

        $name      =strip_tags(trim($_POST["name"]));
        $aciklama  =strip_tags(trim($_POST["aciklama"]));
        $ustid     =strip_tags(trim($_POST["ustid"]));


        if (!$name || !$aciklama ){
            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';
        }else{
            $guncelle=$conn->prepare("update  katagoriler set
                          katagori_adi=?,
                         katagori_aciklama=?,
                          katagori_ust_id=?  where katagori_id=?
                
                
                ");
            $update=$guncelle->execute(array($name,$aciklama,$ustid,$id));
            if ($update){
                echo '<div class="basarili-kayit-olundu">Kategori Başarıyla Güncellendi...</div>';
                header("refresh:2; url=?do=kategoriler2");
            }else{
                echo '<div class="arama-hata">Kategori düzenlenirken Hata Oluştu...</div>';
            }
        }

    }else{
        ?>
        <div class="konular">
            <form action="" method="post">
                <ul>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Kategori Adı </span></li>
                    <li><input type="text" id="k1" name="name" value="<?php echo $m["katagori_adi"]; ?>">
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>

                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Kategori açıklama </span></li>
                    <li><input type="text" id="k2" name="aciklama" value="<?php echo $m["katagori_aciklama"]; ?>">
                        <label for="k2"><span style="color: red;">*</span></label>
                    </li>

                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Kategori ust id </span></li>
                    <li><input type="text" id="k1" name="ustid" value="<?php echo $m["katagori_ust_id"]; ?>" >
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>



                    <li><button type="submit"> Kategoriyi Düzenle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>


