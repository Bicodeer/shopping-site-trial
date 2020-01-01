<?php
include "baglan.php";
include "header.php";
session_start();
$ekle =$conn-> prepare("insert into kategori set kategori_adi=?, user_id=?");
if(isset($_POST["submit"])){
    $kategori_adi = $_POST["kategori_adi"];
    if(empty($kategori_adi)){
        echo "Lütfen Boş Bırakmayınız!";
    }else{
        $kaydetme= "INSERT INTO kategori(kategori_adi,user_id)VALUES (:kategori_adi,:user_id)";

        $sorgu =$conn->prepare($kaydetme);

        $select = 'SELECT user_id FROM user_log WHERE username="'.$_SESSION["username"].'"';
        $qry =$conn->prepare($select);
        $qry->execute();
        $user_id=$qry->fetch(PDO::FETCH_COLUMN);

        $sorgu->bindParam(':kategori_adi',$kategori_adi,PDO::PARAM_STR);
        $sorgu->bindParam(':user_id',$user_id,PDO::PARAM_STR);
        $sorgu->execute();
        if($sorgu->rowCount()>0){
            echo "veriler eklendi"."<br>";
           // echo "Yönlendiriyor...";
            //header("refresh: 2; url=form.php");
        }else{
            echo "veri eklenemedi";
        }
    }
/*
    if(isset($_SESSION['username'])){
        $kullanici=$_SESSION['username'];

        $sql1 = 'SELECT user_id FROM user_log WHERE username="'.$kullanici.'"';

        $sorgu1 = $conn->prepare($sql1);
        $sorgu1->execute();
        $kullanici_id = $sorgu1->fetch(PDO::FETCH_COLUMN);
    }
    $query = $conn->prepare($sql);*/

   /* if(!empty($_POST["kategori_adi"]))
    {
        $sayac=0;
        $sql2 = "SELECT * FROM kategori";
        $query2 = $conn->prepare($sql2);
        $query2 -> execute();
        $kayitlar = $query2 -> fetchAll(PDO::FETCH_OBJ);
        if($query2 -> rowCount() > 0) {
            foreach ($kayitlar as $kayit) {
                if($kayit->kategori_adi == $kategori_adi){
                    $sayac++;
                }
            }
        }
        $query->bindParam(':kategori_adi',$kategori_adi,PDO::PARAM_STR);
        $query->bindParam(':kullanici',$kullanici_id,PDO::PARAM_INT);
        $query->execute();
    }*/

    $sql = "SELECT * FROM kategori";
    $query = $conn->prepare($sql);
    $query -> execute();
    $kayitlar = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0) {
        foreach ($kayitlar as $kayit) {
            echo'
                <tr onclick="getRow()">
                    <td>'. $kayit -> kategori_adi.'</td>
                </tr>
            ';
        }
    }
    else{
        echo'
            <tr>
                <td colspan="2">Henüz Kategori Bulunmamaktadır.</td>
            </tr>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <h1>Yönetici Kategori Ekleme</h1>
    <table class="table">
        <tr>
            <td>
                <label>KATEGORİ ADI GİRİNİZ :</label>
            </td>
            <td>
                <input type="text" name="kategori_adi" />
            </td>
        </tr>
        <tr>
            <td>
                <br><input style="font-weight: bolder; margin-left: 100px" type="submit" name="submit" value="KAYIT ET" />
            </td>
        </tr>
        <tr>
            <td>
                <a href="form.php" >Forma Geç</a>
            </td>
        </tr>
    </table>
</form>
<?php echo'
 <div class="tablo">

        <table   id="tablo" style="width:100%">
    <tr>
        <th width="13%" style="background-color:#ffa500">Kategoriler</th>
        
    </tr>';
$sorgu=$conn->prepare("select * from kategori");
$sorgu->execute(array());
$x=$sorgu->fetchAll(PDO::FETCH_ASSOC);
if($sorgu->rowCount()>0){
    foreach($x as $ad){
        echo'<tr onclick="getRow()">
        <td>'.$ad["kategori_adi"].'</td>
       
    </tr>';
    }
}
?>

</body>
</html>