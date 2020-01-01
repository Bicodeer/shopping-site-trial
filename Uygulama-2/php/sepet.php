<?php
include  "header.php";
include  "baglan.php";
session_start();

if(isset($_POST["sepeteEkle"])){
    try{
        $kaydetme= "INSERT INTO sepet VALUES (null , :urunler_id,:user_id)";
        $sorgu = $conn->prepare($kaydetme);

        $select = 'SELECT user_id FROM user_log WHERE username="'.$_SESSION["username"].'"';
        $qry =$conn->prepare($select);
        $qry->execute();
        $user_id=$qry->fetch(PDO::FETCH_COLUMN);

        $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $parts = parse_url($url);
        $arr = array();
        parse_str($parts['query'], $arr);
        $urunler_id=$arr['id'];
        $sorgu->bindParam(':urunler_id',$urunler_id,PDO::PARAM_INT);
        $sorgu->bindParam(':user_id',$user_id,PDO::PARAM_INT);
        $sorgu->execute();
    }catch (Exception $e){
        echo $e;
    }
}
if(isset($_POST["sepetKaldir"])){
    try{
        $select = 'SELECT user_id FROM user_log WHERE username="'.$_SESSION["username"].'"';
        $qry =$conn->prepare($select);
        $qry->execute();
        $user_id=$qry->fetch(PDO::FETCH_COLUMN);

        $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $parts = parse_url($url);
        $arr = array();
        parse_str($parts['query'], $arr);
        $urunler_id=$arr['id'];
        $sql = "DELETE FROM sepet WHERE urunler_id=".$urunler_id;
        $conn->query($sql);
        echo "Sepetten Veri Silindi.";
    }catch (Exception $e){
        echo $e;
    }
}
if(isset($_POST["sepetBosalt"])){
    try{
        $select = 'SELECT user_id FROM user_log WHERE username="'.$_SESSION["username"].'"';
        $qry =$conn->prepare($select);
        $qry->execute();
        $user_id=$qry->fetch(PDO::FETCH_COLUMN);

        $sql = "DELETE FROM sepet ";
        $conn->query($sql);
        echo "Sepet Boş.";
    }catch (Exception $e){
        echo $e;
    }
}
if(isset($_POST["sepetiGoruntule"])) {
    $toplam = 0;
    $sql = "SELECT * FROM sepet LEFT JOIN urunler ON sepet.urunler_id=urunler.urunler_id";
    $query = $conn->prepare($sql);
    $query->execute();
    $kayitlar = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($kayitlar as $kayit) {
            echo '<img src="' . $kayit->urun_yolu . '" style="margin-left:3%; margin-top:2%" width="10%" height="20%" border="0" />';
            echo 'AÇIKLAMA: ' . $kayit->aciklama;
            echo ' => FİYAT   : ' . $kayit->fiyat;
            $toplam = $toplam + $kayit->fiyat;
        }
    }
    echo "<tr>
            <td>
                <br><br><label style='color: cornflowerblue'>Sepet Toplam :</label> $toplam
            </td>
          </tr>";
}
?>

<form method="post">
    <h1>SEPETİM</h1>
    <tr>
        <input type="submit" value="Sepete Ekle" name="sepeteEkle" >
    </tr>
    <tr>
        <input type="submit" value="Sepetten Kaldır" name="sepetKaldir" >
    </tr>
    <tr>
        <input type="submit" value="Tüm Sepeti Boşalt" name="sepetBosalt" >
    </tr>

    <tr>
        <input type="submit" value="Sepeti Görüntüle" name="sepetiGoruntule" >
    </tr>
    <tr>
        <a href="fotolar2.php"> Alışverişe Devam Et </a>
    </tr>
</form>
