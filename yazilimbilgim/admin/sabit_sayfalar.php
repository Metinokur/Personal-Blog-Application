<?php !defined("admin") ? die("hacking"):null;?>

<?php

if (!empty($conn)) {
    $v=$conn->prepare("select * from sabit_sayfalar order by sayfa_id desc ");
    $v->execute(array());
    $k =$v->fetchAll(PDO::FETCH_ASSOC);
    $m =$v->rowCount();
}

?>

<div class="admin-icerik-sag">
    <h2> Sabit Sayfalar <span style="float: right;color: red;"><a href="?do=sayfa_ekle" style="color: #f1f1f1;"> Sayfa Ekle</a></span> </h2>
    <div class="konular">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <tr>
                <th width="200px"> Sayfa Adı </th>  <th width="700px"> Sayfa Açıklaması </th>
                   <th width="250px"> Tarih</th>   <th width="200px"> İşlemler</th>

            </tr>
            </thead>
            <?php
            if ($m){

                foreach ($k as $c){
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $c["sayfa_adi"]; ?>  </td>   <td> <?php echo mb_substr($c["sayfa_aciklama"],0,55); ?> </td>

                        <td> <?php echo $c["sayfa_tarih"]; ?>  </td>

                        <td> <span style="margin-left: 10px;"><a href="?do=sayfa_duzenle&id=<?php echo $c["sayfa_id"]; ?>" style="color: #00b6e7;" > <i class="fas fa-tools"></i>DÜZENLE</a></span> <span style="margin-left: 10px; "><a onclick="return confirm('sabit sayfayı silmek istediginize emin misiniz ?')" href="?do=sayfa_sil&id=<?php echo $c["sayfa_id"]; ?>" style="color: red;"><i class="fas fa-trash-alt"></i>SİL</a></span>  </td>
                    </tr>
                    </tbody>
                    <?php
                }

            }else{
                echo '<tr><td colspan="5"><div class="arama-hata">Henüz Hiç Sayfa Eklenmemiş... </div></td></tr>';
            }
            ?>
        </table>
    </div>
</div>
