   
<?php

//Öğrenci için form güncelleyecek formlara içeriği yazılacak

include("oturumbaslat.php");
include("veritabani.php");
if(!isset($_GET["form_id"])){
    header("Location:index.php");
}
include("ayarlar.php");
include ("view/sidebar.php");

require_once "models/formmodel.php";
require_once "models/kullanicimodel.php";

?>
   <head>
        <script src="js/islemler.js"></script>
        <script src="js/formislemleri.js">
        </script>
        <script src="js/formgenislet.js"></script>

        <link href="css/table.css" rel="stylesheet">
    </head>
<?php


$k_id = $_SESSION["kid"];

$form_id = htmlspecialchars($_GET["form_id"]);

$fmg = new FormModel();

$klview = new KullaniciModel();


$i = 0;



$formbilgi = $fmg->formBilgileri($baglan,$form_id);


if($k_id != $formbilgi["ekleyen_id"]){
    die(hataMetni("Bu formu güncelleyemezsiniz.."));
}

if($formbilgi){
    
$form_turu_id = $formbilgi["form_turu_id"];
    
$form = $fmg->formTurBilgileri($baglan,$form_turu_id);

if($form){


$sayfa = 1;
if(isset($_GET["p"])){
             $sayfa = htmlspecialchars(ozelkarakterSil($_GET["p"]));
}
        

$bolgeler = $fmg->bolgeBilgileri($baglan,$form_turu_id);


if($bolgeler){
     

echo "<div id='baslik'>";
echo '<h2>'.$form["baslik"].'</h2><hr><br>';
$kullanici = $klview->kullaniciBilgileri($baglan, $k_id);
echo "<b>" . $kullanici["adsoyad"]."</b> olarak formu gönderiyorsunuz.</div><br>";

echo "<div id='formbolgesi'>";
echo "<form action='' method='post' enctype='multipart/form-data'>";
foreach($bolgeler as $bolge){
    
    echo '<fieldset class="formbolgesi" id="formbolgesi'.$i.'" name="formbolgesi">'
                        .'<legend>'.$bolge["bolge_baslik"].'</legend><div id="bolgeicerik"><div class="row g-3">';
    
    $alanlar = $fmg->alanBilgileri($baglan,$form_turu_id,$bolge["bolge_id"]);
    if($alanlar){
     $fmg->ustsutunidler[$i]["ch1"] = array();
     $fmg->yansutunidler[$i]["ch1"] = array();
     $fmg->ustsutunidler[$i]["txt1"] = array();
     $fmg->yansutunidler[$i]["txt1"] = array();
     $fmg->alan_idler[$i]["ch1"] = array();
     $fmg->alan_idler[$i]["txt1"] = array();
            
     $fmg->ustsutunidler[$i]["ch2"] = array();
     $fmg->alan_idler[$i]["ch2"] = array();
     $fmg->ustsutunidler[$i]["txt2"] = array();
     $fmg->alan_idler[$i]["txt2"] = array();
            
       $j = 0; 
       foreach($alanlar as $alan1){
       if($alan1["alan_turu"] != "veritablotext" || $alan1["alan_turu"] != "veritablocheck"){    
       $fmg->alan_idler[$i][$alan1["alan_turu"]] = array();
       }
       }
       foreach($alanlar as $alan){
       $alan_id = $alan["alan_id"];     
         
        $alanveriler = $fmg->alanVerisiGetir($baglan,$form_id,$alan_id); 

        if($alan){
            array_push($fmg->alan_idler[$i][$alan["alan_turu"]],$alan["alan_id"]);
        }


        if($alan["alan_turu"] == "textbox"){
             if($alanveriler){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>'
                    .'<input value="'.$alanveriler["veri"].'"  class="form-control" type="text" name="textbox['.$i.']['.$j.']" />';
            echo "</div><br>";
            }else {
                echo '<div class="col-md-6">';
                echo '<label class="form-label">'.$alan["alan_aciklama"].' (Veri bulunamadı) </label>'
                        .'<input value=""  class="form-control" type="text" name="textbox['.$i.']['.$j.']" />';
                echo "</div><br>";
            }
            
        }else if($alan["alan_turu"] == "resimalani"){
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>';
            
            
          
            if($alanveriler){
            echo '<br><label class="form-label">Yüklediğiniz eski resim : </label>';
            $fmg->resim_urller[$i][$j] = $alanveriler["veri"];
            echo '<br><br><img width="250px" height="250px" src="'.$alanveriler["veri"].'" class="rounded" alt="...">';     
            echo "</div><br><br><br>";
           }else {
            echo '<br><label class="form-label"><i>Bu alan için resim yüklenmemiş ,Yeni resim yükleyin :  </i></label>';
            $fmg->resim_urller[$i][$j] = "";
            echo "</div><br><br><br>";
           }
           echo "<br><input class='form-control' type='file' name='resimalani[".$i."][".$j."]' ></input><br>";
           

        }else if($alan["alan_turu"]=="radio"){
            echo '<div class="col-md-11">';
            $secenekler = $fmg->alanSeceneklerGetir($baglan,$alan["alan_id"]);

            if($secenekler){
                if($alanveriler){
                echo '<label class="form-label">'.$alan["alan_aciklama"].'</label><br>';
                echo "<div class='form-check'>";
                foreach($secenekler as $secenek){
                if($alanveriler["veri"] == $secenek["aciklama"]){    
                echo '<input class="form-check-input" type="radio" value="'.$secenek["aciklama"].'" name="radio['.$i.']['.$j.']" checked>'
                                                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';
                }else {  
                echo '<input class="form-check-input" type="radio" value="'.$secenek["aciklama"].'" name="radio['.$i.']['.$j.']">'
                                                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>'; 
                }
                }
                echo "</div>";
                }else {
                    echo '<label class="form-label">'.$alan["alan_aciklama"].'(Veri bulunamadı.)</label><br>';
                    echo "<div class='form-check'>";
                    foreach($secenekler as $secenek){
                        echo '<input class="form-check-input" type="radio" value="'.$secenek["aciklama"].'" name="radio['.$i.']['.$j.']">'
                                                        .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';    
                    }
                    echo "</div>";  
                }
                
                echo "</div><br>";
            
            }else {
                echo hataMetni("Bu Alana Ait Seçenek Bulunamadı.");
            }
        }
        else if($alan["alan_turu"]=="checkbox"){
            $alanveriler = $fmg->alanVerileriGetir($baglan,$form_id,$alan_id); 
          
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'</label><br>';
            $secenekler = $fmg->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            $k = 0;
            echo "<div class='form-check'>";
            if($secenekler){
            echo "<div class='form-check'>";  
            if($alanveriler){
                $aktifler = array(array());
                foreach($alanveriler as $alanveri){
                    $aktifler[$alanveri["veri_id"]] = $alanveri["veri"];
                }
                
                foreach($secenekler as $secenek){
                

                if(in_array($secenek["aciklama"],$aktifler)){    
                $aktif_id = array_search($secenek["aciklama"], $aktifler);
                echo '<input type="hidden" name="aktifidler['.$i.']['.$j.']['.$k.']" value="'.$aktif_id.'"  />';
                echo '<input type="hidden" name="gonderilecekidler['.$i.']['.$j.']['.$k.']" value="0" />';

                echo '<input class="form-check-input" type="checkbox" value="'.$secenek["aciklama"].'" name="checkbox['.$i.']['.$j.']['.$k.']" checked>'
                                                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';   
                }else {
                echo '<input class="form-check-input" type="checkbox" value="'.$secenek["aciklama"].'" name="checkbox['.$i.']['.$j.']['.$k.']">'
                                                .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>';    
                }
                $k++;
                }
            }else {
                echo "<i>Alana veri girilmemiş </i><br>";
                foreach($secenekler as $secenek){
                    echo '<input class="form-check-input" type="checkbox" value="'.$secenek["aciklama"].'" name="checkbox['.$i.']['.$j.']['.$k.']">'
                                                    .'<label class="form-check-label">'.$secenek["aciklama"].'</label><br>'; 
                $k++;   
                }
            }  

            echo "</div>";
            }else {
                echo hataMetni("Bu Alana Ait seçenekler bulunamadı.");
            }
            
            echo "</div></div><br>";
           
        }
        else if($alan["alan_turu"]=="textarea"){
            if($alanveriler){
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' : </label>'
                    .'<textarea class="form-control" name="textarea['.$i.']['.$j.']">'.$alanveriler["veri"].'</textarea>';
            echo "</div><br>";
           }else {
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' : (Veri bulunamadı)</label>'
                    .'<textarea class="form-control" name="textarea['.$i.']['.$j.']"></textarea>';
            echo "</div><br>";
           }
        }
        else if($alan["alan_turu"]=="selectmenu"){
            echo '<div class="col-md-11">';
            $secenekler = $fmg->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            
            if($secenekler){
                if($alanveriler){
                    echo '<label class="form-label">'.$alan["alan_aciklama"].'</label><br>  '
                    . '<select class="form-select" name="selectmenu['.$i.']['.$j.']">'; 
                $k = 0;    
                foreach($secenekler as $secenek){
                if($secenek["aciklama"] == $alanveriler["veri"]){
                echo '<option value="'.$secenek['aciklama'].'" selected>'.$secenek["aciklama"].'</option>';  
                }else {    
                echo '<option value="'.$secenek['aciklama'].'">'.$secenek["aciklama"].'</option>';
                }
                $k++;
                }
                echo '</select>';
                }else {
                    echo '<label class="form-label">'.$alan["alan_aciklama"].'(Seçim yapılmamış )</label><br>  '
                    . '<select class="form-select" name="selectmenu['.$i.']['.$j.']">'; 
                $k = 0;    
                foreach($secenekler as $secenek){
                    echo '<option value="'.$secenek['aciklama'].'">'.$secenek["aciklama"].'</option>';
                    $k++;
                }
                echo '</select>';
                }
        
            echo "</div><br>";
            array_push($fmg->alan_idler[$i]["selectmenu"],$alan["alan_id"]);
            }else {
                echo hataMetni("Bu Alana Ait Seçenek bulunamadı");
            }
        }else if($alan["alan_turu"] == "date"){
            if($alanveriler){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' : </label>'
                    .'<input value="'.$alanveriler["veri"].'" class="form-control" type="date" name="date['.$i.']['.$j.']" value=""/><br><br>';
            echo "</div>";
            }else {
                echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' :(Veri bulunamadı) </label>'
                    .'<input value="" class="form-control" type="date" name="date['.$i.']['.$j.']" value=""/><br><br>';
            echo "</div>";
            }
            
        }else if($alan["alan_turu"] == "datetime"){
            if($alanveriler){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' : </label>'
                    .'<input value="'.$alanveriler["veri"].'" class="form-control" type="datetime-local" name="datetime['.$i.']['.$j.']" value=""/><br><br>';
            echo "</div>";
            }else {
                echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].' : (Veri bulunamadı)</label>'
                    .'<input value="" class="form-control" type="datetime-local" name="datetime['.$i.']['.$j.']" value=""/><br><br>';
            echo "</div>";
            }
                   
        }else if($alan["alan_turu"] == "veritablotext"){
            
            $niteliksayi = $fmg->tabloUstNitelikSay($baglan,$alan["alan_id"]);
            $nitelik = $fmg->tabloUstNitelikGetir($baglan,$alan["alan_id"]);
            
            $ustsutunidler_arr = array();
            if($nitelik){
            $niteliktablo = array();    
            
            foreach($nitelik as $nitelikal){
                $idx = (int) $nitelikal["tablodaki_sirasi"];
                $niteliktablo[$idx] = $nitelikal["aciklama"];
                $ustsutunidler_arr[$idx] = $nitelikal["nitelik_id"];
            }
            }
            
            
            
            
            
            $yanniteliksayi = $fmg->tabloYanNitelikSay($baglan,$alan["alan_id"]);
            $yannitelik =  $fmg->tabloYanNitelikGetir($baglan,$alan["alan_id"]);
           
            $yansutunidler_arr = array();
            if($yannitelik){
             $yanniteliktablo = array();    
             foreach($yannitelik as $yannitelikal){
                $idx = (int) $yannitelikal["tablodaki_sirasi"];
                $yanniteliktablo[$idx] = $yannitelikal["aciklama"];
                $yansutunidler_arr[$idx] = $yannitelikal["nitelik_id"];
            }
            }
            
           
            echo '<div class="col-md-11">';
            echo '<a>'.$alan["alan_aciklama"].'</a>  <br><br>';
            echo '<table class="table table-striped table-hover table-bordered">';
            
            if($niteliksayi>0 && $yanniteliksayi>0){
            array_push($fmg->ustsutunidler[$i]["txt1"],$ustsutunidler_arr);
            array_push($fmg->yansutunidler[$i]["txt1"],$yansutunidler_arr);
            array_push($fmg->alan_idler[$i]["txt1"],$alan["alan_id"]);
            echo "<thead><th></th>";
            for ($k=0;$k<count($niteliktablo);$k++){
            if(!empty($niteliktablo[$k])){    
            echo "<th scope='col'>".$niteliktablo[$k]."</th>";
            }else {
                echo "<th></th>";
            }
            }
            echo "</thead>";
             echo "</tr><tbody id ='satirlar".($i+1)."_".($j+1)."'>";
            
            for ($m=0;$m<count($yanniteliktablo);$m++){
            echo "<tr><th scope='row'>".$yanniteliktablo[$m]."</th>";
            for($n=0;$n<count($niteliktablo);$n++){
                $icerik = $fmg->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$ustsutunidler_arr[$n],$yansutunidler_arr[$m]);
             if($icerik){
                if(!empty($icerik["icerik"])){
                echo  "<td id='tabloveri".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                        . "<input type='text' value='".$icerik["icerik"]."' name='tabloveritxt[".$i."][".$j."][".$m."][".$n."]' hidden/>"
                   . "<a type='button' class='tablogiris' id='tablogiris".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>".$icerik["icerik"]."</a></td>";
                }else {
                    echo  "<td id='tabloveri".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                    . "<input type='text' value='' name='tabloveritxt[".$i."][".$j."][".$m."][".$n."]' hidden/>"
               . "<a type='button' class='tablogiris' id='tablogiris".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>--</a></td>";
                }
           }else {
                echo  "<td id='tabloveri".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                . "<input type='text' value='' name='tabloveritxt[".$i."][".$j."][".$m."][".$n."]' hidden/>"
           . "<a type='button' class='tablogiris' id='tablogiris".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>--</a></td>";
             }
                
            }
            echo "</tr>";  
            echo "</tbody>";
            }
            }else if($niteliksayi>0){
                 $satirsayisi = $fmg->tabloSatirSayisi($baglan,$alan["alan_id"],$form_id);
                 $satirsayisi = $satirsayisi[0];
                
               array_push($fmg->ustsutunidler[$i]["txt2"],$ustsutunidler_arr);
               array_push($fmg->alan_idler[$i]["txt2"],$alan["alan_id"]);
               echo "<thead>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                
                echo "<tbody id=satirlar2".($i+1)."_".($j+1).">";
                for($m=0;$m<$satirsayisi;$m++){
                echo "<tr>";    
                for($n=0;$n<count($niteliktablo);$n++){
                $x = -($m+1);
                $icerik = $fmg->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$ustsutunidler_arr[$n],$x);
                if($icerik){
                if(!empty($icerik["icerik"])){    
                echo  "<td id='tabloveri1".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                        . "<input type='text' value='".$icerik["icerik"]."' name='tabloveritxt2[".$i."][".$j."][".$m."][".$n."]' hidden/>"
                        . "<a class='tablogiris2' id='tablogiris2".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                   . "".$icerik["icerik"]."</a></td>";
                }else {
                    echo  "<td id='tabloveri1".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                    . "<input type='text' value='' name='tabloveritxt2[".$i."][".$j."][".$m."][".$n."]' hidden/>"
                    . "<a class='tablogiris2' id='tablogiris2".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
               . "--</a></td>";  
                }
                }else {
                    echo  "<td id='tabloveri1".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                    . "<input type='text' value='' name='tabloveritxt2[".$i."][".$j."][".$m."][".$n."]' hidden/>"
                    . "<a class='tablogiris2' id='tablogiris2".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
               . "--</a></td>";
                }    
                
                }
                echo "</tr>";
                }
               
                echo "</tbody>";               
                
            }
            
           
            
            echo '</table></div>';
            
     
        }else if($alan["alan_turu"] == "veritablocheck"){
            
            $niteliksayi = $fmg->tabloUstNitelikSay($baglan,$alan["alan_id"]);
            $nitelik = $fmg->tabloUstNitelikGetir($baglan,$alan["alan_id"]);
            
            $ustsutunidler_arr = array();
            if($nitelik){
            $niteliktablo = array();    
            
            foreach($nitelik as $nitelikal){
                $idx = (int) $nitelikal["tablodaki_sirasi"];
                $niteliktablo[$idx] = $nitelikal["aciklama"];
                $ustsutunidler_arr[$idx] = $nitelikal["nitelik_id"];
            }
            }
            
            
            
            
            $yanniteliksayi = $fmg->tabloYanNitelikSay($baglan,$alan["alan_id"]);
            $yannitelik =  $fmg->tabloYanNitelikGetir($baglan,$alan["alan_id"]);
           
            $yansutunidler_arr = array();
            if($yannitelik){
             $yanniteliktablo = array();    
             foreach($yannitelik as $yannitelikal){
                $idx = (int) $yannitelikal["tablodaki_sirasi"];
                $yanniteliktablo[$idx] = $yannitelikal["aciklama"];
                $yansutunidler_arr[$idx] = $yannitelikal["nitelik_id"];
            }
            }
            
           
            echo '<div class="col-md-11">';
            echo '<a>'.$alan["alan_aciklama"].'</a> : <br><br>';
            echo '<table class="table table-striped table-hover table-bordered">';
            
            if($niteliksayi>0 && $yanniteliksayi>0){
              array_push($fmg->ustsutunidler[$i]["ch1"],$ustsutunidler_arr);
              array_push($fmg->yansutunidler[$i]["ch1"],$yansutunidler_arr);
              array_push($fmg->alan_idler[$i]["ch1"],$alan["alan_id"]);
                echo "<thead><th></th>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                 echo "</tr><tbody id ='satirlar".($i+1)."_".($j+1)."'>";
             
               for ($m=0;$m<count($yanniteliktablo);$m++){
                
                echo "<tr><th scope='row'>".$yanniteliktablo[$m]."</th>";
                    for($n=0;$n<count($niteliktablo);$n++){
                    $icerik = $fmg->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$ustsutunidler_arr[$n],$yansutunidler_arr[$m]);
                    if($icerik){
                    if($icerik["icerik"] == "pasif"){  
                     echo "<td id='tabloverichck".$m."_".$n."'><input type='text' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]' value='pasif' hidden /><input type='checkbox' "
                       . "class='form-check-input' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]'"
                               ."id='tablovericheck' value='aktif'/></td>";
                    }else if($icerik["icerik"] == "aktif"){
                        echo "<td id='tabloverichck".$m."_".$n."'><input type='text' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]' value='pasif' hidden /><input type='checkbox' "
                        . "class='form-check-input' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]'"
                                ."id='tablovericheck' value='aktif' checked/></td>";  
                    }else {
                        echo "<td>NaN</td>";
                    }
                    }else {
                        echo "<td>NaN</td>";
                    }
                    }
              }
              
            echo "</tbody>";
          
              
             }else if($niteliksayi>0){
              array_push($fmg->ustsutunidler[$i]["ch2"],$ustsutunidler_arr);
              array_push($fmg->alan_idler[$i]["ch2"],$alan["alan_id"]);

              $satirsayisi =  $fmg->tabloSatirSayisi($baglan,$alan["alan_id"],$form_id);
              $satirsayisi = $satirsayisi[0];
               echo "<thead>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                
                echo "<tbody id='satirlar2".($i+1)."_".($j+1)."'>";
                for($m=0;$m<$satirsayisi;$m++){
                echo "<tr>";
                for($n=0;$n<count($niteliktablo);$n++){
                    $x = -($m+1);
                    $icerik =  $fmg->tabloIcerikGetir($baglan,$form_id,$alan["alan_id"],$ustsutunidler_arr[$n],$x);
                    if($icerik){     
                    if($icerik["icerik"] == "aktif"){
                    echo "<td id='tabloverichck".$i."_0'><input type='text' name='tablovericheck2[".$i."][".$j."][0][".$n."]' value='pasif' hidden /><input type='checkbox' "
                        . "class='form-check-input' name='tablovericheck2[".$i."][".$j."][0][".$n."]'"
                                ."id='tablovericheck' value='aktif' /></td>";
                    }else if($icerik["icerik"] == "pasif"){
                        echo "<td id='tabloverichck".$i."_0'><input type='text' name='tablovericheck2[".$i."][".$j."][0][".$n."]' value='pasif' hidden /><input type='checkbox' "
                        . "class='form-check-input' name='tablovericheck2[".$i."][".$j."][0][".$n."]'"
                                ."id='tablovericheck' value='pasif'  checked/></td>";   
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
        
        
        $j++;
       }

    
   

    }else {
        echo hataMetni("Bu Forma Ait Alan Bulunamadı.!");
    }
    
    
    echo '</div></div></fieldset><br>';
    
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

 echo '<div class="row g-3">'
. '<div class="col-md-11"> <input class="btn btn-success" type="submit" value="Formu Güncelle" name="gonder" /></div></div>';
    echo '</form></div><br>';
}else {
    echo hataMetni("Bu Form İçin Form Bölgesi Bulunamadı.!");
}



}else {
    echo hataMetni("Form Bulunamadı.!");
}

}else {
    echo hataMetni("Form Bulunamadı.!");
}

if(isset($_POST["gonder"])){

    $tarih = new DateTime();
    $tarih = $tarih->format("Y-m-d H:i:s");
        
    $guncellenen_form_id = $form_id;
        //alanlari ekle
        
        if(isset($_POST["textbox"])){
            $fmg->duzAlanGuncelle($baglan,$_POST["textbox"],"textbox",$guncellenen_form_id,$i);
        }
        if(isset($_POST["textarea"])){
            $fmg->duzAlanGuncelle($baglan,$_POST["textarea"],"textarea",$guncellenen_form_id,$i);
        }
        
        if(isset($_POST["date"])){
            $fmg->duzAlanGuncelle($baglan,$_POST["date"],"date",$guncellenen_form_id,$i);
        }
        
        if(isset($_POST["datetime"])){
            $fmg->duzAlanGuncelle($baglan,$_POST["datetime"],"datetime",$guncellenen_form_id,$i);
        }

        if(isset($_POST["radio"])){
            $fmg->duzAlanGuncelle($baglan,$_POST["radio"],"radio",$guncellenen_form_id,$i);
        }

        if(isset($_POST["selectmenu"])){
            $fmg->duzAlanGuncelle($baglan,$_POST["selectmenu"],"selectmenu",$guncellenen_form_id,$i);
        }

        if(isset($_POST["checkbox"])){

            $fmg->checkGuncelle($baglan,$_POST["checkbox"],$_POST["gonderilecekidler"],$i,$guncellenen_form_id);
        }
       

        if(isset($_FILES["resimalani"])){
            $fmg->resimAlanlariGuncelle($baglan,$_FILES["resimalani"],$i,$guncellenen_form_id);
        }


     if(isset($_POST["tabloveritxt"])){
        $fmg->textTabloVeriGuncelle($baglan,$_POST["tabloveritxt"],$i,$guncellenen_form_id);
      }
       
    if(isset($_POST["tabloveritxt2"])){
        $fmg->textTablo2VeriGuncelle($baglan,$_POST["tabloveritxt2"],$i,$guncellenen_form_id);
    }
       
    
    if(isset($_POST["tablovericheck"])){
        $fmg->checkTabloVeriGuncelle($baglan,$_POST["tablovericheck"],$i,$guncellenen_form_id);
    }
        
    if(isset($_POST["tablovericheck2"])){ 
       $fmg->checkTablo2VeriGuncelle($baglan,$_POST["tablovericheck2"],$i,$guncellenen_form_id);
    }
       
   }
   
/*try { 
}catch(Exception $e){
        echo hataMetni("Hata oluştu -> Kodu : ".$e->getCode()."<br>".$e->getMessage()."<br>");
}*/  
    

include("view/footer.php");



/*
  echo '<input type="hidden" name="aktifidler['.$i.']['.$j.']['.$k.']" value="'.$aktif_id.'"  />';
                echo '<input type="hidden" name="gonderilecekidler['.$i.']['.$j.']['.$k.']" value="0" />';
*/

?>


<script>
 $(document).ready(function() {

    $('input[type=checkbox]').change(function() {

    var name = $(this).attr('name');
    name = name.replace("checkbox","");

    name = name.split(']');

    var i = name[0].replace("[","");
    var j = name[1].replace("[","");
    var k = name[2].replace("[","");

    var aktifid = $('input[name="aktifidler['+i+']['+j+']['+k+']"]').val();
    var gonderilecekid = $('input[name="gonderilecekidler['+i+']['+j+']['+k+']"]');

    if(aktifid>0){
    if(gonderilecekid.val() == "0") gonderilecekid.val(aktifid);
    else gonderilecekid.val("0");

    alert(i + " "+ j + " "+ k+ " "+aktifid);
    }

    });

 });           
            
</script>