
<html>
<?php

include("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");
if(!isset($_GET["form_id"])){
    header("Location:index.php");
}

include ("view/sidebar.php");

require_once "models/formmodel.php";
require_once "models/kullanicimodel.php";

?>
<style>
  

</style>
<script src="js/formgenislet.js"></script>
<script>
     $(document).on('click','#resimalani',function(){
        var resimurl = $(this).attr("src");
        var modalhtml = '<img src='+resimurl+' />';
        $("#resimgoruntule").html(modalhtml);
     });
</script>
<link href="css/table.css" rel="stylesheet">

<div class="modal modal-fullscreen fade" id="resimModal" tabindex="-1" aria-labelledby="resimModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
<div class="modal-content">
<div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Resimi görüntüle</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<div class="modal-body">
    <div id="resimgoruntule"></div>
</div>
</div></div></div>
<?php

$k_id = $_SESSION["kid"];

$form_id = htmlspecialchars($_GET["form_id"]);

$fm = new FormModel();
$klview = new KullaniciModel();


try {

    
$form = $fm->formBilgileri($baglan,$form_id);

if($akademisyen_kontrol){

if(isset($_POST["onayla"])){
    if(isset($_POST["not"]) && !empty($_POST["not"])){
        $onay_metin = htmlspecialchars($_POST["not"]);
        $fm->onayRedEkle($baglan,$form_id,$onay_metin,$k_id,"onay");
    }else {
        echo hataMetni("Onay Metni Alınamadı.!");
    }
 }
 
 if(isset($_POST["reddet"])){
    if(isset($_POST["not"]) && !empty($_POST["not"])){
        $red_metin = htmlspecialchars($_POST["not"]);
        $fm->onayRedEkle($baglan,$form_id,$red_metin,$k_id,"red");
    }else {
        echo hataMetni("Red Metni Alınamadı.!");
    }
 }
 
 
 
}

if($form){

if(($sadece_akademisyen && $form["gonderilen_akademisyen_id"] != $k_id) || (!$akademisyen_kontrol && $form["ekleyen_id"]!=$k_id)){
    die(hataMetni("Bu forma erişemezsiniz çünkü size gönderilmedi."));
}    

$form_turu_id = $form["form_turu_id"];
$formtur = $fm->formTurBilgileri($baglan,$form_turu_id);
    


$bolgeler = $fm->bolgeBilgileri($baglan,$form_turu_id);

if($bolgeler){   

echo "<div id='baslik'>";
echo '<h2>'.$formtur["baslik"].'</h2><hr><br>';
$kullanici = $klview->kullaniciBilgileri($baglan, $form["ekleyen_id"]);
if($form["ekleyen_id"] == $k_id){
    echo "<h6>Daha Önce Eklediğiniz Form</h6><br>";
}else if($k_id == $form["gonderilen_akademisyen_id"]) {
    echo $kullanici["adsoyad"]." Tarafından Size Gönderilen Form</div><br>";
}
$i = 0;
 echo "<div id='formbolgesi'>";
  echo "<form action='' method='post'>";
foreach($bolgeler as $bolge){
   
    echo '<fieldset class="formbolgesi" id="formbolgesi'.$i.'" name="formbolgesi">'
                        .'<legend>'.$bolge["bolge_baslik"].'</legend><div id="bolgeicerik"><div class="row g-3">';
    
    $alanlar = $fm->alanBilgileri($baglan,$form_turu_id,$bolge["bolge_id"]);
    
    if($alanlar){
       $j = 0; 
       foreach($alanlar as $alan){
        $alan_id = $alan["alan_id"];
    
        $alanveriler = $fm->alanVerisiGetir($baglan,$form_id,$alan_id);
        if($alan["alan_turu"] == "textbox"){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>';        
            if($alanveriler){   
            echo '<div
            tabindex="0"
            data-bs-toggle="popover"
            data-bs-placement="bottom"
            data-bs-trigger="hover focus"
            data-bs-content="'.$alanveriler["veri"].'">
            <input class="form-control" type="text" name="textbox['.$i.']['.$j.']" value="'.$alanveriler["veri"].'" disabled />
            </div>
            <br><br>';
            }else {
                echo hataMetni("Bu Alana Ait Veri Bulunamadı..");
            }
            echo "</div>";
        }else if($alan["alan_turu"] == "resimalani"){
            if($alanveriler){
            echo '<div class="col-md-11">';

            
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>';            
            echo '<img data-bs-toggle="modal" data-bs-target="#resimModal" id="resimalani" width="250px" height="250px" src="'.$alanveriler["veri"].'" class="rounded mx-auto d-block" alt="...">';

            echo '</div>';
            }else {
                echo hataMetni("Bu alan için resim yüklenmedi.");
            }

        }else if($alan["alan_turu"]=="radio"){
            $secenekler = $fm->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label><br>';
            if($secenekler){
            if($alanveriler){
                $alanveriler = $fm->alanVerisiGetir($baglan,$form_id,$alan["alan_id"]);
                echo "<div class='form-check'>";    
                foreach($secenekler as $secenek){
                if($alanveriler["veri"] == $secenek["aciklama"]){    
                echo '<input class="form-check-input" type="radio" value="'.$alan["alan_aciklama"].'" name="radio['.$i.']['.$j.']" checked disabled>'
                                                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';
                }else {  
                echo '<input class="form-check-input" type="radio" value="'.$alan["alan_aciklama"].'" name="radio['.$i.']['.$j.']" disabled>'
                                                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>'; 
                }
                }
                echo "</div>";
             }else {
                echo hataMetni("Bu alan için seçim yapılmamış.");
                foreach($secenekler as $secenek){
                echo '<input class="form-check-input" type="radio" value="'.$alan["alan_aciklama"].'" name="radio['.$i.']['.$j.']" disabled>'
                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>'; 
                }
             }
            }else {
                echo hataMetni("Bu Alana Ait Veri Bulunamadı.!");
            }
             echo "</div>";
        }
        else if($alan["alan_turu"]=="checkbox"){
            
            echo '<div class="col-md-11">';
            $secenekler = $fm->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label><br>';
            if($secenekler){
            if($alanveriler){  
            $alanveriler = $fm->alanVerileriGetir($baglan,$form_id,$alan_id);
            echo "<div class='form-check'>";    
            $aktifler = array();
            foreach($alanveriler as $alanveri){
                array_push($aktifler,$alanveri["veri"]);
            }
            
            foreach($secenekler as $secenek){
            if(in_array($secenek["aciklama"],$aktifler)){    
            echo '<input class="form-check-input" type="checkbox" value="'.$alan["alan_aciklama"].'" name="checkbox['.$i.']['.$j.']" checked disabled>'
                                            .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';   
            }else {
              echo '<input class="form-check-input" type="checkbox" value="'.$alan["alan_aciklama"].'" name="checkbox['.$i.']['.$j.']" disabled>'
                                            .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';    
            }
            }
            echo "</div>";
            }else {
                echo hataMetni("Bu alan için seçim yapılmamış.");
                foreach($secenekler as $secenek){
                    echo '<input class="form-check-input" type="checkbox" value="'.$secenek["aciklama"].'" name="checkbox['.$i.']['.$j.']" disabled>'
                                                    .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';   
                }
            }
            }else {
                hataMetni("Bu Alana Ait Veri Bulunamadı.");
            }
            echo "</div>";
        }
        else if($alan["alan_turu"]=="textarea"){
            echo '<div class="col-md-11">';
             
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>';
            if($alanveriler){
            echo '<textarea class="form-control" name="textarea['.$i.']['.$j.']" disabled>'.$alanveriler["veri"].'</textarea><br><br>';
            }else {
                echo hataMetni("Bu Alana Ait Veri Bulunamadı.!");
            }
            echo "</div>";
        }
        else if($alan["alan_turu"]=="selectmenu"){
            $alanveriler = $fm->alanVerisiGetir($baglan,$form_id,$alan_id);
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' </label>';
            if($alanveriler){
            echo '<select class="form-select" name="select['.$i.']['.$j.']" disabled>';
            echo '<option value="'.$alanveriler["veri"].'">'.$alanveriler["veri"].'</option>';
            echo '</select><br>';
            }else {
                echo hataMetni("Bu Alana Ait Veri Bulunamadı.!");
            }
            echo "</div>";
        }else if($alan["alan_turu"] == "date"){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>';
            if($alanveriler){
            echo '<input class="form-control" type="date" name="date['.$i.']['.$j.']" value="'.$alanveriler["veri"].'" disabled /><br><br>';
            }else {
                echo hataMetni("Bu Alana Ait Veri Bulunamadı.!");
            }
            echo "</div>";
        }else if($alan["alan_turu"] == "datetime"){
             echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>';
            if($alanveriler){
            echo '<input class="form-control" type="datetime-local" name="datetime['.$i.']['.$j.']" value="'.$alanveriler["veri"].'" disabled /><br><br>';
            }else {
                echo hataMetni("Bu Alana Ait Veri Bulunamadı.!");
            }
            echo "</div>";
        }else if($alan["alan_turu"] == "veritablotext" || $alan["alan_turu"] == "veritablocheck"){
            
            $nitelik = $fm->tabloUstNitelikGetir($baglan,$alan["alan_id"]);
            $niteliksayi = $fm->tabloUstNitelikSay($baglan,$alan["alan_id"]);

            $niteliktablo = array();
            $nitelikidler = array();
            
            if($nitelik){
            
            foreach($nitelik as $nitelikal){
                $niteliktablo[intval($nitelikal["tablodaki_sirasi"])] = $nitelikal["aciklama"];
                $nitelikidler[intval($nitelikal["tablodaki_sirasi"])] = $nitelikal["nitelik_id"];
            }
            
            }
            $yannitelik = $fm->tabloYanNitelikGetir($baglan,$alan["alan_id"]);
            $yanniteliksayi = $fm->tabloYanNitelikSay($baglan,$alan["alan_id"]);
            
         if($yannitelik){
            
            $yanniteliktablo = array();
            $yannitelikidler = array();
            
             foreach($yannitelik as $yannitelikal){
                $yanniteliktablo[intval($yannitelikal["tablodaki_sirasi"])] = $yannitelikal["aciklama"];
                $yannitelikidler[intval($yannitelikal["tablodaki_sirasi"])] = $yannitelikal["nitelik_id"];
            }
            
         }
            
           
        if($alan["alan_turu"] === "veritablotext"){
               
          
        echo '<div class="col-md-11">';
            echo '<a>'.$alan["alan_aciklama"].'</a>  <br><br>';
            echo '<table class="table table-striped table-hover table-bordered">';
            
            if($niteliksayi>0 && $yanniteliksayi>0){
            echo "<thead><th></th>";
            for ($k=0;$k<count($niteliktablo);$k++){
            echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
            }
            echo "</thead>";
             echo "</tr><tbody id ='satirlar".($i+1)."_".($j+1)."'>";
            
            for ($m=0;$m<count($yanniteliktablo);$m++){
            echo "<tr><th scope='row'>".$yanniteliktablo[$m]."</th>";
            for($n=0;$n<count($niteliktablo);$n++){
             
             $icerik = $fm->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$nitelikidler[$n],$yannitelikidler[$m]);
             if($icerik){
                if(!empty($icerik["icerik"])){
                echo  "<td>";
                        echo "<a data-bs-container='body' data-bs-toggle='popover' data-bs-placement='bottom' data-bs-content='".$icerik["icerik"]."'>".$icerik["icerik"]."</a></td>";
                }else {
                    echo "<td>-</td>";
                }
             }else {
                 echo "<td>-</td>";
             }
            }
            echo "</tr>";  
            echo "</tbody>";
            }
            }else if($niteliksayi>0){
               echo "<thead>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
            
                echo "<tbody>";
             
                 $satirsayisi = $fm->tabloSatirSayisi($baglan,$alan["alan_id"],$form_id);
                 $satirsayisi = $satirsayisi[0];
       
                for($m=0;$m<$satirsayisi;$m++){
                echo "<tr>"; 
                for($n=0;$n<count($niteliktablo);$n++){
                $x = -($m+1);
                $icerik = $fm->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$nitelikidler[$n],$x);
                if($icerik){
                if(!empty($icerik["icerik"])){
                echo  "<td>";
                echo "<a data-bs-container='body' data-bs-toggle='popover' data-bs-placement='bottom' data-bs-content='".$icerik["icerik"]."'>".$icerik["icerik"]."</a></td>";
                }else {
                    echo "<td>-</td>";
                }
                }else {
                    echo "<td>-</td>";
                }
                }
              
                echo "</tr>";
                }
                echo "</tbody>";
                
            }
            
            echo '</table></div>';
            
            
          }else if($alan["alan_turu"] === "veritablocheck"){
          echo '<div class="col-md-11">';
            echo '<a>'.$alan["alan_aciklama"].'</a>  <br><br>';
            echo '<table class="table table-striped table-hover table-bordered">';
            
            if($niteliksayi>0 && $yanniteliksayi>0){
                echo "<thead><th></th>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                 echo "</tr><tbody id ='satirlar".($i+1)."_".($j+1)."'>";
             
               for ($m=0;$m<count($yanniteliktablo);$m++){
                echo "<tr><th scope='row'>".$yanniteliktablo[$m]."</th>";
                    for($n=0;$n<count($niteliktablo);$n++){
                    $icerik = $fm->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$nitelikidler[$n],$yannitelikidler[$m]);
                    if($icerik){
                    if($icerik["icerik"] == "pasif"){
                     echo "<td><input type='checkbox'"
                       . "class='form-check-input' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]'"
                               ."id='tablovericheck' value='pasif' disabled /></td>";
                    }else if($icerik["icerik"] == "aktif"){
                      echo "<td><input type='checkbox'"
                       . "class='form-check-input' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]'"
                               ."id='tablovericheck' value='aktif' checked disabled /></td>";  
                    }else {
                        echo "<td>NaN</td>";
                    }
                    }else {
                        echo "NaN";
                    }
                    }
              }
              
            echo "</tbody>";
          
              
             }else if($niteliksayi>0){
               echo "<thead>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                
                echo "<tbody>"; 
                 $satirsayisi = $fm->tabloSatirSayisi($baglan,$alan["alan_id"],$form_id);
                 $satirsayisi = $satirsayisi[0];
                
                
                for($m=0;$m<$satirsayisi;$m++){
                echo "<tr>"; 
                for($n=0;$n<count($niteliktablo);$n++){
                $x = -($m+1);
                $icerik = $fm->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$nitelikidler[$n],$x);
                if($icerik){
                if($icerik["icerik"] == "aktif"){
                  echo "<td><input type='checkbox' "
                       . "class='form-check-input' name='tablovericheck2[".$i."][".$j."][0][".$n."]'"
                               ."id='tablovericheck' value='".$icerik["icerik"]."' checked disabled/></td>";
                }else if($icerik["icerik"] == "pasif"){
                    echo "<td><input type='checkbox' "
                       . "class='form-check-input' name='tablovericheck2[".$i."][".$j."][0][".$n."]'"
                               ."id='tablovericheck' value='".$icerik["icerik"]."' disabled/></td>";
                }else {
                    echo "<td>NaN</td>";
                }
                }else {
                    echo "<td>NaN</td>";
                }
                }
              
                echo "</tr>";
                
                }
               
                echo "</tbody>";
                 
             }
            
             
             echo '</table></div>';
              
            }
        
       }

    $j++; 
      
       }
    }else {
        echo hataMetni("Bu Forma Ait Alan Bulunamadı.!");
    }
    

   
    echo '</div></div></fieldset>';

    
   $i++;
}
if($i>=3){
    echo '<button id="genislet_'.$i.'" type="button" class="genislet btn btn-outline-secondary">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
<path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
</svg>
    <span>Diğer bölgeler</span>
  </button>';
}



