<?php !defined("admin") ? die("hacking"):null;?>

<?php

$id=@$_GET["id"];

if (!empty($conn)) {
    $v=$conn->prepare("select * from yorumlar where yorum_id=?");
    $v->execute(array($id));
    $m =$v->fetch(PDO::FETCH_ASSOC);
}

?>




<div class="admin-icerik-sag">
    <h2>Yorum Düzenle</h2>
    <?php
    if ($_POST){

        $mesaj     =strip_tags($_POST["mesaj"]);
        $onay      =strip_tags($_POST["onay"]);


        if (!$mesaj ){
            echo '<div class="arama-hata"><span style="color: red;">*</span> gerekli alanları doldurmanız gerekiyor...</div>';
        }else{
            $guncelle=$conn->prepare("update  yorumlar  set
                    yorum_mesaj=?,
                    yorum_onay=? where yorum_id=?
                
                
                ");
            $update=$guncelle->execute(array($mesaj,$onay,$id));
            if ($update){
                echo '<div class="basarili-kayit-olundu">Yorum Başarıyla Güncellendi...</div>';
                header("refresh:2; url=?do=yorumlar2");
            }else{
                echo '<div class="arama-hata">Yorum düzenlenirken Hata Oluştu...</div>';
            }
        }

    }else{
        ?>
        <div class="konular">
            <form action="" method="post">
                <ul>

                    <li><span style="color: #00b6e7;"><i class="fa fa-chevron-right"></i> Yorum Mesajı </span></li>
                    <li><textarea name="mesaj" class="ckeditor" id="k4" cols="50" rows="15" ><?php echo $m["yorum_mesaj"]; ?></textarea>
                        <label for="k4"><span style="color: red;">*</span></label>
                    </li>
                    <li>
                        <select name="onay" id="k5">
                            <option value="1" <?php echo $m["yorum_onay"]==1 ? 'selected':null; ?> >ONAYLI</option>
                            <option value="0" <?php echo $m["yorum_onay"]==0 ? 'selected':null; ?> >ONAYLI DEĞİL</option>
                        </select>
                        <label for="k5"></label>
                    </li>

                    <li><button type="submit">Yorumu Düzenle <i class="fa fa-check"></i> </button></li>
                </ul>
            </form>
        </div>

        <?php
    }

    ?>
</div>

