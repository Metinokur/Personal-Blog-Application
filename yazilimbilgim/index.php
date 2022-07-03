<?php define("index",true);?>
<?php include("ayar.php"); ?>

<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en-tr-us" id="html-top">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="MetinOKUR,metinokuryazar@gmail.com" />
    <meta name="copyright" content="2021 Metin OKUR" />
    <meta name="designer" content="Metin OKUR " />
    <meta name="description" content=" site ile alakalı bilgiler yazılacak " />

    <link rel="shortcut icon" type="image/png" href="img/logofavicon.png" />

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript" src="script.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js">

    </script type="text/javascript">

    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <link rel="stylesheet" href="ckeditor/plugins/codesnippet/lib/highlight/styles/monokai.css" />

    <script src="ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js" type="text/javascript"></script>

    <script>hljs.initHighlightingOnLoad();</script>

    <script src="https://kit.fontawesome.com/ab7283eac0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/font-awesome.css" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

    <title> Metin OKUR | Personal Blog </title>

    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>


</head>

<body>

    <!-- header kısmı  başlangıç -->

    <header class="header">

        <input type="checkbox" id="menu-check">
        <label  for="menu-check" class="check-label"> <i class="fas fa-align-left"></i> </label>

        <div class="logo"><a href="index.php">

                <span>Metin</span>OKUR</a></div>

        <div class="links-area">

            <ul>
                <li><a href="index.php"> <span style="color: #00b6e7;">Ana</span> Sayfa</a></li>

                <li>
                    <input type="checkbox" id="drop-check">
                    <label for="drop-check"> <span style="color: #00b6e7;">Progra</span>mlama <i class="fa fa-caret-down"></i> </label>
                    <ul class="drop-menu">
                        <?php include("kategoriler.php"); ?>

                    </ul>
                </li>

                <li>
                    <input type="checkbox" id="drop-check2">
                    <label for="drop-check2"> <span style="color: #00b6e7;">Web </span>Tasarımlar <i class="fa fa-caret-down"></i>  </label>
                    <ul class="drop-menu">
                        <?php include("kategoriler_webprogramlama.php"); ?>
                    </ul>

                </li>

                <li><a href="?do=iletisim">  <span style="color: #00b6e7;">İlet</span>işim</a></li>
                <?php
                if (!empty($conn)) {
                    $sayfa=$conn->prepare("select * from sabit_sayfalar order by sayfa_id desc");
                    $sayfa->execute(array());
                    $s =$sayfa->fetchAll(PDO::FETCH_ASSOC);
                    $d =$sayfa->rowCount();
                    if ($d){
                        foreach ($s as $m){
                            echo '  <li class="sabit-li"><a href="?do=sabit_sayfalar&id='.$m["sayfa_id"].'"> '.$m["sayfa_adi"].'</a></li>';
                        }
                    }else{
                        echo '';
                    }
                }
                ?>

                <?php
                if ($_SESSION){
                   echo ' <li><a href="?do=giris"><i class="fas fa-user-circle"></i> <span style="color: #00b6e7;">Prof</span>ilim</a></li>';
                }
                else{
                   echo '<li><a href="?do=giris"><i class="fas fa-sign-in-alt"></i> <span style="color: #00b6e7;">Giriş</span> Yap</a></li>';
                }
            if (!$_SESSION){
                echo  '<li><a href="?do=kayit"><i class="far fa-address-card"></i> <span style="color: #00b6e7;">Kayıt</span> Ol</a></li>';
            }
            ?>


            </ul>


        </div>


        <div class="search-area">
            <form action="?do=ara" method="post">
                <input type="checkbox" id="search-btn">
            <label for="search-btn" class="label-open"></label>

                <div class="search-input">
                    <div class="line-in">
                    <input type="search" id="search" name="ara"  placeholder="Arama Yap...">
                    <label for="search"></label>
                    <button id="button" type="submit"></button>
                    </div>
                </div>

            </form>
        </div>



        <div class="yan-bar">
            <label for="menu-check" class="yan-label-check"><i class="fa fa-times"></i></label>

            <div class="logo-bar"><p>
                    <span>Metin</span>OKUR</p>
            </div>

            <div class="yan-link">
                <ul>
                    <li><a href="index.php"> <i class="fa fa-home"></i> ana sayfa </a></li>

                    <li class="none">
                        <input type="checkbox" id="yan-drop-check">
                        <label for="yan-drop-check" ><i class="fa fa-tags"></i> Kategoriler <i
                                    class="fa fa-caret-down"></i></label>
                        <ul class="yan-drop">
                            <?php include("kategoriler.php"); ?>
                        </ul>
                    </li>
                    <li class="none">

                        <input type="checkbox" id="yan-drop-check2">
                        <label for="yan-drop-check2"  > <i  class="fas fa-globe"></i> Web Programlama
                            <i   class="fa fa-caret-down"></i></label>
                        <ul class="yan-drop">
                            <?php include("kategoriler_webprogramlama.php"); ?>
                        </ul>



                    </li>

                    <li><a href="?do=iletisim"> <i class="fa fa-bell"></i> iletişim </a></li>
                    <?php
                    if (!empty($conn)) {
                        $sayfa=$conn->prepare("select * from sabit_sayfalar order by sayfa_id desc");
                        $sayfa->execute(array());
                        $s =$sayfa->fetchAll(PDO::FETCH_ASSOC);
                        $d =$sayfa->rowCount();
                        if ($d){
                            foreach ($s as $m){
                                echo '  <li><a href="?do=sabit_sayfalar&id='.$m["sayfa_id"].'"><i class="fas fa-asterisk"></i> '.$m["sayfa_adi"].'</a></li>';
                            }
                        }else{
                            echo '';
                        }
                    }
                    ?>

                    <?php
                    if ($_SESSION){
                        echo ' <li><a href="?do=giris"><i class="fa fa-user"></i> Profilim</a></li>';
                    }
                    else{
                        echo '<li><a href="?do=giris"><i class="fa fa-sign-in"></i> Giriş Yap</a></li>';
                    }
                    if (!$_SESSION){
                        echo  '<li><a href="?do=kayit"><i class="far fa-id-card"></i> Kayıt Ol</a></li>';
                    }
                    ?>

                </ul>



            </div>

            <div class="yan-soc-link">
                <a href="https://www.instagram.com/okursoft/ " target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://github.com/Metinokur" target="_blank"><i class="fab fa-github" ></i></a>
                <a href="https://api.whatsapp.com/send?phone=905372873739" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="mailto:metinokuryazar@gmail.com" target="_blank"><i class="fas fa-envelope"></i></a>
            </div>

            <div class="yan-copy-link">

                <p> &copy; 2021  tüm hakları saklıdır. | Metin Okur </p>
            </div>

        </div>



    </header>
    <br>
    <br>
    <br>



    <!-- header kısmı bitti -->



    <!-- conten kısmı ayarlama -->

    <div class="content">

        <?php

    $do=@$_GET["do"];
    switch ($do){
        case "ornek1":
            include ("ornek_calisma.php");
            break;
        case "devam":
            include ("devam.php");
            break;
        case "giris":
             include ("giris.php");
            break;
        case "ara":
            include ("ara.php");
            break;
        case "iletisim":
            include("iletisim.php");
            break;
        case "konu_ekle":
            include ("konu_ekle.php");
            break;
        case "kayit":
            include ("kayit.php");
            break;
        case "profil":
            include ("profil.php");
            break;
        case "profil_duzenle":
            include ("profil_duzenle.php");
            break;
        case "mesaj":
            include ("mesaj.php");
            break;
        case "mesaj_oku":
            include ("mesaj_oku.php");
            break;
        case "mesaj_gonder":
            include ("mesaj_gonder.php");
            break;
        case "mesaj_sil":
            include ("mesaj_sil.php");
            break;
        case "sabit_sayfalar":
            include ("sabit_sayfalarim.php");
            break;
        case "kategori":
            include ("kategori_liste.php");
            break;
        case "uye":
            include ("uye.php");
            break;
        case "cikis":
            session_destroy();
            echo '<div class="cikisdivi"><i class="fa fa-check"></i> basarıyla çıkış yaptınız yönlendiriliyorsunuz</div>';
            header("refresh:2; url=index.php");
            break;
        default:

         include ("anasayfa.php");

            break;

    }


    ?>


    </div>

    <!-- conten kısmı ayarlama  bitti-->



    <!--  footer kısmı ayarlama   -->
    <footer class="footer-area">
        <div class="main">
            <div class="foother">
                <div class="single-footer">
                    <h4>Metin Okur
                        <div class="line6"></div>
                    </h4>
                    <p>
                        yazılım ögrenebilir,öğrendiklerinizi uygulabilir,web alanındaki çalışmalarınızı geliştirebilir
                        ve zengin içeriklerle web sayfanızı daha uyaklı bir hale getirebilirsiniz... <i class="fas fa-hand-point-left"></i>
                    </p>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/okursoft/ " target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/Metinokur" target="_blank"><i class="fab fa-github" ></i></a>
                        <a href="https://api.whatsapp.com/send?phone=905372873739" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        <a href="mailto:metinokuryazar@gmail.com" target="_blank"><i class="fas fa-envelope"></i></a>
                    </div>

                </div>

                <div class="single-footer">
                    <h4> <span style="margin-left: 60px;">Popüler Konular</span>
                        <div class="line7"></div>
                    </h4>
                    <ul>
                        <?php
                        if (!empty($conn)) {
                            $son_konular = $conn->prepare("select * from konular where konu_durum=? order by konu_hit desc limit 5");
                            $son_konular->execute(array(1));
                            $lu =$son_konular->fetchAll(PDO::FETCH_ASSOC);
                            $ku =$son_konular->rowCount();

                            if ($ku){
                                foreach ($lu as $r){
                                    echo '<li><i class="fas fa-book-reader"></i> <a href="?do=devam&id='.$r["konu_id"].'">'.$r["konu_baslik"].'</a></li>';
                                }

                            }else{
                                echo '<div class=""> Son Konu Bulunmuyor </div>';
                            }
                        }
                        ?>


                    </ul>
                </div>





                <div class="single-footer">
                    <h4> <span style="margin-left: 60px;">Son Konular</span>
                        <div class="line7"></div>
                    </h4>
                    <ul>
                        <?php
                if (!empty($conn)) {
                    $son_konular = $conn->prepare("select * from konular where konu_durum=? order by konu_id desc limit 5");
                    $son_konular->execute(array(1));
                    $l =$son_konular->fetchAll(PDO::FETCH_ASSOC);
                    $k =$son_konular->rowCount();

                    if ($k){
                        foreach ($l as $r){
                            echo '<li><i class="fas fa-pencil-alt"></i> <a href="?do=devam&id='.$r["konu_id"].'">'.$r["konu_baslik"].'</a></li>';
                        }

                    }else{
                        echo '<div class=""> Son Konu Bulunmuyor </div>';
                    }
                }
                ?>


                    </ul>
                </div>

            </div>
            <!-- copyright alanı -->
            <div class="copy">
                <p><span style="color: #00b6e7;  text-shadow: 0 0 10px rgba(0,182,132,0.2);   ">&copy; 2021</span>  tüm hakları
                        saklıdır. |  <span style="color: #00b6e7;  text-shadow: 0 0 10px rgba(0,182,132,0.2); "> Metin Okur</span>

                </p>

            </div>

        </div>


    </footer>
    <!--  fotter alanı ayarlama bitti -->


    <a href="#html-top" class="scrollup">
        <i class="fa fa-chevron-up"></i>
    </a>


    <script>
        const scrollup = document.querySelector('.scrollup');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 100) {
                scrollup.classList.add("active");
            } else {
                scrollup.classList.remove("active");
            }
        });
    </script>



    <script type="text/javascript">
        window.sr = ScrollReveal();
        sr.reveal('.img-card-lesson',{
            scale:0.2,
            easing   : 'ease',
            opacity:0,
            interval:150,
        });

        sr.reveal('.support p',{
            rotate: { x: 10, y: 10, },
        });
        sr.reveal('.about-me p',{
            rotate: { x: 10, y: 10, },
        });

        sr.reveal('.read-more',{
            rotate: { x: 20, y: 20, },
            scale: 0.5,
            easing   : 'ease',

        });

    </script>











</body>

</html>