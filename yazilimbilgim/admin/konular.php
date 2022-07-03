<?php !defined("admin") ? die("hacking"):null;?>

<?php

if (!empty($conn)) {
    $v=$conn->prepare("select * from konular inner join katagoriler
    on katagoriler.katagori_id=konular.konu_katagori order by konu_id desc ");
    $v->execute(array());
    $k =$v->fetchAll(PDO::FETCH_ASSOC);
    $m =$v->rowCount();
}

?>

<div class="admin-icerik-sag">
    <h2> Konular <span style="float: right;color: red;"><a href="?do=konu_ekle2" style="color: #f1f1f1;">Konu Ekle</a></span> </h2>
    <div class="konular">
        <table cellspacing="0" cellpadding="0" >
        <thead>
        <tr>
            <th width="600px"> Konu Başlıkları</th>  <th width="300px"> Konu Kategoriler</th>
            <th width="200px"> Konu Onayları</th>  <th width="250px"> Tarih</th>
            <th width="200px"> İşlemler</th>
        </tr>
        </thead>
            <?php
            if ($m){

                foreach ($k as $c){
                   ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $c["konu_baslik"]; ?>  </td>   <td> <?php echo $c["katagori_adi"]; ?> </td>
                        <td>
                            <?php
                            if ($c["konu_durum"]==1){

                                echo '<span style="color:lime;">ONAYLI <i class="fa fa-check"></i></span> ';

                            }else{
                                echo '<span style="color:red;;">ONAYLI DEĞİL <i class="fa fa-times"></i></span> ';
                            }
                            ?>

                        </td>
                        <td> <?php echo $c["konu_tarih"]; ?>  </td>
                        <td> <span style="margin-left: 10px;"><a href="?do=konu_duzenle&id=<?php echo $c["konu_id"]; ?>" style="color: #00b6e7;" > <i class="fas fa-tools"></i>DÜZENLE</a></span> <span style="margin-left: 10px; "><a onclick="return confirm('konuyu silmek istediginize emin misiniz ?')" href="?do=konu_sil&id=<?php echo $c["konu_id"]; ?>" style="color: red;"><i class="fas fa-trash-alt"></i>SİL</a></span>  </td>
                    </tr>
                    </tbody>
            <?php
                }

            }else{
                echo '<tr><td colspan="5"><div class="arama-hata">Henüz Hiç Konu Eklenmemiş... </div></td></tr>';
            }
            ?>
        </table>
    </div>
</div>
