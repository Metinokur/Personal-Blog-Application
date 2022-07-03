<?php !defined("index") ? die("hacking"): null;?>

<?php
error_reporting(0);

if ($_POST){

    $name =strip_tags(trim($_POST["name"]));
    $password = strip_tags(trim(md5($_POST["password"])));
    if (!$name || !$password){
        echo '<div class="arama-hata" ><span style="color: red;"> * </span> lütfen boş alanları doldurunuz</div>';
    }else{

        if (!empty($conn)) {
            $uye = $conn->prepare("select * from uyeler where uye_adi=? and uye_sifre=? and uye_onay=?");
            $uye->execute(array($name, $password, 1));
            $m = $uye->fetchAll(PDO::FETCH_ASSOC);
            $c = $uye->rowCount();

            if ($c) {

            foreach ($m as $x) {
                   $_SESSION["uye"] = $x["uye_adi"];
                   $_SESSION["id"] = $x["uye_id"];
                   $_SESSION["eposta"] = $x["uye_eposta"];
                   $_SESSION["rutbe"] = $x["uye_rutbe"];

                       header("location:index.php");
              }

//                $_SESSION["uye"]    =     $m["uye_adi"];
//                $_SESSION["id"]     =     $m["uye_id"];
//                $_SESSION["eposta"] =     $m["uye_eposta"];
//                $_SESSION["rutbe"]  =     $m["uye_rutbe"];
//
//                header("location:index.php");

            }else{

                echo '<div class="hatakullanıcısifre"><i class="fa fa-times"></i> Kullanıcı adı veya şifre hatalı...</div>';

            }

        }

    }


}

?>

<!---
   elseif($m["uye_onay"] == 0){

                echo '<div class="hatakullanıcısifre"> <i class="fa fa-times"></i> üyeliğiniz onaylanmadı lütfen yönetici onayını bekleyiniz...</div>';

            }

   ---->