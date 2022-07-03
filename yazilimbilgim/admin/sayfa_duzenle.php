<?php !defined("admin") ? die("hacking"):null;?>

<?php

$id=@$_GET["id"];

if (!empty($conn)) {
    $v=$conn->prepare("select * from sabit_sayfalar where sayfa_id=?");
    $v->execute(array($id));
    $m =$v->fetch(PDO::FETCH_ASSOC);
}

?>




<div class="admin-icerik-sag">
    <h2>Sayfa Düzenle</h2>
    <?php
    if ($_POST){

        $name      =strip_tags(trim($_POST["name"]));
        $aciklama  = $_POST["aciklama"];



        if (!$name || !$aciklama ){
            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';
        }else{
            $guncelle=$conn->prepare("update  sabit_sayfalar set
                          sayfa_adi=?,
                         sayfa_aciklama=?  where   sayfa_id=?   
                
                
                ");
            $update=$guncelle->execute(array($name,$aciklama,$id));
            if ($update){
                echo '<div class="basarili-kayit-olundu"> Sayfa Başarıyla Güncellendi...</div>';
                header("refresh:2; url=?do=sabit_sayfalar");
            }else{
                echo '<div class="arama-hata"> Sayfa düzenlenirken Hata Oluştu...</div>';
            }
        }

    }else{
        ?>
        <div class="konular">
            <form action="" method="post">
                <ul>
                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Sayfa Adı </span></li>
                    <li><input type="text" id="k1" name="name" value="<?php echo $m["sayfa_adi"]; ?>">
                        <label for="k1"><span style="color: red;">*</span></label>
                    </li>

                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Sayfa açıklama </span></li>
                    <li><textarea name="aciklama" class="ckeditor" id="k4" cols="50" rows="15" ><?php echo $m["sayfa_aciklama"]; ?></textarea>
                        <label for="k4"><span style="color: red;">*</span></label>
                    </li>


                    <li><button type="submit"> Sayfayı Düzenle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>



