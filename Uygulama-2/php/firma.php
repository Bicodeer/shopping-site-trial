<?php
include "baglan.php";
include "header.php";
session_start();
if(isset($_POST["kayit"])){
    $firma_adi = $_POST["firma_adi"];
    $firma_tel = $_POST["firma_tel"];
    $firma_mail = $_POST["firma_mail"];
    $kaydetme= "INSERT INTO firma(firma_adi,firma_tel,firma_mail,user_id)VALUES (:firma_adi,:firma_tel,:firma_mail,:user_id)";

    $sorgu =$conn->prepare($kaydetme);

    $select = 'SELECT user_id FROM user_log WHERE username="'.$_SESSION["username"].'"';
    $qry =$conn->prepare($select);
    $qry->execute();
    $user_id=$qry->fetch(PDO::FETCH_COLUMN);

    $sorgu->bindParam(':firma_adi',$firma_adi,PDO::PARAM_STR);
    $sorgu->bindParam(':firma_tel',$firma_tel,PDO::PARAM_STR);
    $sorgu->bindParam(':firma_mail',$firma_mail,PDO::PARAM_STR);
    $sorgu->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    $sorgu->execute();
}
if(isset($_POST["sil"])){
    $firma_tel = $_POST["firma_tel"];
    $sql = "DELETE FROM firma WHERE firma_tel=".$firma_tel;
    $conn->query($sql);
}
if(isset($_POST["guncelle"])){
    $firma_adi = $_POST["firma_adi"];
    $firma_tel = $_POST["firma_tel"];
    $firma_mail = $_POST["firma_mail"];
    $sql = "UPDATE firma SET firma_mail='".$firma_mail."' WHERE firma_tel=".$firma_tel;
    $conn->query($sql);
}
if(isset($_POST["kategori"])){
    header("Location: kategori.php");
}
?>
<form action="" method="post">
    <table>
        <h2 style="color: cadetblue">Firma Bilgileri</h2>
        <tr>
            <td></td>
            <td><input type="text" name="firma_adi" id="firma_adi" placeholder="Firma Adı"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="text" name="firma_tel" id="firma_tel" PLACEHOLDER="Firma Telefon"></td>

        </tr>
        <tr>
            <td></td>
            <td><input type="text" name="firma_mail"  id="firma_mail" PLACEHOLDER="Firma Mail"></td>
        </tr>
    </table>
    <button type="submit" name="kayit" id="kayit" onclick="validate()" style="float: left">Kaydet</button>
    <button type="submit" name="sil" id="sil">Sil</button>
    <button type="submit" name="guncelle" id="guncelle">Guncelle</button>
    <button type="submit" name= "kategori" id="kategori" >Kategori Ekle</button>
</form>
<?php echo'
 <div class="tablo">

        <table   id="tablo" style="width:100%">
    <tr>
        <th width="13%" style="background-color:#ffa500">Firma Adı</th>
        <th width="13%" style="background-color:#ffa500">Firma Telefon</th>
        <th width="13%" style="background-color:#ffa500"> Firma EMAİL</th>
    </tr>';
$sorgu=$conn->prepare("select * from firma");
$sorgu->execute(array());
$x=$sorgu->fetchAll(PDO::FETCH_ASSOC);
if($sorgu->rowCount()>0){
    foreach($x as $ad){
        echo'<tr onclick="getRow()">
        <td>'.$ad["firma_adi"].'</td>
        <td>'.$ad["firma_tel"].'</td>
        <td>'.$ad["firma_mail"].'</td>
       
    </tr>';
    }
}
?>
