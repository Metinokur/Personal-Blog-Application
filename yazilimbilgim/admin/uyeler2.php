<?php !defined("admin") ? die("hacking"):null;?>

<?php

if (!empty($conn)) {
    $v=$conn->prepare("select * from uyeler  order by uye_id desc ");
    $v->execute(array());
    $k =$v->fetchAll(PDO::FETCH_ASSOC);
    $m =$v->rowCount();
}

?>

<div class="admin-icerik-sag">
    <h2> Uyeler <span style="float: right;color: red;"><a href="?do=uye_ekle" style="color: #f1f1f1;">Uye Ekle</a></span> </h2>
    <div class="konular">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <tr>
                <th width="150px"> Uye Adi</th>  <th width="300px"> Uye e-posta</th>
                <th width="200px"> Uye Onay</th>  <th width="150px"> Uye Rutbe</th> <th width="250px"> Tarih</th>
                <th width="200px"> İşlemler</th>
            </tr>
            </thead>
            <?php
            if ($m){

                foreach ($k as $c){
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $c["uye_adi"]; ?>  </td>   <td> <?php echo mb_substr($c["uye_eposta"],0,250); ?> </td>
                        <td>
                            <?php
                            if ($c["uye_onay"]==1){

                                echo '<span style="color:lime;">ONAYLI <i class="fa fa-check"></i></span> ';

                            }else{
                                echo '<span style="color:red;;">ONAYLI DEĞİL <i class="fa fa-times"></i></span> ';
                            }
                            ?>

                        </td>
                        <td> <?php echo $c["uye_rutbe"]; ?>  </td>
                        <td> <?php echo $c["uye_tarih"]; ?>  </td>
                        <td> <span style="margin-left: 10px;"><a href="?do=uye_duzenle&id=<?php echo $c["uye_id"]; ?>" style="color: #00b6e7;"> <i class="fas fa-tools"></i>DÜZENLE</a></span> <span style="margin-left: 10px; "><a onclick="return confirm('uyeyi silmek istediginize emin misiniz ?')" href="?do=uye_sil&id=<?php echo $c["uye_id"]; ?>" style="color: red;"><i class="fas fa-trash-alt"></i>SİL</a></span>  </td>
                    </tr>
                    </tbody>
                    <?php
                }

            }else{
                echo '<tr><td colspan="5"><div class="arama-hata">Henüz Hiç Uye Eklenmemiş... </div></td></tr>';
            }
            ?>
        </table>
    </div>
</div>


