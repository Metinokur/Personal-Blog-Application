<?php define("admin",true);?>
<?php session_start();  ?>
<?php include ("ayar2.php"); ?>
<!DOCTYPE html>
<html lang="en-tr-us">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="MetinOKUR,metinokuryazar@gmail.com" />
    <meta name="copyright" content="2021 Metin OKUR"/>
    <meta name="designer" content="Metin OKUR "/>
    <link rel="shortcut icon" type="image/png" href="../img/logofavicon.png"/>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="admin.css">

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <link rel="stylesheet" href="ckeditor/plugins/codesnippet/lib/highlight/styles/monokai.css" />

    <script src="ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js" type="text/javascript"></script>

    <script>hljs.initHighlightingOnLoad();</script>


    <script src="https://kit.fontawesome.com/ab7283eac0.js" crossorigin="anonymous"></script>

    <title>Metin OKUR</title>

</head>
<body>

<?php

if ($_SESSION){

    if ($_SESSION["rutbe"]==1){
        ?>
        <div class="admin-genel">
            <div class="admin-header">
                <h2><a href="">Metin OKUR <span style="color:#f1f1f1;"> Admin Paneli </span></a>
                    <span style="float: right;margin-right: 35px;"><a href="../index.php">Siteyi Görüntüle</a></span>
                </h2>
                <div class="uye-panel">admin paneline hoşgeldiniz : <?php echo $_SESSION["uye"]; ?></div>
            </div>
            <div class="admin-icerik">
                <div class="admin-menu">
                    <ul>
                        <li><a href="?do=ansayfa2"><i class="fa fa-caret-right"></i> Anasayfa </a></li>
                        <li><a href=" ?do=konular"><i class="fa fa-caret-right"></i> Konular</a></li>
                        <li><a href="?do=uyeler2"><i class="fa fa-caret-right"></i> Üyeler</a></li>
                        <li><a href="?do=yorumlar2"><i class="fa fa-caret-right"></i> Yorumlar</a></li>
                        <li><a href="?do=kategoriler2"><i class="fa fa-caret-right"></i> Kategoriler</a></li>
                        <li><a href="?do=sabit_sayfalar"><i class="fa fa-caret-right"></i> Sabit Sayfalar </a></li>
                        <li><a href="?do=admin_cikis"><i class="fa fa-caret-right"></i> Çıkış</a></li>

                    </ul>
                </div>
                <?php

                $do=@$_GET["do"];
                if (file_exists("{$do}.php")){

                    include ("{$do}.php");

                }else{
                    include ("anasayfa2.php");
                }

                ?>
            </div>


        </div>

        <?php

    }else{
        echo '<div class="arama-hata">Admin Paneline Yetkiniz Bulunmuyor :( </div>';
    }

}else{
    echo '<div class="arama-hata">Admin Paneline Girmek için Üye  Girişi Yapmanız Gerekiyor</div> ';
}

?>

</body>
</html>


