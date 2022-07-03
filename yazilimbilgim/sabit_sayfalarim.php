<?php !defined("index") ? die("hacking"): null; ?>


<?php
    $id=@$_GET["id"];
if (!empty($conn)) {
    $page = $conn->prepare("select * from sabit_sayfalar where sayfa_id=? ");
    $page->execute(array($id));
    $c = $page->fetch(PDO::FETCH_ASSOC);
    $g = $page->rowCount();
}

?>




<div class="hakkimda">
    <div class="benkimim">
        <h4><span style="color: #00b6e7;"> Kimdir </span> Bu Metin OKUR <span style="color: #00b6e7; font-size: 22px;">?</span>
        <div class="line-whoamı"></div>
        </h4>
        <?php
        if ($g){


        echo '<p>'.$c["sayfa_aciklama"].'</p>';



        }else{

        echo '<div class="arama-hata"> Böyle bir sayfa bulunamadı </div>';
        }



       ?>

    </div>


</div>

