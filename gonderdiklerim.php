<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include ("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");

include ("view/sidebar.php");


require_once "models/formturumodel.php";
require_once "models/formmodel.php";

$myid = $_SESSION["kid"];

$tur = "mezuniyetkriteri";


?>

<?php

//Gönderdiğim formları görüntüle

function formGoruntule($form,$fm,$baglan){
    $formust = $fm->formUstBilgiGetir($baglan,$form["form_turu_id"]);

        echo '  <div style="width:32%;height:40%;" class="col">
  <div class="card border-secondary mb-3">
      <div class="text-center">
                <img src="'.$formust["resim_url"].'" style="width:250px;height:250px;" class="card-img-top" alt="...">
                <div class="card-body text-secondary">';      
    echo ' <a class="btn btn-sm btn-outline-success" href="formgoruntule.php?form_id='.$form["form_id"].'">'
                              . 'Form Görüntüle</a>';
        
     echo ' <a class="btn btn-sm btn-outline-danger" href="ogrenciformsil.php?form_id='.$form["form_id"].'">'
                              . 'Formu Sil</a>';
      echo ' <a class="btn btn-sm btn-outline-info" href="formguncelle.php?form_id='.$form["form_id"].'">'
                              . 'Güncelle</a></div>'; 
    echo ' <ul class="list-group list-group-flush">
                     <li class="list-group-item"><h5 class="card-title">'.$formust["baslik"].'</h5></li>'
            . '<li class="list-group-item">';
   if($form["form_durum"] == "onay"){echo '<span class="badge text-bg-success">Onaylı</span>';}
  else if($form["form_durum"] == "red"){echo '<span class="badge text-bg-danger">Reddedilmiş</span>';}
  else if($form["form_durum"] == "bekleme"){echo '<span class="badge text-bg-secondary">Beklemede</span>';}
    echo '</li>';
    echo '</ul></div></div>
          </div>';    
}


?>

<div class="row justify-content-center"> 
<div class="col-12">

</div>
<br><br><br>
<div class="col-8">
    <input class="form-control" type="text" id="aranan" placeholder="Lütfen form başlığı girin." />
</div>
<div class="col-2">
    <button id="ara" style="width:100%" class="btn btn-warning" type="submit" name="ara">Arama Yap</button>
</div>

</div><br><br>

<?php 
try {


$fm = new FormModel();
    
if(isset($_GET["s"]) && !empty($_GET["s"])){
    $sayfa2 = 1;
    if(isset($_GET["sp"])){
            $sayfa2 = htmlspecialchars(ozelkarakterSil($_GET["sp"]));
    }
    $sayfasayisi2 = 1;
    $slimit = 5;
    $suankiSayfa2 = $sayfa2;

    $aranan = htmlspecialchars(ozelkarakterSil($_GET["s"]));

    $aramaformsay = $fm->gonderdigimFormlarAramaSay($baglan,$myid,$aranan);

    $formarama = $fm->gonderdigimFormlardaAra($baglan,$myid,$suankiSayfa2,$slimit,$aranan);

    if($formarama){
        echo '<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">';
        foreach($formarama as $form){
            formGoruntule($form,$fm,$baglan);
        }
        echo "</div>";
        
        $sayfasayisi2 = $aramaformsay/$slimit;

        if($sayfasayisi2>1){
            echo '<nav aria-label="...">
            <ul class="pagination pagination-lg justify-content-center">';
            if($suankiSayfa2>1){
               echo '<li class="page-item"><a href="gonderdiklerim.php?s='.$aranan.'&sp='.($suankiSayfa2-1).'"
                class="page-link">Önceki</a></li>';
            }
          
        $range = 5;
        $start_page = max(1, $suankiSayfa2 - $range);
        $end_page = min($sayfasayisi2, $suankiSayfa2 + $range);

        for($i = $start_page;$i<=$end_page;$i++){
        if($i == $suankiSayfa2){
            echo '<li class="page-item disabled"><a class="page-link" href="gonderdiklerim.php?s='.$aranan.'&sp='.$i.'>'.$i.'</a></li>';
        }else {
            echo '<li class="page-item"><a class="page-link" href="gonderdiklerim.php?s='.$aranan.'&sp='.$i.'>'.$i.'</a></li>';
        }
        }
            if($suankiSayfa2<$sayfasayisi2){
            echo '<li class="page-item">
                <a class="page-link" href="gonderdiklerim.php?s='.$aranan.'&sp='.($suankiSayfa2+1).'">Sonraki</a>
            </li>';
            }
        
            echo '</ul>
            </nav>';
        }

    }else{
        echo hataMetni("Bu Form Bulunamadı.!");
    }
   
}else {

   
$sayfa = 1;
if(isset($_GET["p"])){
        $sayfa = htmlspecialchars(ozelkarakterSil($_GET["p"]));
}
$sayfasayisi = 1;
$limit = 9;
$suankiSayfa = $sayfa;

$formsay = $fm->gonderdigimFormlariSay($baglan,$myid);

$formlar = $fm->gonderdigimFormlariGetir($baglan,$myid,$suankiSayfa,$limit);



if($formlar){
    $sayfasayisi = $formsay/$limit;
     echo '<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">';
    foreach($formlar as $form){
    formGoruntule($form,$fm,$baglan);
    }
    echo "</div>";
    if($sayfasayisi>1){
        echo '<nav aria-label="...">
        <ul class="pagination pagination-lg justify-content-center">';
        if($suankiSayfa>1){
           echo '<li class="page-item"><a href="gonderdiklerim.php?p='.($suankiSayfa-1).'&form_tipi='.$tur.'"
            class="page-link">Önceki</a></li>';
        }

        $range = 5;
        $start_page = max(1, $suankiSayfa - $range);
        $end_page = min($sayfasayisi, $suankiSayfa + $range);

        for($i = $start_page;$i<=$end_page;$i++){
        if($i == $suankiSayfa){
            echo '<li class="page-item disabled"><a class="page-link" href="gonderdiklerim.php?p='.$i.'&form_tipi='.$tur.'">'.$i.'</a></li>';
        }else {
            echo '<li class="page-item"><a class="page-link" href="gonderdiklerim.php?p='.$i.'&form_tipi='.$tur.'">'.$i.'</a></li>';
        }
        }

        if($suankiSayfa<$sayfasayisi){
        echo '<li class="page-item">
            <a class="page-link" href="gonderdiklerim.php?p='.($suankiSayfa+1).'&form_tipi='.$tur.'">Sonraki</a>
        </li>';
        }
    
        echo '</ul>
        </nav>';
    }
}else {
    echo hataMetni("Formlar Bulunamadı..");
}
    
}              
    
}catch(Exception $e){
    echo hataMetni("Hata Oluştu.! -> Kodu : ".$e->getCode()."<br>".$e->getMessage()."<br>");
}
include("view/footer.php");


?>
<script>
    $(document).ready(function(){
    $(document).on('click','button#ara',function(){
        var aranan = $("input#aranan").val();
       
        document.location.href = "gonderdiklerim.php?s="+aranan+"";
    });
});
</script>