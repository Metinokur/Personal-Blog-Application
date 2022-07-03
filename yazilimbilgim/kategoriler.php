<?php !defined("index") ? die("hacking"):null;?>

<?php

if (!empty($conn)) {
    $kategori=$conn->prepare("select * from katagoriler where  katagori_ust_id=?");
     $kategori->execute(array(1));
    $m =$kategori->fetchAll(PDO::FETCH_ASSOC);
    $d =$kategori->rowCount();
    if ($d){
        foreach ($m as $c){
            echo '<li><a href="?do=kategori&id='.$c["katagori_id"].' "> <i class="fa fa-caret-right"></i> '.$c["katagori_adi"].' </a></li>';
        }

    }else{
        echo '<div>Kategori Bulunmuyor</div>';
    }
}



?>



