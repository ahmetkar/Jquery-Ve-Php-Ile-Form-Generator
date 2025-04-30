<?php


session_start();

echo "Çıkış Yapılıyor..";
session_unset();

session_destroy();

header("Location:index.php");


?>