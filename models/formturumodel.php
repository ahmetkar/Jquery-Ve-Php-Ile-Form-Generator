<?php
if(count(get_included_files()) ==1){
    http_response_code(404);
    include('../view/404.php');
    exit;
}
require_once "models.php";

class FormTuruModel extends Models {

public $last_tur_id;

function  __construct(){
    $this->last_tur_id = 0;
}

public function FormlariGetir($baglan){
    return $this->tablodanSatirlarGetir($baglan,"formturbilgileri","*","");
}



public function formturBilgileriGetir($baglan,$tur_id){
    return  $this->tablodanSatirGetir($baglan,"formturbilgileri","*","tur_id=".$tur_id."");
}




public function formBolgeleriGetir($baglan,$tur_id){
    return $this->tablodanSatirlarGetir($baglan,"formareabilgileri","*","ait_oldugu_form_turu_id=".$tur_id."");
}

public function formAlanlarGetir($baglan,$tur_id,$bolge_id){
    return $this->tablodanSatirlarGetir($baglan,"formalanbilgileri","*","aitoldugu_form_turu_id=".$tur_id." and ait_oldugu_bolge_id=".$bolge_id."");
}


public function formSayiGetir($baglan,$form_tur_id,$form_durum,$akademisyen_id = -1,$ekleyen_id = -1){

    $formsay = 0;

    if($akademisyen_id != -1){
    $formsay = $this->tabloSatirSay($baglan,"formbilgileri","*","form_durum = '".$form_durum."' 
    and form_turu_id=".$form_tur_id." and gonderilen_akademisyen_id=".$akademisyen_id."");
    }else if($ekleyen_id!=-1){
     $formsay =  $this->tabloSatirSay($baglan,"formbilgileri","*","form_durum = '".$form_durum."' and
     form_turu_id=".$form_tur_id." and ekleyen_id=".$ekleyen_id."");   
    }else {
    $formsay = $this->tabloSatirSay($baglan,"formbilgileri","*","form_durum = '".$form_durum."' and form_turu_id=".$form_tur_id.""); 
    }

    if($formsay == -1) $formsay = 0;
    
    return $formsay;
}




public function formturSil($baglan,$formturuid){
    $formbilgi = $baglan->query("Select resim_url from formturbilgileri where tur_id = ".$formturuid."")->fetch();
    if($formbilgi){
        $this->formResimSil($formbilgi["resim_url"]);

    }else {
        echo hataMetni("Forma ait bilgiler bulunamadığından dosyaları silinemedi.");
    }
    return $this->tablodanSil($baglan,"formturbilgileri",array("tur_id"=>$formturuid));
}

public function formResimSil($resim_file_path){
    if(file_exists($resim_file_path)){
		$sil = unlink($resim_file_path);
		if($sil){
			echo basariMetni("Forma ait resim dosyası silindi.");
		}else {
			echo hataMetni("Formun resim dosyası silinirken sorun oluştu");
		}
	}else {
		echo hataMetni("Forma ait resim bulunamadığı için resim dosyası silinemedi.");
	}
}


public function secenekEkle($baglan,$secenek,$last_alan_id){
                          
    if(!empty($secenek)){
        $secenek = htmlspecialchars(ozelkarakterSil($secenek));
       
        $secenekekleme = $this->tabloyaEkle($baglan,"formsecenekbilgileri",array("ait_oldugu_alan_id","aciklama"),array($last_alan_id,$secenek));
        if($secenekekleme){
            echo basariMetni("Seçenek Ekleme Başarılı..");   
        }else {
            echo hataMetni("Seçeneği Ekleme Başarısız.!");
        }  
   }
 

}


public function veritabloUstSutunlarEkle($baglan,$sutunlar,$last_alan_id){
    $r = 0;
    $len = count($sutunlar);
    foreach($sutunlar as $sutunicerik){
        $sutunicerik = htmlspecialchars(ozelkarakterSil($sutunicerik));
        
        $sutunekleme = $this->tabloyaEkle($baglan,"formtablosutunlar",array("aciklama","ait_oldugu_alan_id","tablodaki_sirasi"),
        array($sutunicerik,$last_alan_id,$r));

        if($sutunekleme){
            $r++;
            echo basariMetni($r." . Üst Sütunu Ekleme Başarılı..");
        }else {
            echo hataMetni($r." Üst Sütunu Ekleme Başarısız.!");
        }
    
  
   }
   return $r == $len;
}


public function veritabloYanSutunlarEkle($baglan,$yansutunlar,$last_alan_id){

    $r = 0;
    $len = count($yansutunlar);
    foreach($yansutunlar as $yansutunicerik){
        if(!empty($yansutunicerik)){
        $yansutunicerik = htmlspecialchars(ozelkarakterSil($yansutunicerik));    
    
        $yansutunekleme = $this->tabloyaEkle($baglan,"formtablosatirlar",array("aciklama","ait_oldugu_alan_id","tablodaki_sirasi"),
        array($yansutunicerik,$last_alan_id,$r));

        if($yansutunekleme){
            $r++;
            echo basariMetni($r." . Satır Ekleme Başarılı..");
        }else {
            echo hataMetni($r." . Satır Ekleme Başarısız.!");
        }
    }
  
   }
   return $r == $len;
}


public function alanEkle($baglan,$aform_id,$bolge_id,$alanaciklama,$alan_turu){
    $alanaciklama = htmlspecialchars(ozelkarakterSil($alanaciklama));
 
    $alanekleme =  $this->tabloyaEkle($baglan,"formalanbilgileri",array("aitoldugu_form_turu_id","alan_turu","ait_oldugu_bolge_id","alan_aciklama"),
    array($aform_id,$alan_turu,$bolge_id,$alanaciklama));

    if($alanekleme){
    $last_alan_id =  $baglan->lastInsertId(); 
    if($alan_turu === "selectmenu" || $alan_turu === "checkbox" || $alan_turu === "radio" || $alan_turu === "veritablotext" || $alan_turu === "veritablocheck"){    
    return $last_alan_id;
    }else {
    return 1;
    }       
    }else {
    return 0;
    }   
}


public function duzAlanEkle($baglan,$alan,$alan_turu,$bolgeid,$i){
    if (isset($alan)) {
    if(isset($alan) && !empty($alan)){
        $alanEkle = $this->alanEkle($baglan,$this->last_tur_id,$bolgeid, $alan, $alan_turu);
        if($alanEkle == 0 ){
        echo hataMetni($i." form bölgesindeki ".$alan_turu." Ekleme Başarısız Oldu.!");    
        return false;
        }else {
        echo basariMetni($i." form bölgesindeki ".$alan_turu." Başarıyla Eklendi..");
        return true;
        }
        }
    }
}




public function secenekliAlanEkle($baglan,$alan,$alan_turu,$secenekler,$bolgeid,$i){
    if(isset($alan)){
            $last_alan_id = $this->alanEkle($baglan,$this->last_tur_id,$bolgeid, $alan, $alan_turu);
            if($last_alan_id === 0){
                echo hataMetni($i.". Bölgedeki ".$alan_turu." Eklenirken Sorun Oluştu.!");
                return false;
            }else {
                if(isset($secenekler)){
                    foreach($secenekler as $secenek){
                    $this->secenekEkle($baglan,$secenek,$last_alan_id);  
                    }
                    echo basariMetni($i.". Bölgedeki ".$alan_turu."  Başarıyla Eklendi..");
                    return true;
                }
            }
    }
}  

public function formTuruEkle($baglan,$form_baslik,$ekleyen_id,$form_resimurl){
    

    $turekleme = $this->tabloyaEkle($baglan,"formturbilgileri",array("baslik","ekleyen_id","resim_url"),
    array($form_baslik,$ekleyen_id,$form_resimurl));
    $this->last_tur_id = $baglan->lastInsertId(); 
    return $turekleme;
}



public function formResimEkle($formresim,$default = ""){
    $resimboyutu_sinir = 1024*1024*2;
    if($formresim["error"] != 0){
        echo hataMetni("Resim yüklenirken hata oluştu.");
        $form_resimurl = $default;
        return $form_resimurl;
    }else {
        if($formresim["size"] > $resimboyutu_sinir){
            echo hataMetni("Resmin boyutu 2 MB 'den büyük olamaz");
            $form_resimurl = $default;
            return $form_resimurl;
        }else {
            $tip = $formresim["type"];
            $resimadi = $formresim["name"];

            $uzantisi = explode(".",$resimadi);
            $uzantisi = $uzantisi[count($uzantisi)-1]; 
            // dosyanın uzantısını alıyor birden fazla nokta olma ihtimalinden dolayı son noktadan sonrakini alıyor.
            $form_resimurl = FORM_IMAGES_PATH."formresim-".time().".".$uzantisi;

            if($tip == "image/jpeg" || $tip == "image/png" || $tip == "image/jpg"){
                if(move_uploaded_file($formresim["tmp_name"],$form_resimurl)){
                    echo basariMetni("Resim başarıyla yüklendi");
                    return $form_resimurl;
                }else {
                    if(!empty($default)) echo hataMetni("Resim yüklemediniz. Eskisiyle aynı kalacak.");
                    else echo hataMetni("Resim yüklenirken sorun oluştu..");
                    $form_resimurl = $default;
                    return $form_resimurl;
                }
            }else {
                echo hataMetni("Yüklediğiniz resmin uzantısı png veya jpg olmalıdır.");
                $form_resimurl = $default;
                return $form_resimurl;
            }
        }
    }
}




public function formAlanlariEkle($baglan,$bolgeid,$veriler,$i){

    $duzalanlar = array("textbox","resimalani","textarea","date","datetime");

    $k = 0;
    $e = 0;
    if($veriler["alanturleri"]!=null && $veriler["alanlar"]!=null){
        if(isset($veriler["alanlar"][$i])){
            foreach($veriler["alanturleri"][$i] as $alantur){
                if(in_array($alantur,$duzalanlar)){
                    if($this->duzAlanEkle($baglan,$veriler["alanlar"][$i][$k],$alantur,$bolgeid,$i)) $e++;
                }else if($alantur == "radio"){
                    if(isset($veriler["radiosecenekler"][$i][$k])){
                        if($this->secenekliAlanEkle($baglan,$veriler["alanlar"][$i][$k],$alantur,$veriler["radiosecenekler"][$i][$k],$bolgeid,$i)) $e++;
                    }
                }else if($alantur == "checkbox"){
                    if(isset($veriler["checkboxsecenekler"][$i][$k])){
                        if($this->secenekliAlanEkle($baglan,$veriler["alanlar"][$i][$k],$alantur,$veriler["checkboxsecenekler"][$i][$k],$bolgeid,$i)) $e++;
                    }
                }else if($alantur == "selectmenu"){
                    if(isset($veriler["selectsecenekler"][$i][$k])){
                        if($this->secenekliAlanEkle($baglan,$veriler["alanlar"][$i][$k],$alantur,$veriler["selectsecenekler"][$i][$k],$bolgeid,$i)) $e++;
                    }
                }
                else if($alantur == "veritablo"){
                    if(isset($veriler["yansutunlar"][$i]) && isset($veriler["sutunlar"][$i])){
                      
                        if($this->tabloEkle($baglan,$veriler["alanlar"][$i][$k],$veriler["tablotipleri"][$i][$k],$veriler["sutunlar"][$i][$k],$veriler["yansutunlar"][$i][$k],$bolgeid,$i)) $e++;
                    }else if(isset($veriler["sutunlar"][$i])) {
                       
                        if($this->tabloEkle($baglan,$veriler["alanlar"][$i][$k],$veriler["tablotipleri"][$i][$k],$veriler["sutunlar"][$i][$k],null,$bolgeid,$i)) $e++;
                    }else {
                        echo hataMetni("Sütunlar ve Yansütunlar girilmedi.");
                        return false;
                    }
                }
                $k++;
            }
        echo basariMetni($k." kadar alan eklendi.");
        return $k==$e;   
        }else {
            echo hataMetni("Alanlar boş olduğu için eklemeler başarısız oldu..");
        }
    }else {
        echo hataMetni("Alanlar boş olduğu için eklemeler başarısız oldu.");
    }
    return false;
}


public function mezuniyetFormBolgelerVeAlanlarEkle($baglan,$bolge_basliklar,$veriler){
               
               $be = 0;
               for($i=0;$i<count($bolge_basliklar);$i++){
             
                   $bolgeekleme = $this->tabloyaEkle($baglan,"formareabilgileri",array("bolge_baslik","formdaki_sirasi","ait_oldugu_form_turu_id"),
                   array($bolge_basliklar[$i],$i,$this->last_tur_id));

                   if($bolgeekleme){      
                       $bolgeid = $baglan->lastInsertId();
                       if($this->formAlanlariEkle($baglan,$bolgeid,$veriler,$i)) $be++;
                    }else {
                        echo hataMetni($i." Bölgeyi Ekleme Başarısız Oldu.!");
                        return false;
                    }
                }
                echo basariMetni($be." kadar bölgenin alanları başarıyla eklendi.");
                return $be == count($bolge_basliklar);
}








public function tabloEkle($baglan,$veritabloaciklama,$veritipi,$sutun,$yansutun,$bolgeid,$i){
        if (isset($veritipi) && isset($veritabloaciklama)) {
                    $last_alan_id = 0;    
                    if($veritipi == "text"){    
                    $last_alan_id = $this->alanEkle($baglan,$this->last_tur_id,$bolgeid, $veritabloaciklama, "veritablotext");
                    }else if($veritipi == "check") {
                    $last_alan_id = $this->alanEkle($baglan,$this->last_tur_id,$bolgeid, $veritabloaciklama, "veritablocheck");
                    }
                    if($last_alan_id === 0){
                        echo hataMetni($i." . form bölgesindeki Tablo Eklenirken Sorun Oluştu.!");
                        return false;
                    }else {
                        $yansutunekle = false;
                        $sutunekle = false;
                        echo basariMetni($i." . form bölgesindeki Tablo Başarıyla Eklendi.."); 
                        if(isset($sutun)){
                            $sutunekle = $this->veritabloUstSutunlarEkle($baglan,$sutun,$last_alan_id);
                        }
                        if(isset($yansutun) && $yansutun!=null){
                            $yansutunekle = $this->veritabloYanSutunlarEkle($baglan, $yansutun, $last_alan_id);
                        }else {
                            $yansutunekle = true;
                        }
                        return $sutunekle && $yansutunekle;
                    }
            }
}


public function formTuruGuncelle($baglan,$form_baslik,$resim_url,$form_turu_id){
    return $this->tablodanGuncelle($baglan,array("baslik"=>$form_baslik,"resim_url"=>$resim_url),"formturbilgileri",array("tur_id"=>$form_turu_id));
}



public function bolgeveAlanlariGuncelle($baglan,$bolgebasliklar,$aciklamalar,$idler){
    $durum = false;

    $b = 0;
    $bb = 0;
    foreach($bolgebasliklar as $bolgebaslik){ 
    $bolgebaslik = htmlspecialchars(ozelkarakterSil($bolgebaslik));       
    if($this->tablodanGuncelle($baglan,array("bolge_baslik"=>$bolgebaslik),"formareabilgileri",array("bolge_id"=>$idler["bolgeidler"][$b]))){
        $bb++;
    }

    if(isset($aciklamalar["alanaciklamalar"][$b])){
        $a = 0;
        $ba = 0;
        foreach($aciklamalar["alanaciklamalar"][$b] as $alanaciklama){
            $alanaciklama = htmlspecialchars(ozelkarakterSil($alanaciklama));
            if($this->tablodanGuncelle($baglan,array("alan_aciklama"=>$alanaciklama),"formalanbilgileri",array("alan_id"=>$idler["alanidler"][$b][$a]))){
                $ba++;
            }

                if(isset($aciklamalar["secenekaciklamalar"][$b][$a])){
                    $s = 0;
                    $bs = 0;
                    foreach($aciklamalar["secenekaciklamalar"][$b][$a] as $secenekaciklama){    
                    $secenekaciklama = htmlspecialchars(ozelkarakterSil($secenekaciklama));
                    if($this->tablodanGuncelle($baglan,array("aciklama"=>$secenekaciklama),"formsecenekbilgileri",
                    array("secenek_id"=>$idler["secenekidler"][$b][$a][$s]))){
                        $bs++;
                    }
                    $s++;
                    }    
                    echo basariMetni($a." alanı için ".$bs." kadar seçenek güncellendi");
                    $durum = $durum || ($s == $bs);
                }
            
            
                if(isset($aciklamalar["nitelikaciklamalar"][$b][$a])){
                        $n = 0;
                        $bn=0;
                        foreach($aciklamalar["nitelikaciklamalar"][$b][$a] as $nitelikaciklama){
                            $nitelikaciklama = htmlspecialchars(ozelkarakterSil($nitelikaciklama));
                            if($this->tablodanGuncelle($baglan,array("aciklama"=>$nitelikaciklama),"formtablosutunlar",
                            array("nitelik_id"=>$idler["nitelikidler"][$b][$a][$n]))){
                                $bn++;
                            }
                            $n++;
                        }    
                        echo basariMetni($a." alanı için ".$bn." kadar nitelik güncellendi");
                        $durum = $durum || ($n == $bn);
                }
            
              
                if(isset($aciklamalar["yannitelikaciklamalar"][$b][$a])){
                    $yn = 0;
                    $byn = 0;
                    foreach($aciklamalar["yannitelikaciklamalar"][$b][$a] as $yannitelikaciklama){
                            $yannitelikaciklama = htmlspecialchars(ozelkarakterSil($yannitelikaciklama));
                            if($this->tablodanGuncelle($baglan,array("aciklama"=>$yannitelikaciklama),"formtablosatirlar",
                            array("nitelik_id"=>$idler["yannitelikidler"][$b][$a][$yn]))){
                                $byn++;
                            }
                            $yn++;
                    }
                    echo basariMetni($a." alanı için ".$byn." kadar yannitelik güncellendi");
                    $durum = $durum || ($yn == $byn);
                }
            
        $a++;    
            
        }
        
    }
    echo basariMetni($b." bölgesi için ".$bb." kadar başlık güncellendi.");
    $b++;    
    }
    echo basariMetni($bb." kadar bölge güncellendi.");
    $durum = $durum && ($b == $bb) && ($a == $ba);
    return $durum;
}









}





?>