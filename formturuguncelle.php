<?php

//eksikleri tamamla

include("oturumbaslat.php");
include("veritabani.php");
include("ayarlar.php");
if($_SESSION["ktipi"] != 0){
    http_response_code(404);
    include('view/404.php');
    exit;
}
if(!isset($_GET["form_turu_id"])){
    http_response_code(404);
    include('view/404.php');
    exit;
}
include("view/sidebar.php");

require_once "models/formturumodel.php";
require_once "models/formmodel.php";





$form_turu_id = htmlspecialchars($_GET["form_turu_id"]);
$bolgeidler = array();
$alanidler = array(array());
$secenekidler = array(array(array()));
$nitelikidler = array(array(array()));
$yannitelikidler = array(array(array()));

$fg = new FormTuruModel();
$fm = new FormModel();


?>
<style type="text/css">
    input {
        margin-left:10px;
        width:500px;
    }
</style>
<?php



$formbilgi = $fg->formturBilgileriGetir($baglan,$form_turu_id);

if($formbilgi){
    echo "<h3>".$formbilgi["baslik"]." Düzenle</h3><br>";
    echo "<form action='' method='post' enctype='multipart/form-data'>";
    echo "<div class='row'>";

    echo "<div class='col-md-12'><a>Form başlığı : </a> <input type='text' name='form_baslik' value='".$formbilgi["baslik"]."' /></div><br><br>";

    $resimlistesi = glob(FORM_IMAGES_PATH."*.{jpg,png,jpeg}",GLOB_BRACE);

    echo "<div class='col-md-12'>
    <a>Varolan resimlerden seçin : </a> <select name='secilen_resim_url'>";
    foreach($resimlistesi as $_resimurl){
        if(is_file($_resimurl)){
            if($_resimurl == $formbilgi["resim_url"]){
                echo "<option value='".$_resimurl."' selected>".$_resimurl."</option>";  
            }else {
            echo "<option value='".$_resimurl."'>".$_resimurl."</option>";
            }
        }
    }
    echo "</select>";
    echo "</div><br><br>";
    echo '<div class="col-md-12">
    <a>Veya resim yükleyin : </a><input id="form_resim" type="file" name="form_resim"></input> </div><br><br>';
    
    echo "</div>";


    $teslimsayisi = $fg->teslimSayisiGetir($baglan,$form_turu_id);
    if($teslimsayisi){
    echo "<a>Teslim Edilmesi Gereken Form Sayısı: </a> <input type='text' name='teslim_sayisi' value='".$teslimsayisi["teslim_sayisi"]."' /><br><br>";
    }

    $formbolge = $fg->formBolgeleriGetir($baglan,$form_turu_id);
    
    if($formbolge){
        $b = 0;
        foreach($formbolge as $bolgebilgi){
        echo "<fieldset><legend>".$bolgebilgi["bolge_baslik"]." Bölgesindeki Alan Bilgilerini Düzenle</legend><br><br>";
        $bolgeidler[$b] = $bolgebilgi["bolge_id"];
        echo "<a>Bölge başlığı : </a> <input type='text' name='bolge_baslik[".$b."]' value='".$bolgebilgi["bolge_baslik"]."' /><br><br>";
        $bolgeid = $bolgebilgi["bolge_id"];
        $alanlar = $fg->formAlanlarGetir($baglan,$form_turu_id,$bolgeid);
        if($alanlar){
            $a = 0;
            foreach($alanlar as $alanbilgi){
                echo "<hr>";
                $alanidler[$b][$a] = $alanbilgi["alan_id"];
                echo "<a>".$alanbilgi["alan_turu"]." İçin Açıklama </a> <input type='text' name='alanaciklama[".$b."][".$a."]' value='".$alanbilgi["alan_aciklama"]."' /><br><br>";
                if($alanbilgi["alan_turu"] == "selectmenu" || $alanbilgi["alan_turu"] == "radio" || $alanbilgi["alan_turu"] == "checkbox"){
                    $secenekler = $fm->alanSeceneklerGetir($baglan,$alanbilgi["alan_id"]);
                    if($secenekler){
                        $s = 0;
                        echo "<hr>";
                        foreach($secenekler as $secenek){
                            $secenekidler[$b][$a][$s] = $secenek["secenek_id"];
                            echo $alanbilgi["alan_turu"]." 'e ait ";
                            echo "<a>".($s+1).". Seçenek İçin Açıklama </a> <input type='text' name='secenekaciklama[".$b."][".$a."][".$s."]' value='".$secenek["aciklama"]."' /><br><br>";  
                        $s++;
                        }
                        echo "</hr>";
                    }
                }else if($alanbilgi["alan_turu"] == "veritablotext" || $alanbilgi["alan_turu"] == "veritablocheck"){
                   $nitelikler = $fm->tabloUstNitelikGetir($baglan,$alanbilgi["alan_id"]);
                   if($nitelikler){
                    $n = 0;
                    echo "<hr>";
                    foreach($nitelikler as $nitelik){
                        $nitelikidler[$b][$a][$n] = $nitelik["nitelik_id"]; 
                        echo $alanbilgi["alan_turu"]." 'e ait ";
                        echo "<a>".($n+1).". üst Nitelik İçin Açıklama </a> <input type='text' name='nitelikaciklama[".$b."][".$a."][".$n."]' value='".$nitelik["aciklama"]."' /><br><br>";  
                    $n++; 
                    echo "</hr>";  
                    }
                   }
                   $yannitelikler = $fm->tabloYanNitelikGetir($baglan,$alanbilgi["alan_id"]);
                   if($yannitelikler){
                    $yn = 0;
                    echo "<hr>";
                    foreach($yannitelikler as $yannitelik){
                        $yannitelikidler[$b][$a][$yn] = $yannitelik["nitelik_id"];
                        echo $alanbilgi["alan_turu"]." 'e ait ";
                        echo "<a>".($yn+1).". yan Nitelik İçin Açıklama </a> <input type='text' name='yannitelikaciklama[".$b."][".$a."][".$yn."]' value='".$yannitelik["aciklama"]."' /><br><br>";  
                    $yn++;   
                    
                    }
                    echo "</hr>";  
                   }
                }    
                $a++;
            }
            echo "<br>";
        }

        echo "</fieldset>";
        $b++;
        }

    }else {
        echo "Forma Ait Bölge Bulunamadı.!";
    }

	
    echo "<div class='col-md-11'><input class='btn btn-success' type='submit' name='guncelle' value='Form Bilgilerini Güncelle' /></div></form><br><br>"; 

}else {
    echo hataMetni("Bu Form Türü Bulunamadı.!");
}

