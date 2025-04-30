<?php
include("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");

include("view/sidebar.php");

if($akademisyen_kontrol && isset($_GET["form_turu_id"])){

require_once "models/formturumodel.php";

$formturuid = htmlspecialchars(ozelkarakterSil($_GET["form_turu_id"]));

$fgs = new FormTuruModel();
	
if($fgs->formturSil($baglan,$formturuid)){
	echo basariMetni("Form Türü Başarıyla Silindi...");
	yonlendir(WEBSITE_URL."/formlar.php");
}else {
	echo hataMetni("Form Türü Silinirken Hata Oluştu.!");

}

}else {
	die(hataMetni("Bu sayfaya erişemezsiniz."));
}

include ("view/footer.php");


?>
