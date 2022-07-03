<?php !defined("index") ? die("hacking"):null;?>

<?php

if ($_SESSION){

    $id=(int)$_GET["id"];

    if (!empty($conn)) {
        $v=$conn->prepare("select * from mesajlar where mesaj_id=? and mesaj_kime=?");
        $v->execute(array($id,$_SESSION["id"]));
        $m = $v->fetch(PDO::FETCH_ASSOC);
        $l = $v->rowCount();

        if ($l){
            $v=$conn->prepare("update mesajlar set mesaj_okunma=? where mesaj_id=? and mesaj_kime=?");
            $v->execute(array(1,$id,$_SESSION["id"]));
           ?>
<div class="mesaj-okunma-alani">
    <div class="mesajlarim-okuma">
        <h3> <span style="font-weight: 450; color: #00b6e7;"><span style="color: rgba(239,79,79,0.7); "><i
                        class="fas fa-envelope"></i></span> baslık
                :</span><?php echo mb_substr($m["mesaj_baslik"],0,25);?>
            <span style="font-weight:450;float: right; "><?php echo date(" d/m/Y ",strtotime( $m["mesaj_tarih"]));?></span>
        </h3>

        <ul>
            <li>
                <p>
                    <span
                        style="font-weight:500;color: rgba(239,79,79,0.7); "><?php echo $m["mesaj_gonderen"];?></span>
                    <br /> <br />
                    <?php echo  nl2br($m["mesaj_aciklama"]);?>
                </p>
            </li>
        </ul>
    </div>
</div>
<?php
        }else{
            echo '<div class="arama-hata">Mesaj silinmiş olabilir </div>';
        }
    }

}

?>