if(isset($_POST["guncelle"])){
    $bolgebasliklar = null;
    $yannitelikaciklamalar = null;
    $nitelikaciklamalar = null;
    $alanaciklamalar = null;
    $secenekaciklamalar = null;

    if(isset($_POST["bolge_baslik"])){
        $bolgebasliklar = $_POST["bolge_baslik"];
    }

    if(isset($_POST["yannitelikaciklama"])){
        $yannitelikaciklamalar = $_POST["yannitelikaciklama"];
    }
 
    if(isset($_POST["nitelikaciklama"])){
        $nitelikaciklamalar = $_POST["nitelikaciklama"];
    }    
    if(isset($_POST["secenekaciklama"])){
        $secenekaciklamalar = $_POST["secenekaciklama"];
    }
    if(isset($_POST["alanaciklama"])){
        $alanaciklamalar = $_POST["alanaciklama"];
    }


    if(isset($_POST["form_baslik"])){
        $form_baslik = htmlspecialchars(ozelkarakterSil($_POST["form_baslik"]));
        $resim_url = htmlspecialchars($_POST["secilen_resim_url"]);
        if(isset($_FILES["form_resim"])){
            $resim_url = $fg->formResimEkle($_FILES["form_resim"], htmlspecialchars($_POST["secilen_resim_url"]));
        }
       $fg->formTuruGuncelle($baglan,$form_baslik,$resim_url,$form_turu_id);
    }

    if(isset($_POST["teslim_sayisi"])){
        $teslim_sayisi = htmlspecialchars($_POST["teslim_sayisi"]);
        $fg->teslimSayisiGuncelle($baglan,$teslim_sayisi,$form_turu_id);
    }

    if($bolgebasliklar!=null){
       //$alanaciklamalar,$secenekaciklamalar,$nitelikaciklamalar,$yannitelikaciklamalar
       //$bolgeidler,$alanidler,$secenekidler,$nitelikidler,$yannitelikidler
       $aciklamalar = array("alanaciklamalar"=>$alanaciklamalar,"secenekaciklamalar"=>$secenekaciklamalar,
                                "nitelikaciklamalar"=>$nitelikaciklamalar,"yannitelikaciklamalar"=>$yannitelikaciklamalar);
       $idler = array("bolgeidler"=>$bolgeidler,"alanidler"=>$alanidler,"secenekidler"=>$secenekidler,"nitelikidler"=>$nitelikidler,
                            "yannitelikidler"=>$yannitelikidler);
       if($fg->bolgeveAlanlariGuncelle($baglan,$bolgebasliklar,$aciklamalar,$idler)){
            echo basariMetni("Tüm güncellemeler yapıldı.");
       }else {
            echo hataMetni("Bazı güncellemeler sırasında sorun oluştu");
       }
    }

}

include("view/footer.php");


?>

