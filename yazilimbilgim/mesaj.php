<?php !defined("index") ? die("hacking"):null;?>


<?php

if ($_SESSION){
    if (!empty($conn)) {
        $mesaj=$conn->prepare("select * from mesajlar where mesaj_kime=? order by mesaj_id desc");
        $mesaj->execute(array($_SESSION["id"]));
        $m =$mesaj->fetchAll(PDO::FETCH_ASSOC);
        $c =$mesaj->rowCount();

        echo '<div class="mesaj"><h3> <i class="fa fa-caret-right"></i> <i class="fa fa-caret-right"></i>  mesajlarım   <span style="float: right;"><a href="?do=mesaj_gonder">Mesaj Gönder</a></span></h3></div>';
        if ($c){
            foreach($m as $v){
                if ($v["mesaj_kime"]==$_SESSION["id"]){
                    if ($v["mesaj_okunma"]==1){

                 ?>
                            <div class="mesajlarim2">
                                <ul>
                                    <li>
                                        <a href="?do=mesaj_oku&id=<?php echo $v["mesaj_id"];?>">
                                            <i class="fa fa-check"></i>     <span style="font-weight: bold; color: #00b6e7;" > Gönderen: </span><?php echo $v["mesaj_gonderen"]; ?>
                                            <span style="font-weight: bold; color: #00b6e7;" > mesaj: </span><?php echo $v["mesaj_baslik"]; ?> </a>
                                        <span style="float: right;" ><?php echo date(" d/m/Y ",strtotime($v["mesaj_tarih"])); ?> <span style="font-weight: bold;"><a href="?do=mesaj_sil&id=<?php echo $v["mesaj_id"]; ?>">SİL <i class="fa fa-times"></i></a></span> </span>
                                    </li>

                                </ul>
                            </div>

                        <?php


                    }else{

                        ?>

                            <div class="mesajlarim">

                                <ul>
                                    <li>
                                        <a href="?do=mesaj_oku&id=<?php echo $v["mesaj_id"];?>">
                                            <span style="font-weight: bold; color: #00b6e7;" > Gönderen: </span><?php echo $v["mesaj_gonderen"]; ?>
                                            <span style="font-weight: bold; color: #00b6e7;" > mesaj: </span><?php echo mb_substr( $v["mesaj_baslik"],0,25); ?> </a>
                                        <span style="float: right;" ><?php echo date(" d/m/Y ",strtotime( $v["mesaj_tarih"])); ?> <span style="font-weight: bold;"><a href="?do=mesaj_sil&id=<?php echo $v["mesaj_id"]; ?>"> SİL <i class="fa fa-times"></i></a></span> </span>
                                    </li>

                                </ul>
                            </div>

                        <?php
                    }

                }else{
                    echo "<div class='arama-hata'>Yanlış Bir Yere Girdiniz...</div>";
                }

            }

        }else{
            echo "<div class='arama-hata'> Hiç mesajınız Bulunmuyor...</div>";
        }

    }


}

?>
