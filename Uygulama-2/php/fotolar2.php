<?php
include  "header.php";
include  "baglan.php";
session_start();
?>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <table id="fotograflar" style="color: crimson">
        <h2 class="header">ÜRÜNLERİM</h2>
        <tr>
            <td>KATEGORİLER:</td>
            <?php
            $sec=$conn->prepare("select * from kategori");
            $sec->execute(array());
            $x=$sec->fetchAll(PDO::FETCH_ASSOC);
            if($x){
                foreach ($x as $i){
                    echo '<td><button class="btn2" id="'.$i['kategori_id'].'" value="'.$i['kategori_adi'].'" name="kategori">'.$i['kategori_adi'].'</button></td> ';
                }
            }
            ?>
        </tr>
        <div class="popupdiv" id="popupdiv">
            <div id="myPopup">
                <h2 id="kullanici"></h2>
            </div>
        </div>
    </table>
    <br>
    <table id="fotograflar">
        <tr>
            <th width="13%" style="background-color:#97ffff">Fotoğraflar</th>
            <th width="13%" style="background-color:#97ffff">Açıklama</th>
            <th width="13%" style="background-color:#97ffff">Fiyat</th>
        </tr>
        <?php
        if(isset($_POST['kategori']))
        {
            albumGoster($_POST['kategori'],$conn);
        }
        function albumGoster($albumName, $database) {
            $sec=$database->prepare("SELECT * FROM urunler INNER JOIN kategori ON urunler.kategori_id=kategori.kategori_id and kategori.kategori_adi=?");
            $sec->execute(array($albumName));
            $x=$sec->fetchAll(PDO::FETCH_ASSOC);
            if(count($x)!=0){
                foreach ($x as $i){
                    echo '<form method="post" action="formislem.php">
                            <tr>
	                            <td><img id ="myImg" onclick="getImage('.$i['urunler_id'].','.$i['urun_yolu'].','.$i['aciklama'].','.$i['fiyat'].')" src='.$i['urun_yolu'].' width="340" height="240"/></td>
    	                        <td>'.$i['aciklama'].'</td>
    	                        <td>'.$i['fiyat'].'TL'.'</td>   	                        	                     
    	                        <td><a href="sepet.php?id=' .$i["urunler_id"]. '">Sepete Git</a></td> 
                            </tr>
                            </form>' ;
                }
            }else
            {
                echo "Ürün  Bulunmamaktadır!!!";
            }
        }
        ?>

    </table>
</form>


</body>
