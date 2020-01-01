
<?php
session_start();
include "baglan.php";
include "header.php";
if(isset($_POST["giris"])){
    $v=$conn->prepare("select * from user_log where username=? and password=?");

    $_SESSION["username"]= ($_POST["username"]);
    $_SESSION["sifre"] =($_POST["sifre"]);
    $v->execute(array($_SESSION["username"],$_SESSION["sifre"] ));
    $x = $v->fetch(PDO::FETCH_ASSOC);
    if($x){
        $_SESSION["ad"] = $x["username"];
        header("location:firma.php");
    }else{
        echo "<script type='text/javascript'>alert('uye adı yada sifre yanlıs girdiniz');</script>";
    }
}

if(isset($_POST["ekle"])){
    $ekle = $conn->exec("INSERT INTO user_log (username, password)
            VALUES ('$_POST[kullanici_adi]', '$_POST[sifre]')") ;
    if(!$ekle){
        echo "kullanıcı eklenemedi...";
    }else{
        echo "Kullanıcı ekleme işlemi başarılı Lütfen giriş yapınız";
    }

}

$db=null;
?>
<script type="text/javascript">

    {
        if(document.getElementById("ad").value=="")
        {
            alert("Lütfen kullanıcı adı giriniz!");
        }
        else if(document.getElementById("sifre").value=="")
        {
            alert("Lütfen Sifre giriniz!");
        }
    }

</script>
<form action="" method="post">
    <table>
        <h2 style="color: cadetblue">Kullanıcı Giriş</h2>
        <tr>
            <td>Kullanıcı Adı:</td>
            <td><input type="text" name="username" id="ad" required></td>
        </tr>
        <tr>
            <td>Kullanıcı Şifre:</td>
            <td><input type="password" name="sifre" id="sifre" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Giriş Yap" name="giris" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Kullanıcı Ekle" name="ekle" required></td>
        </tr>
    </table>
</form>
</body>
</html>
