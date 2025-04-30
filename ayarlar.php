<?php

if(count(get_included_files()) ==1){
    http_response_code(404);
    include('view/404.php');
    exit;
}

require_once "models/models.php";

//Form türleri için resmin yükleneceği klasörün yolu
define("FORM_IMAGES_PATH","img/formtururesimleri/");
//Öğrencinin eklediği formlar için resmin yükleneceği klasörün yolu
define("USER_IMAGES_PATH","img/formresimleri/"); 

define("WEBSITE_URL","/ebk");


$akademisyen_kontrol = false;
$yonetici_kontrol = false;
$sadece_akademisyen = false;


if(isset($_SESSION["ktipi"])){
    $akademisyen_kontrol = ($_SESSION["ktipi"] == 1 || $_SESSION["ktipi"] == 0); //Akademisyen veya yönetici
    $yonetici_kontrol = ($_SESSION["ktipi"] == 0); // Sadece yönetici
    $sadece_akademisyen = ($_SESSION["ktipi"] == 1);//Sadece akademisyen
}


function yonlendir($url){
    echo '<script>
    setTimeout(function(){window.location.assign("'.$url.'");}, 3000);
    </script>';
}

function hataMetni($text){
    $text_html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            '.$text.'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    return $text_html;
}

function basariMetni($text){
      $text_html = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$text.'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    return $text_html;
} 

function ozelKarakterSil($str){return Models::ozelKarakterSil($str);}





    

?>