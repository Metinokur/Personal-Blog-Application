<?php !defined("admin") ? die("hacking"):null;?>

<?php

if (!empty($conn)) {
    $v=$conn->prepare("select * from katagoriler order by katagori_id desc ");
    $v->execute(array());
    $k =$v->fetchAll(PDO::FETCH_ASSOC);
    $m =$v->rowCount();
}

?>

<div class="admin-icerik-sag">
    <h2> Katagoriler <span style="float: right;color: red;"><a href="?do=kategori_ekle2" style="color: #f1f1f1;">Kategori Ekle</a></span> </h2>
    <div class="konular">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <tr>
                <th width="400px"> Katagori Adi</th>   <th width="400px"> Kategori Açıklama </th>
                <th width="200px"> Kategori üst id </th>  <th width="300px"> Kategori türü </th>
                <th width="200px"> İşlemler</th>
            </tr>
            </thead>
            <?php
            if ($m){

                foreach ($k as $c){
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $c["katagori_adi"]; ?>  </td>   <td> <?php echo $c["katagori_aciklama"]; ?> </td>
                        <td> <?php echo $c["katagori_ust_id"]; ?> </td>

                        <td>
                            <?php
                            if ( $c["katagori_ust_id"]==1){
                                echo 'Programlama';
                            }else{
                                echo 'Web Tasarım';
                            }

                            ?>

                        </td>

                        <td> <span style="margin-left: 10px;"><a href="?do=kategori_duzenle2&id=<?php echo $c["katagori_id"]; ?>" style="color: #00b6e7;" > <i class="fas fa-tools"></i>DÜZENLE</a></span> <span style="margin-left: 10px; "><a onclick="return confirm('kategoriyi silmek istediginize emin misiniz ?')" href="?do=kategori_sil2&id=<?php echo $c["katagori_id"]; ?>" style="color: red;"><i class="fas fa-trash-alt"></i>SİL</a></span>  </td>
                    </tr>
                    </tbody>
                    <?php
                }

            }else{
                echo '<tr><td colspan="5"><div class="arama-hata">Henüz Hiç Kategori Eklenmemiş... </div></td></tr>';
            }
            ?>
        </table>
    </div>
</div>

