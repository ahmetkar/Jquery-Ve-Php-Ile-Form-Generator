   
<?php

//Öğrenci için form doldurup gönderme sayfası


include("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");
if(!isset($_GET["form_turu_id"])){
    header("Location:index.php");
}

include ("view/sidebar.php");

require_once "models/formmodel.php";
require_once "models/kullanicimodel.php";

?>
   <head>
        <script src="js/islemler.js"></script>
        <script src="js/formislemleri.js"></script>
        <script src="js/formgenislet.js"></script>
        <link href="css/table.css" rel="stylesheet">
        
    </head>
<?php

$k_id = $_SESSION["kid"];

$form_turu_id = htmlspecialchars($_GET["form_turu_id"]);

$klview = new KullaniciModel();
$fm = new FormModel();

$i = 0;

try {

$form =  $fm->formTurBilgileri($baglan,$form_turu_id);

if($form){

$bolgeler = $fm->bolgeBilgileri($baglan,$form_turu_id);

if($bolgeler){
 
echo "<div id='baslik'>";
echo '<h2>'.$form["baslik"].'</h2><hr><br>';
$kullanici = $klview->kullaniciBilgileri($baglan, $k_id);
echo $kullanici["adsoyad"]." olarak formu gönderiyorsunuz.</div><br>";


echo "<div id='formbolgesi'>";
echo "<form action=' ' method='post' enctype='multipart/form-data'>";

echo "Bu form ; <br>";



$akademisyenler = $klview->akademisyenleriDirekGetir($baglan);
echo '<div class="col md-6">
<label>Hangi akademisyen için gönderilecek :</label>
</div>
<div class="col md-6">
<select class="form-select" name="kime">
';
foreach($akademisyenler as $akademisyen){
    
echo '<option value="'.$akademisyen["kullanici_id"].'">'.$akademisyen["adsoyad"].'</option>';
}
echo '</select></div>';

echo "</div><br>";




foreach($bolgeler as $bolge){
    
    echo '<fieldset class="formbolgesi" id="formbolgesi'.$i.'" name="formbolgesi">'
                        .'<legend>'.$bolge["bolge_baslik"].'</legend><div id="bolgeicerik"><div class="row g-3">';
    
    $alanlar = $fm->alanBilgileri($baglan,$form_turu_id,$bolge["bolge_id"]);
    
    if($alanlar){
     $fm->ustsutunidler[$i]["ch1"] = array();
     $fm->yansutunidler[$i]["ch1"] = array();
     $fm->ustsutunidler[$i]["txt1"] = array();
     $fm->yansutunidler[$i]["txt1"] = array();
     $fm->alan_idler[$i]["ch1"] = array();
     $fm->alan_idler[$i]["txt1"] = array();
            
     $fm->ustsutunidler[$i]["ch2"] = array();
     $fm->alan_idler[$i]["ch2"] = array();
     $fm->ustsutunidler[$i]["txt2"] = array();
     $fm->alan_idler[$i]["txt2"] = array();
            
     
     $j = 0;
       foreach($alanlar as $alan1){
       if($alan1["alan_turu"] != "veritablotext" || $alan1["alan_turu"] != "veritablocheck"){    
       $fm->alan_idler[$i][$alan1["alan_turu"]] = array();
       }
       }
       foreach($alanlar as $alan){
              
        if($alan){
            array_push($fm->alan_idler[$i][$alan["alan_turu"]],$alan["alan_id"]);
        }
         
        if($alan["alan_turu"] == "textbox"){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>'
                    .'<input class="form-control" type="text" name="textbox['.$i.']['.$j.']" />';
            echo "</div><br>";
        }else if($alan["alan_turu"] == "resimalani"){
            echo "<div class='col-md-11'>";
            echo '<label class="form-label">'.$alan["alan_aciklama"].' :   </label>';
            echo "<input class='form-control' type='file' name='resimalani[".$i."][".$j."]' ></input>";
            echo "</div>";

        }else if($alan["alan_turu"]=="radio"){
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'</label><br>';
            $secenekler = $fm->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            echo "<div class='form-check'>";
            foreach($secenekler as $radiosec){
            echo '<input class="form-check-input" type="radio" value="'.$radiosec["aciklama"].'" name="radio['.$i.']['.$j.']" >'
                    . ' <label class="form-check-label">'.$radiosec["aciklama"]."</label><br>";
            }
            echo "</div></div><br>";
        }
        else if($alan["alan_turu"]=="checkbox"){
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'</label><br>';
            $secenekler = $fm->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            $k = 0;
            echo "<div class='form-check'>";
            foreach($secenekler as $checksec){
            echo '<input class="form-check-input" type="checkbox" value="'.$checksec["aciklama"].'" name="checkbox['.$i.']['.$j.']['.$k.']" >'
                    . '<label class="form-check-label"> '.$checksec["aciklama"]."</label><br>";
            $k++;
            }
            echo "</div></div><br>";
          
        }
        else if($alan["alan_turu"]=="textarea"){
            echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>'
                    .'<textarea class="form-control" name="textarea['.$i.']['.$j.']"></textarea>';
            echo "</div><br>";
        }
        else if($alan["alan_turu"]=="selectmenu"){
             echo '<div class="col-md-11">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'</label><br>  '
                    . '<select class="form-select" name="select['.$i.']['.$j.']">';
            
            
            $secenekler = $fm->alanSeceneklerGetir($baglan,$alan["alan_id"]);
            
            if($secenekler){
            $k = 0;    
            foreach($secenekler as $secenek){
                
            echo '<option value="'.$secenek['aciklama'].'">'.$secenek["aciklama"].'</option>';
              
            $k++;
            }
          
            }
            
            echo '</select></div><br>';
        }else if($alan["alan_turu"] == "date"){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>'
                    .'<input class="form-control" type="date" name="date['.$i.']['.$j.']" value=""/><br><br>';
            echo "</div>";
            
        }else if($alan["alan_turu"] == "datetime"){
            echo '<div class="col-md-6">';
            echo '<label class="form-label">'.$alan["alan_aciklama"].'  </label>'
                    .'<input class="form-control" type="datetime-local" name="datetime['.$i.']['.$j.']" value=""/><br><br>';
            echo "</div>";
                   
        }else if($alan["alan_turu"] == "veritablotext"){
            
            $niteliksayi = $fm->tabloUstNitelikSay($baglan,$alan["alan_id"]);
            $nitelik = $fm->tabloUstNitelikGetir($baglan,$alan["alan_id"]);
            
            $ustsutunidler_arr = array();
            if($nitelik){
            $niteliktablo = array();    
            
            foreach($nitelik as $nitelikal){
                $idx = (int) $nitelikal["tablodaki_sirasi"];
                $niteliktablo[$idx] = $nitelikal["aciklama"];
                $ustsutunidler_arr[$idx] = $nitelikal["nitelik_id"];
            }
            }
            
        
            $yanniteliksayi = $fm->tabloYanNitelikSay($baglan,$alan["alan_id"]);
            $yannitelik =  $fm->tabloYanNitelikGetir($baglan,$alan["alan_id"]);
           
            $yansutunidler_arr = array();
            if($yannitelik){
             $yanniteliktablo = array();    
             foreach($yannitelik as $yannitelikal){
                $idx = (int) $yannitelikal["tablodaki_sirasi"];
                $yanniteliktablo[$idx] = $yannitelikal["aciklama"];
                $yansutunidler_arr[$idx] = $yannitelikal["nitelik_id"];
            }
            }
            
           
            echo '<div class="col-md-12">';
            echo '<a>'.$alan["alan_aciklama"].'</a>  <br><br>';
            echo '<table class="table table-striped table-hover table-bordered">';
            
            if($niteliksayi>0 && $yanniteliksayi>0){
            array_push($fm->ustsutunidler[$i]["txt1"],$ustsutunidler_arr);
            array_push($fm->yansutunidler[$i]["txt1"],$yansutunidler_arr);
            array_push($fm->alan_idler[$i]["txt1"],$alan["alan_id"]);
            echo "<thead><th></th>";
            $boslar = array();
            for ($k=0;$k<count($niteliktablo);$k++){
                if(empty($niteliktablo[$k])){
                    $boslar[$k] = true;
                    echo "<th></th>";
                }else {
                    $boslar[$k] = false;
                    echo "<th scope='col'>".$niteliktablo[$k]."</th>";
                } 
 
            }
            echo "</thead>";
             echo "</tr><tbody id ='satirlar".($i+1)."_".($j+1)."'>";
            
            for ($m=0;$m<count($yanniteliktablo);$m++){
            echo "<tr><th scope='row'>".$yanniteliktablo[$m]."</th>";
            for($n=0;$n<count($niteliktablo);$n++){
               echo  "<td id='tabloveri".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>"
                        ."<input type='text' value=' ' name='tabloveritxt[".$i."][".$j."][".$m."][".$n."]' hidden/>"
                        . "<a type='button' class='tablogiris' id='tablogiris".($i+1)."_".($j+1)."_".($m+1)."_".($n+1)."'>--</a>"
                   . "</td>";
    
            }
            echo "</tr>";  
            echo "</tbody>";
            }
            }else if($niteliksayi>0){
               array_push($fm->ustsutunidler[$i]["txt2"],$ustsutunidler_arr);
               array_push($fm->alan_idler[$i]["txt2"],$alan["alan_id"]);
               echo "<thead>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                
                echo "<tbody id=satirlar2".($i+1)."_".($j+1)."><tr>";
                for($n=0;$n<count($niteliktablo);$n++){
                echo  "<td id='tabloveri1".($i+1)."_".($j+1)."_".(1)."_".($n+1)."'>"
                        ."<input type='text' value=' ' name='tabloveritxt2[".$i."][".$j."][0][".$n."]' hidden/>"
                        . "<a class='tablogiris2' id='tablogiris2".($i+1)."_".($j+1)."_".(1)."_".($n+1)."'>--"
                   . "</a></td>";
                }
                echo "</tr>";
               
                echo "</tbody>";
                echo "<input type='button' value='Satır ekle' class='satirekle btn btn-dark' id='satirekle".($i+1)."_".($j+1)."_".$n."_0' />";
               
                
            }
            
            echo '</table></div>';
            
     
        }else if($alan["alan_turu"] == "veritablocheck"){
            
            $niteliksayi = $fm->tabloUstNitelikSay($baglan,$alan["alan_id"]);
            $nitelik = $fm->tabloUstNitelikGetir($baglan,$alan["alan_id"]);
            
            $ustsutunidler_arr = array();
            if($nitelik){
            $niteliktablo = array();    
            
            foreach($nitelik as $nitelikal){
                $idx = (int) $nitelikal["tablodaki_sirasi"];
                $niteliktablo[$idx] = $nitelikal["aciklama"];
                $ustsutunidler_arr[$idx] = $nitelikal["nitelik_id"];
            }
            }
            
            
            
            
            $yanniteliksayi = $fm->tabloYanNitelikSay($baglan,$alan["alan_id"]);
            $yannitelik =  $fm->tabloYanNitelikGetir($baglan,$alan["alan_id"]);
           
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
              array_push($fm->ustsutunidler[$i]["ch1"],$ustsutunidler_arr);
              array_push($fm->yansutunidler[$i]["ch1"],$yansutunidler_arr);
              array_push($fm->alan_idler[$i]["ch1"],$alan["alan_id"]);
              echo "<thead><th></th>";
                for ($k=0;$k<count($niteliktablo);$k++){    
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                 echo "</tr><tbody id ='satirlar".($i+1)."_".($j+1)."'>";
             
               for ($m=0;$m<count($yanniteliktablo);$m++){
                echo "<tr><th scope='row'>".$yanniteliktablo[$m]."</th>";
                    for($n=0;$n<count($niteliktablo);$n++){
                     echo "<td id='tabloverichck".$m."_".$n."'><input type='text' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]' value='pasif' hidden /><input type='checkbox' "
                       . "class='form-check-input' name='tablovericheck[".$i."][".$j."][".$m."][".$n."]'"
                               ."id='tablovericheck' value='aktif' /></td>";
         
                    }
              }
              
            echo "</tbody>";
          
              
             }else if($niteliksayi>0){
              array_push($fm->ustsutunidler[$i]["ch2"],$ustsutunidler_arr);
              array_push($fm->alan_idler[$i]["ch2"],$alan["alan_id"]);
               echo "<thead>";
                for ($k=0;$k<count($niteliktablo);$k++){
                echo "<th scope='col'>".$niteliktablo[$k]."</th>";  
                }
                echo "</thead>";
                
                echo "<tbody id='satirlar2".($i+1)."_".($j+1)."'><tr>";
                for($n=0;$n<count($niteliktablo);$n++){
                echo "<td id='tabloverichck".$i."_0'><input type='text' name='tablovericheck2[".$i."][".$j."][0][".$n."]' value='pasif' hidden /><input type='checkbox' "
                       . "class='form-check-input' name='tablovericheck2[".$i."][".$j."][0][".$n."]'"
                               ."id='tablovericheck' value='aktif' /></td>";
                }
                echo "</tr>";
                echo "</tbody>";
               echo "<input type='button' value='Satır ekle' class='satirekle btn btn-dark' id='satirekle".($i+1)."_".($j+1)."_".$n."_1' />";

                
                 
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

echo "<br><br>";

 echo '<div class="row g-3">'
. '<div class="col-md-11"> <input class="btn btn-success" type="submit" value="Formu gönder" name="gonder" /></div></div><br>';
    echo '</form></div>';
}else {
    echo hataMetni("Bu Form İçin Form Bölgesi Bulunamadı.!");
}


}else {
    echo hataMetni("Form Bulunamadı.!");
}

if(isset($_POST["gonder"])){
    if(isset($_POST["kime"])){
        $tarih = new DateTime();
        $tarih = $tarih->format("Y-m-d H:i:s");

        $ogretmen_id = htmlspecialchars($_POST["kime"]);
      
        $formekle = $fm->formEkle($baglan,$k_id,$tarih,$form_turu_id,$ogretmen_id);
        
        if($formekle){
        
        $eklenen_form_id = $baglan->lastInsertId();
        //alanlari ekle
        
    
        if(isset($_FILES["resimalani"])){
            $fm->resimAlanlariEkle($baglan,$_FILES["resimalani"],$i,$eklenen_form_id);
        }

        if(isset($_POST["checkbox"])){
            $fm->checkboxVeriEkle($baglan,$_POST["checkbox"],$i,$eklenen_form_id);    
        }

        if(isset($_POST["textbox"])){
        $fm->duzalanlarVeriEkle($baglan,$_POST["textbox"],"textbox",$eklenen_form_id,$i);
        }
        if(isset($_POST["radio"])){
        $fm->duzalanlarVeriEkle($baglan,$_POST["radio"],"radio",$eklenen_form_id,$i);
        }
        if(isset($_POST["textarea"])){
        $fm->duzalanlarVeriEkle($baglan,$_POST["textarea"],"textarea",$eklenen_form_id,$i);
        }
        if(isset($_POST["date"])){
            $fm->duzalanlarVeriEkle($baglan,$_POST["date"],"date",$eklenen_form_id,$i);
        }
        if(isset($_POST["datetime"])){
            $fm->duzalanlarVeriEkle($baglan,$_POST["datetime"],"datetime",$eklenen_form_id,$i);
        }

        if(isset($_POST["select"])){
            $fm->duzalanlarVeriEkle($baglan,$_POST["select"],"selectmenu",$eklenen_form_id,$i);
        }
        
        if(isset($_POST["tabloveritxt"])){
            $tabloveri = $_POST["tabloveritxt"];
            echo json_encode($tabloveri);
            $fm->textTabloVeriEkle($baglan,$i,$tabloveri,$eklenen_form_id);
        }
        
        if(isset($_POST["tabloveritxt2"])){
            $tabloveri2 = $_POST["tabloveritxt2"];
            echo json_encode($tabloveri2);
            $fm->textTablo2VeriEkle($baglan,$i,$tabloveri2,$eklenen_form_id);
        }
            
        if(isset($_POST["tablovericheck"])){
            $tabloverich = $_POST["tablovericheck"];
            $fm->checkTabloVeriEkle($baglan,$i,$tabloverich,$eklenen_form_id);
        }
            
        if(isset($_POST["tablovericheck2"])){
        $tabloverich2 = $_POST["tablovericheck2"]; 
        $fm->checkTablo2VeriEkle($baglan,$i,$tabloverich2,$eklenen_form_id);
        }
        
        }else {
                echo hataMetni("Form Gönderilirken Hata Oluştu.!");
        }
    }else {
        echo hataMetni("Bazı zorunlu alanlar boş bırakıldı.Form gönderilemedi.");
    }
    
    }

    
}catch(Exception $e){
        echo hataMetni("Hata Oluştu.! -> Kodu : ".$e->getCode()."<br>".$e->getMessage()."<br>");
}  
    

include("view/footer.php");






?>