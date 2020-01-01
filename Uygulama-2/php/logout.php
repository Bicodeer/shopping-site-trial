<?php
include "header.php";

session_start();
if(isset($_SESSION['username']))
{
    session_destroy();
    echo '<br><h1>&nbsp;&nbsp;Başarılı bir şekilde çıkış yaptınız</h1>';
}
else{
    echo '<br><h1>&nbsp;&nbsp;Zaten çıkış yapmışsınız</h1>';
}

echo'<br><br><br><br><br><br>';
