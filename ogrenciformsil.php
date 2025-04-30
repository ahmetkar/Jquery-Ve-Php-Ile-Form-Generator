<?php

include("oturumbaslat.php");
include("veritabani.php");
include("ayarlar.php");
require_once "models/formmodel.php";
$basari = false;
if(isset($_GET["form_id"])){
    $form_id = htmlspecialchars(ozelkarakterSil($_GET["form_id"]));
    $kid = $_SESSION["kid"];
    $fgs = new FormModel();

    $silinecekresimler = $fgs->formaAitresimlerBul($baglan,$form_id);
    if(!empty($silinecekresimler)){
        if($fgs->resimlerSil($silinecekresimler)) echo basariMetni("Forma ait yüklediğiniz resimler silindi.");
    }
   
include("view/sidebar.php");
if($fgs->formSil($baglan,$form_id,$kid)){
    echo basariMetni("Form Silindi..");
    yonlendir(WEBSITE_URL."/gonderdiklerim.php");
}else {
    echo hataMetni("Form Silinirken Hata Oluştu.!");
}
include("view/footer.php");
}else {
    yonlendir(WEBSITE_URL);
}
?>