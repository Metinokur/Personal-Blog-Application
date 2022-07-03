<?php !defined("index") ? die("hacking"):null;?>

<?php

try {

    $host="localhost";
    $username="root";
    $password="";
    $dbname="yazilimhane";  /* mysql oluşturulacak  */

    $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8","$username","$password");
    // PDO nun hata modunun ayarlanması
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


}catch (PDOException $e){
    echo "hata mesaji:".$e->getMessage();
}

?>
