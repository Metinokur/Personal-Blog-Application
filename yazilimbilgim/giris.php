<?php !defined("index") ? die("hacking"):null;?>

<?php

if ($_SESSION){
        ?>
    <div class="uye-area">

        <ul>
            <li><i class="fas fa-smile"></i> <span style="color: rebeccapurple;">HOŞGELDİNİZ:</span> <?php echo $_SESSION["uye"]; ?> </li>
            <?php
            if ($_SESSION["rutbe"]==1){
                echo '<li><i class="fas fa-user-lock"></i><a href="admin">Admin Paneli</a></li>';
            }

            ?>
            <li><i class="fa fa-user"></i><a href="?do=profil&uye=<?php echo $_SESSION["uye"]; ?>"> Profil</a></li>
            <li><i class="fas fa-book"></i><a href="?do=konu_ekle"> Konu ekle</a></li>
            <li><i class="fas fa-comment-dots"></i><a href="?do=mesaj"> Mesajlarım</a>

                <?php
                if (!empty($conn)) {
                    $v=$conn->prepare("select * from mesajlar where mesaj_kime=? and mesaj_okunma=?");
                    $v->execute(array($_SESSION["id"],0));
                    $v->fetchAll(PDO::FETCH_ASSOC);
                    $x = $v->rowCount();
                    echo $x;
                }

                if (!empty($conn)) {
                    $v=$conn->prepare("select * from mesajlar where mesaj_kime=? and mesaj_okunma=?");
                    $v->execute(array($_SESSION["id"],1));
                    $v->fetchAll(PDO::FETCH_ASSOC);
                    $x = $v->rowCount();
                    echo '<span style="margin-left: 4px;">'.$x.'</span>';
                }

                ?>

            </li>
            <li><i class="fas fa-sign-out-alt"></i><a href="?do=cikis"> Çıkış </a></li>


        </ul>

    </div>

        <?php

}else{
    ?>
    <div class="form-alan">
        <div class="form-box">

        <form action="?do=uye" method="post">

            <div class="icon">
                <i class="far fa-user fa-2x"></i>
            </div>

                <div class="part" >
                  <p> <i class="fas fa-user"></i> Kullanıcı Adı </p>
                  <input type="text" name="name" id="g1" placeholder=" name..." required>
                  <label for="g1"></label>
                </div>

            <div>
                <p>  <i class="fas fa-lock" ></i> şifre  </p>
                <input type="password" name="password" id="g2" placeholder="password..." required>
                 <label for="g2"></label>
            </div>

               <button type="submit" class="btn">GİRİŞ YAP</button>


        </form>
        </div>
    </div>

    <?php
}


?>