//onay_durum=0 ise beklemede. 1 ise onaylı 2 ise red
echo '<br><br> <div class="row g-3">';

if($form["form_durum"] == "bekleme"){
    if($akademisyen_kontrol){    
echo "<label class='form-label'><b>Değerlendirmenizi Girin : </b></label><br>"
    . "<div class='col-md-11'><textarea class='form-control' name='not'></textarea></div><br>";
echo '<div class="col-md-6"><input class="btn btn-success" type="submit" value="Formu Onayla" name="onayla" /></div> ';
echo '<div class="col-md-6"><input class="btn btn-danger" type="submit" value="Formu Reddet" name="reddet" /></div> ';
    }else {
        echo "<div class='col-md-11 card'>Form Beklemede.</div>";
    }
}else {
    $onaycek = $fm->onayMetniCek($baglan,$form_id);
    if($onaycek){
    $ogretmen = $klview->kullaniciBilgileri($baglan, $onaycek["ogretmen_id"]);  
    if($ogretmen){
    echo "<div class='col-md-11 card'>"; 
    if($form["form_durum"] == "onay"){
        if($ogretmen["kullanici_id"] == $k_id){
            echo "<div class='card-header'><b>Bu Formu Onaylayıp ";
            echo "Gönderdiğiniz <a style='color:green'> Onay</a> Metni</b></div>";    
        }else {
        echo "<div class='card-header'><b>Bu Formu Onaylayıp ";
        echo "".$ogretmen["adsoyad"]." Tarafından Gönderilen <a style='color:green'> Onay</a> Metni</b></div>";
        }
       echo "<div class='card-body'><p class='card-text'>".$onaycek["metin"]."</p></div>";
    }else if($form["form_durum"] =="red"){
        if($ogretmen["kullanici_id"] == $k_id){
            echo "<div class='card-header'><b>Formu Reddedip"
            ." Gönderdiğiniz <a style='color:red'>Red<a> Metni</b></div>";
        }else {
        echo "<div class='card-header'><b>Formu Reddeden"
        . " ".$ogretmen["adsoyad"]." Tarafından Gönderilen <a style='color:red'>Red<a> Metni</b></div>";
        }
        echo "<div class='card-body'><p class='card-text'>".$onaycek["metin"]."</p></div>";        
    }
     echo "</div>";
    }
    }
}
echo "</div>";
echo '</form></div>';

}else {
    echo hataMetni("Bu Form İçin Form Bölgesi Bulunamadı.!");
}

}else {
    echo hataMetni("Form bulunamadı.!");
}


}catch(Exception $e){
        echo hataMetni("Hata Oluştu.! -> Kodu : ".$e->getCode()."<br>".$e->getMessage()."<br>");
        
}


include("view/footer.php");



?>
  <script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
  </script>