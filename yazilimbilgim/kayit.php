<?php !defined("index") ? die("hacking"):null;?>
<?php
if (!$_SESSION){
    if ($_POST){

        $isim = strip_tags(trim($_POST["isim"]));
        $sifre = strip_tags(trim($_POST["sifre"]));
        $email = strip_tags(trim($_POST["email"]));
        $hakkinda =strip_tags($_POST["hakkinda"]);
        $kod  = md5(rand(0,999999));

        if (!$isim || !$sifre || !$email){

            echo '<div class="gecerli-mail-hata"><span style="color: red;"> * </span> Boş Alanları Doldurmalısınız</div>';
        }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo '<div class="gecerli-mail-hata"><i class="fa fa-times"></i> Lütfen Geçerli Bir Mail Adresi Girin</div>';

        }else{

            $sifre = md5($sifre);

            if (!empty($conn)) {
                $v=$conn->prepare("select * from uyeler where uye_adi=?");
                $v->execute(array($isim));
                $y =$v->fetchAll(PDO::FETCH_ASSOC);
                $k =$v->rowCount();
                if ($k){
                    echo '<div class="arama-hata"> <span style="color: red;">'.$isim.'</span> Adlı Üye Sistemde Zaren Var</div>';
                }else{

                    $d=$conn->prepare("insert into uyeler set 
                        uye_adi=?,
                        uye_sifre=?,
                        uye_eposta=?,
                        uye_hakkinda=?,
                        uye_kod=?
                     
                     ");
                   $kayit = $d->execute(array($isim,$sifre,$email,$hakkinda,$kod));
                   if ($kayit){
                       echo '<div class="basarili-kayit-olundu"><span style="color: #00b6e7;"><i class="fa fa-check"></i></span> Başarıyla Kayıt Oldunuz. Üyeliğiniz Onaylandıktan Sonra Giriş Yapabilirsiniz... </div>';
                       header("refresh:2; url=index.php");

                   }else{
                       echo '<div class="arama-hata"> Uye Kaydı Olurken Bir Hata Meydana Geldi </div>';
                   }

                }
            }


        }

    }else{
        ?>
        <div class="kullanicikayit">
            <form action="" method="post">

                <ul>
                    <li> <i class="fas fa-user"></i> Kullanıcı Adı <span style="color: red;"> * </span></li>
                    <li> <input type="text" id="e1" name="isim" required placeholder="kullanıcı adı girin"><label for="e1"></label></li>
                    <li> <i class="fas fa-lock" ></i> Şifre <span style="color: red;"> * </span></li>
                    <li> <input type="password" id="e2" name="sifre" required  placeholder="şifrenizi girin"><label for="e2"></label></li>
                    <li> <i class="fas fa-envelope"></i> e-mail<span style="color: red;"> * </span></li>
                    <li> <input type="text" id="e3" name="email" required placeholder="mail adresinizi girin"><label for="e3"> </label></li>
                    <li> <i class="fas fa-lock" ></i> hakkında</li>
                    <li><textarea name="hakkinda" id="e4"  required cols="50" rows="8"  > </textarea><label for="e4"></label></li>
                    <li><button type="submit" > Kayıt Ol </button></li>
                </ul>
            </form>

        </div>

        <?php
    }

}



?>


<!--
       echo '<div class="basarili-kayit-olundu"><span style="color: lime;"><i class="fa fa-check"></i></span> Başarıyla Kayıt Oldunuz. Üyeliğiniz Onaylandıktan Sonra Giriş Yapabilirsiniz... </div>';
                       header("refresh:2; url=index.php");


 -->