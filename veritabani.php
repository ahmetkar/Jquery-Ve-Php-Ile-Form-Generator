<?php
if(count(get_included_files()) ==1){
    http_response_code(404);
    include('view/404.php');
    exit;
}

$host = "localhost";
$veritabani_ismi = "deneme";
$veritabani_kadi = "root";
$veritabani_sifre = "";

$baglan = null;
if(extension_loaded("PDO")){
    try{
    $baglan = new PDO("mysql:host=".$host.";dbname=".$veritabani_ismi,$veritabani_kadi,$veritabani_sifre);
    $baglan->exec("SET NAMES utf8");
    
    }catch(PDOException $ex){
        echo "Veritabanı bağlantısında bir sorun oluştu.";
        die($ex->getMessage());

    }
}
function baglantiKopar(){
    $baglan = null;
}



?>