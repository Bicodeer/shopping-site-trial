<?php
include "baglan.php";
include "header.php";
session_start();
if(isset($_FILES['image'])){ //Resmi kontrol et
    $errors= array();
    $file_name = $_FILES['image']['name']; //Resmi değişkene kaydedin
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    @$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    $yol = "../images/".str_replace('', '%20' ,$file_name);

    $extensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){

        $errors[]='File size must be excately 2 MB';
    }
    $link = mysqli_connect("localhost", "root", "", "album");
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"../images/".$file_name);
        echo "<script type='text/javascipt'>alert('Başarılı');</script>";
        $urun_adi = $_POST["urun_adi"];
        $aciklama = $_POST["aciklama"];
        $kategori = $_POST["kategori"];
        $fiyat = $_POST["fiyat"];
        $kaydetme= "INSERT INTO urunler(urun_adi,urun_yolu,aciklama,kategori_id, fiyat)VALUES (:urun_adi,:urun_yolu,:aciklama,:kategori_id, :fiyat)";

        $sorgu =$conn->prepare($kaydetme);
        $sorgu->bindParam(':urun_adi',$urun_adi,PDO::PARAM_STR);
        $sorgu->bindParam(':urun_yolu',$yol ,PDO::PARAM_STR);
        $sorgu->bindParam(':aciklama',$aciklama ,PDO::PARAM_STR);
        $sorgu->bindParam(':kategori_id',$kategori,PDO::PARAM_INT);
        $sorgu->bindParam(':fiyat',$fiyat,PDO::PARAM_INT);
        $sorgu->execute();
        if($sorgu ->rowCount()>0){
            echo "veriler eklendi"."<br>";
            echo "yönlendiriliyor....";
            header("Location:fotolar2.php");
        }else{
            echo "veri eklenemedi";
        }

    }else{
        print_r($errors);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css.css" />
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
    <table class="table">
        <h1 style="margin-left: 350px">Ürün Ekleme Formu</h1>
        <tr>
            <td>
                <label>Ürün Adını Giriniz :</label>
            </td>
            <td>
                <input type="text" name="urun_adi"/>
            </td>
        </tr>
        <tr>
            <td>
                <label>Ürün Eklemek için Resim Seçiniz :</label>
            </td>
            <td>
                <input type="file" name="image"/>
            <td>
        </tr>
        <tr>
            <td>
                <label>Ürün Açıklaması Giriniz :</label>
            </td>
            <td>
                <input type="text" name="aciklama"/>
            </td>
        </tr>
            <td>Ürün Kategori Seçiniz :</td>
            <td><select name="kategori" id="kategori">
                    <?php
                    $sql= "select * from kategori ";
                    $query = $conn-> prepare($sql);
                    $query -> execute(array());
                    $kayitlar = $query -> fetchAll(PDO::FETCH_ASSOC);
                    foreach($kayitlar as $kayit)
                    {
                        echo "<option value=".$kayit["kategori_id"].">".$kayit["kategori_adi"]."</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label>Fiyat Giriniz :</label>
            </td>
            <td>
                <input type="text" name="fiyat"/>
            </td>
        </tr>
        <tr>
            <td><br>
                <input type="submit" value="Gönder" />
            </td>
        </tr>
        <tr>
            <td>
                <a href="fotolar2.php">Ürünler Sayfasına Geç</a>
            </td>
        </tr>
    </table>


</form>
</body>
</html>
