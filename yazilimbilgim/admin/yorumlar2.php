<?php !defined("admin") ? die("hacking"):null;?>

<?php

if (!empty($conn)) {
    $v=$conn->prepare("select * from yorumlar   order by yorum_id desc ");
    $v->execute(array());
    $k =$v->fetchAll(PDO::FETCH_ASSOC);
    $m =$v->rowCount();
}

?>

<div class="admin-icerik-sag">
    <h2> Yorumlar   </h2>
    <div class="konular">
        <table cellspacing="0" cellpadding="0" >
            <thead>
            <tr>
                <th width="400px"> Yorum Mesaj </th>  <th width="300px"> Yorum Ekleyen</th>
                <th width="200px"> Yorum Onayları</th>  <th width="250px"> Tarih</th>
                <th width="200px"> İşlemler</th>
            </tr>
            </thead>
            <?php
            if ($m){

                foreach ($k as $c){
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo mb_substr($c["yorum_mesaj"],0,50); ?>  </td>   <td> <?php echo $c["yorum_ekleyen"]; ?> </td>
                        <td>
                            <?php
                            if ($c["yorum_onay"]==1){

                                echo '<span style="color:lime;">ONAYLI <i class="fa fa-check"></i></span> ';

                            }else{
                                echo '<span style="color:red;;">ONAYLI DEĞİL <i class="fa fa-times"></i></span> ';
                            }
                            ?>

                        </td>
                        <td> <?php echo $c["yorum_tarih"]; ?>  </td>
                        <td> <span style="margin-left: 10px;"><a href="?do=yorum_duzenle&id=<?php echo $c["yorum_id"]; ?>" style="color: #00b6e7;" > <i class="fas fa-tools"></i>DÜZENLE</a></span> <span style="margin-left: 10px; "><a onclick="return confirm('yorumu silmek istediginize emin misiniz ?')" href="?do=yorum_sil&id=<?php echo $c["yorum_id"]; ?>" style="color: red;"><i class="fas fa-trash-alt"></i>SİL</a></span>
                            <form style="display: inline;" action="?do=toplu_onay" method="post">
                            <input type="checkbox" id="kutu" name="onayla[]" value="<?php echo $c["yorum_id"]; ?>">
                             <label for="kutu"></label>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                }

            }else{
                echo '<tr><td colspan="5"><div class="arama-hata">Henüz Hiç yorum Eklenmemiş... </div></td></tr>';
            }
            ?>

        </table>
        <button type="submit" style="cursor: pointer;background-color: #2a2a2a; padding: 7px 5px;  border: 1px solid #2a2a2a; color: #00b6e7; margin-top: 5px; border-radius: 10px;">seçilen yorumları onayla </button>
        </form>
    </div>

</div>

