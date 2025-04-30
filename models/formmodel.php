<?php
if(count(get_included_files()) ==1){
    http_response_code(404);
    include('../view/404.php');
    exit;
}
require_once 'models.php';

class FormModel extends Models {

public $sayaclar = array(array());
public $alan_idler = [];
public $ustsutunidler = [];
public $yansutunidler = [];

public $resim_urller = [];


public function formEkle($baglan,$k_id,$tarih,$form_turu_id,$ogretmen_id){
   
    $formekle = $this->tabloyaEkle($baglan,"formbilgileri",array("ekleyen_id","eklenme_tarihi","form_turu_id","gonderilen_akademisyen_id"),
            array($k_id,$tarih,$form_turu_id,$ogretmen_id));
    return $formekle;
}

public function veriEkle($baglan,$veri,$veri_turu,$form_id,$alan_id){
        if(!empty($veri)){ 
        $veri = htmlspecialchars(ozelkarakterSil($veri)); 

        $formekle = $this->tabloyaEkle($baglan,"formalangirdileri",array("veri","ait_oldugu_alan_id","veri_turu","ait_oldugu_form_id"),
            array($veri,$alan_id,$veri_turu,$form_id));
         if($formekle){
             echo basariMetni("Veri Ekleme Başarılı..");
         }else {
             echo hataMetni("Veri Ekleme Başarısız.!");
         }
     }else {
         echo hataMetni("Boş Alanlar Var.");
     }
     
}



public function tabloicerikEkle($baglan,$icerik,$icerikturu,$alan_id,$nitelik_id,$yannitelik_id,$form_id,$bidx,$aidx){
    $icerik = htmlspecialchars(ozelkarakterSil($icerik));
    $icerikekle = $this->tabloyaEkle($baglan,"formttablogirdiler",array("icerik","icerik_turu","ait_oldugu_alan_id","ait_oldugu_nitelik_id",
            "ait_oldugu_form_id","ait_oldugu_yannitelik_id"),array($icerik,$icerikturu,$alan_id,$nitelik_id,$form_id,$yannitelik_id));

    if($icerikekle){
    $this->sayaclar[$bidx][$aidx]++;
    }

}

public function duzalanlarVeriEkle($baglan,$post,$alan_turu,$eklenen_form_id,$bolge_sayisi){
    $alan = $post;
    for($n=0;$n<=$bolge_sayisi;$n++){ 
            if(isset($alan[$n])){
                $a = 0;
                foreach($alan[$n] as $alanicerik){
                    if(isset($this->alan_idler[$n][$alan_turu][$a])){
                    $this->veriEkle($baglan,$alanicerik,$alan_turu,$eklenen_form_id,$this->alan_idler[$n][$alan_turu][$a]);
                    }
                    $a++;
                }
            }
    } 
}   

public function checkboxVeriEkle($baglan,$checkbox,$i,$eklenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        if(isset($checkbox[$n])){
                $a = 0;
                foreach($checkbox[$n] as $checkalanlar){
                    foreach($checkalanlar as $checkicerik){
                    if(isset($this->alan_idler[$n]["checkbox"][$a])){      
                    $this->veriEkle($baglan,$checkicerik,"checkbox",$eklenen_form_id,$this->alan_idler[$n]["checkbox"][$a]);
                    }
                    }
                $a++;
                }
        }

    }
}

public function textTabloVeriEkle($baglan,$i,$tabloveri,$eklenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        $a = 0;
        if(isset($tabloveri[$n])){
        foreach($tabloveri[$n] as $tabloverialan){
            $this->sayaclar[$n][$a] = 0;
            $k = 0;
                foreach($tabloverialan as $tabloverisatir){
                    $s = 0;
                        foreach($tabloverisatir as $tabloverial){
                          if(isset($this->alan_idler[$n]["txt1"][$a])){    
                           $this->tabloicerikEkle($baglan, $tabloverial,"veritablotext", $this->alan_idler[$n]["txt1"][$a], 
                             $this->ustsutunidler[$n]["txt1"][$a][$s], $this->yansutunidler[$n]["txt1"][$a][$k],$eklenen_form_id,$n,$a);
                         }
                        $s++;
                        }
                        $k++;          
                }
                if($this->sayaclar[$n][$a]>0){
                    echo basariMetni($this->sayaclar[$n][$a]." Tablo Verisi Başarıyla Eklendi.");
                }else {
                    echo hataMetni("Tablo Verileri Eklenemedi.!");
                }
                
         $a++;   
        }
        }
}
}

public function textTablo2VeriEkle($baglan,$i,$tabloveri2,$eklenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        $a = 0;
        if(isset($tabloveri2[$n])){
        foreach($tabloveri2[$n] as $tabloverialan){
            $this->sayaclar[$n][$a] = 0;
            $k = 0;
                foreach($tabloverialan as $tabloverisatir){
                    $s = 0;
                        foreach($tabloverisatir as $tabloverial){
                            if(isset($this->alan_idler[$n]["txt2"][$a])){    
                           $this->tabloicerikEkle($baglan, $tabloverial,"veritablotext", $this->alan_idler[$n]["txt2"][$a], 
                             $this->ustsutunidler[$n]["txt2"][$a][$s], -($k+1),$eklenen_form_id,$n,$a);
                           }
                            $s++;
                        }
                        $k++;          
                }
                if($this->sayaclar[$n][$a]>0){
                    echo basariMetni($this->sayaclar[$n][$a]." Tablo Verisi Başarıyla Eklendi.");
                }else {
                    echo hataMetni("Tablo Verileri Eklenemedi.!");
                }
                
         $a++;   
        }
        }
}
}

public function checkTabloVeriEkle($baglan,$i,$tabloverich,$eklenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        $a = 0;
        if(isset($tabloverich[$n])){ 
             foreach($tabloverich[$n] as $tabloverialan){
                 $this->sayaclar[$n][$a] = 0;
                 $j = 0;
                     foreach($tabloverialan as $tabloverisatir){
                         $k = 0;
                             foreach($tabloverisatir as $tabloverial){
                              if(isset($this->alan_idler[$n]["ch1"][$a])){
                                 $this->tabloicerikEkle($baglan, $tabloverial,"veritablocheck", $this->alan_idler[$n]["ch1"][$a],
                                   $this->ustsutunidler[$n]["ch1"][$a][$k], $this->yansutunidler[$n]["ch1"][$a][$j],$eklenen_form_id,$n,$a);
                                 }
                                $k++; 
                             }  
                            $j++; 
                         }  
                         if($this->sayaclar[$n][$a]>0){
                             echo basariMetni($this->sayaclar[$n][$a]." Tablo Verisi Başarıyla Eklendi.");
                         }else {
                             echo hataMetni("Tablo Verileri Eklenemedi.!");
                         }
              $a++;   
             }
            }
           
     }
}

public function checkTablo2VeriEkle($baglan,$i,$tabloverich2,$eklenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        if(isset($tabloverich2[$n])){
            $a = 0;
             foreach($tabloverich2[$n] as $tabloverialan){
                 $this->sayaclar[$n][$a] = 0;
                 $j = 0;
                     foreach($tabloverialan as $tabloverisatir){
                         $k = 0;
                             foreach($tabloverisatir as $tabloverial){
                              if(isset($this->alan_idler[$n]["ch2"][$a])){
                                 tabloicerikEkle($baglan, $tabloverial,"veritablocheck", $this->alan_idler[$n]["ch2"][$a],
                                   $this->ustsutunidler[$n]["ch2"][$a][$k],-($j+1),$eklenen_form_id,$n,$a);   
                                 }
                                $k++; 
                             }  
                             if($this->sayaclar[$n][$a]>0){
                                 echo basariMetni($this->sayaclar[$n][$a]." Tablo Verisi Başarıyla Eklendi.");
                             }else {
                                 echo hataMetni("Tablo Verileri Eklenemedi.!");
                             }
                            $j++; 
                         }
              $a++;   
             }
            }
           
     }
}



public function resimAlanlariEkle($baglan,$resimalanlari,$i,$eklenen_form_id){
        $resimboyutu_sinir = 1024*1024*2;    
        $resimalani_names = [];
        $resimalani_errors = [];
        $resimalani_types = [];
        $resimalani_sizes = [];
        $resimalani_tmpnames = [];

        for($n=0;$n<$i;$n++){ 
                
                if(isset($resimalanlari["name"][$n])){
                    $x = 0;
                    foreach($resimalanlari["name"][$n] as $resimalaniname){
                        $resimalani_names[$n][$x] = $resimalaniname; 
                        $x++;
                    }
                    $p = 0;
                    foreach($resimalanlari["tmp_name"][$n] as $resimalanitmpname){
                        $resimalani_tmpnames[$n][$p] = $resimalanitmpname; 
                        $p++;
                    }
                    $y = 0;
                    foreach($resimalanlari["error"][$n] as $resimalanierror){
                        $resimalani_errors[$n][$y] = $resimalanierror;
                        $y++;
                    }
                    $z = 0;
                    foreach($resimalanlari["type"][$n] as $resimalanitype){
                        $resimalani_types[$n][$z] = $resimalanitype;
                        $z++;
                    }

                    $t = 0;
                    foreach($resimalanlari["size"][$n] as $resimalanisize){
                        $resimalani_sizes[$n][$t] = $resimalanisize;
                        $t++;
                    }
           
                    for($a = 0;$a<count($resimalani_names);$a++){
                        if(isset($this->alan_idler[$n]["resimalani"][$a])){
                            if($resimalani_errors[$n][$a] != 0){
                                echo hataMetni($n.".bölgedeki ".$a.". resim yüklenirken hata oluştu.");
                            }else {
                                
                                if($resimalani_sizes[$n][$a] > $resimboyutu_sinir){
                                    echo hataMetni($n.".bölgedeki ".$a.". resmin boyutu 2 MB 'den büyük olamaz");
                                }else {
                                    $tip = $resimalani_types[$n][$a];
                                    $resimadi = $resimalani_names[$n][$a];
                    
                                    $uzantisi = explode(".",$resimadi);
                                    $uzantisi = $uzantisi[count($uzantisi)-1]; 
                                    // dosyanın uzantısını alıyor birden fazla nokta olma ihtimalinden dolayı son noktadan sonrakini alıyor.
                    
                                    $form_resimurl = USER_IMAGES_PATH."alanresimi-".$eklenen_form_id."_".$n."_".$a.".".$uzantisi;
                    
                                    if($tip == "image/jpeg" || $tip == "image/png" || $tip == "image/jpg"){
                                        if(move_uploaded_file($resimalani_tmpnames[$n][$a],$form_resimurl)){
                                            
                                            echo basariMetni($n.".bölgedeki ".$a.". resim başarıyla yüklendi");
                                            $this->veriEkle($baglan,$form_resimurl,"resimalani",$eklenen_form_id,$this->alan_idler[$n]["resimalani"][$a]);

                                        }else {
                                            echo hataMetni($n.".bölgedeki ".$a.".resim yüklenirken sorun oluştu");
                                        }
                    
                                    }else {
                                        echo hataMetni($n.".bölgedeki ".$a.".resim resmin uzantısı png veya jpg olmalıdır.");
                                    }
                    
                                }
                            }
                            }
                        }    
            }
            } 
}




public function veriGuncelle($baglan,$veri,$form_id,$alan_id,$veri_turu,$n,$a){
    $veri = htmlspecialchars(ozelkarakterSil($veri));    
    $eskiverikontrol = $this->tablodanSatirGetir($baglan,"formalangirdileri",array("veri"),
    "ait_oldugu_form_id=".$form_id." and ait_oldugu_alan_id=".$alan_id."");
    if($eskiverikontrol){
    if($eskiverikontrol["veri"] != $veri){ 
       $formekle = $this->tablodanGuncelle($baglan,array("veri"=>$veri),"formalangirdileri",array("ait_oldugu_form_id"=>$form_id,"ait_oldugu_alan_id"=>$alan_id));
        if($formekle){
            echo basariMetni($n.".bölgenin ".$a. ". normal alanındaki veriyi güncelleme başarılı..");
        }else {
            echo hataMetni($n.".bölgenin ".$a. ".normal alanındaki veriyi güncelleme başarısız..");
        }
    }
    }else {
         $yeniekle = $this->tabloyaEkle($baglan,"formalangirdileri",array("veri","ait_oldugu_alan_id","veri_turu","ait_oldugu_form_id"),
                                                    array($veri,$alan_id,"checkbox",$form_id));
         if($yeniekle){
            echo basariMetni($n.".bölgenin ".$a. ". normal alanındaki veriyi güncelleme başarılı..");
         }else {
            echo hataMetni($n.".bölgenin ".$a. ".normal alanındaki veriyi güncelleme başarısız..");
         }
    }
}



public function tabloicerikGuncelle($baglan,$icerik,$alan_id,$nitelik_id,$yannitelik_id,$form_id,$bidx,$aidx){
    $icerik = htmlspecialchars(ozelkarakterSil($icerik));
    $eskiicerikkontrol = $this->tablodanSatirGetir($baglan,"formttablogirdiler",array("icerik"),"
    ait_oldugu_alan_id = ".$alan_id." and ait_oldugu_nitelik_id=".$nitelik_id." and
    ait_oldugu_yannitelik_id=".$yannitelik_id." and ait_oldugu_form_id=".$form_id."");

    if($eskiicerikkontrol["icerik"] != $icerik){    
    
    $icerikekle = $this->tablodanGuncelle($baglan,array("icerik"=>$icerik),"formttablogirdiler",
    array("ait_oldugu_alan_id"=>$alan_id,"ait_oldugu_nitelik_id"=>$nitelik_id,"ait_oldugu_form_id"=>$form_id,"ait_oldugu_yannitelik_id"=>$yannitelik_id));

    if($icerikekle){
    $this->sayaclar[$bidx][$aidx]++;
    }
    }
}

public function duzAlanGuncelle($baglan,$post,$alan_turu,$guncellenen_form_id,$bolge_sayisi){
    $alan = $post;
    for($n=0;$n<=$bolge_sayisi;$n++){ 
            if(isset($alan[$n])){
                $a = 0;
                foreach($alan[$n] as $alanicerik){
                    if(isset($this->alan_idler[$n][$alan_turu][$a])){
                        $this->veriGuncelle($baglan,$alanicerik,$guncellenen_form_id,$this->alan_idler[$n][$alan_turu][$a],$alan_turu,$n,$a);
                    }
                    $a++;
                }
            }
    }
}

public function checkGuncelle($baglan,$checkbox,$silineceksecenekler,$i,$guncellenen_form_id){


    for($n=0;$n<=$i;$n++){ 
        if(isset($checkbox[$n])){
                $a = 0;
                foreach($checkbox[$n] as $checkalanlar){
                    if(isset($this->alan_idler[$n]["checkbox"][$a])){   
                        $c = 0;
                        foreach($checkalanlar as $checkicerik){
                                    $veri = htmlspecialchars($checkicerik);

                                    $eskiverikontrol = $this->tabloSatirSay($baglan,"formalangirdileri","*"," ait_oldugu_alan_id = ".$this->alan_idler[$n]["checkbox"][$a]."
                                        and ait_oldugu_form_id = ".$guncellenen_form_id." and veri='".$veri."'");
                                    
                                    if($eskiverikontrol == -1){
                                   
                                    $veriekle = $this->tabloyaEkle($baglan,"formalangirdileri",array("veri","ait_oldugu_alan_id","veri_turu","ait_oldugu_form_id"),
                                                            array($veri,$this->alan_idler[$n]["checkbox"][$a],"checkbox",$guncellenen_form_id));
                                    if($veriekle){
                                            echo basariMetni($n.". bölgedeki ".$a. ". checkboxtaki ".$c." . seçeneği  güncelleme başarılı. 1");
                                    }else {
                                            echo hataMetni($n.". bölgedeki ".$a. " . checkboxtaki ".$c." . seçeneği  güncelleme başarısız. 1");
                                    } 

                                    }
                                       
                        
                         $c++;
                        }
                        
                    }
                $a++;
                }
        }
        }


        $x = 0;
        foreach($silineceksecenekler as $silbolge){
            $y = 0;
            foreach($silbolge as $silalan){
                $z = 0;
                foreach($silalan as $silinecekid){
                    if($silinecekid != "0"){
                        $silinecekid = htmlspecialchars($silinecekid);
                        $verisil = $this->tablodanSil($baglan,"formalangirdileri",array("veri_id"=>$silinecekid));
                        if($verisil){
                            echo basariMetni($x.". bölgedeki ".$y. ". checkboxtaki ".$z." . seçeneği  güncelleme başarılı. 2");
                        }else {
                            echo hataMetni($x.". bölgedeki ".$y. " . checkboxtaki ".$z." . seçeneği  güncelleme başarısız. 2");
                        }
                    }
                    $z++;
                }
                $y++;
            }
            $x++;
        }
    

    
}



public function resimveriGuncelle($baglan,$veri,$form_id,$alan_id){
    $veri = htmlspecialchars(ozelkarakterSil($veri));    
    $eskiverikontrol = $this->tablodanSatirGetir($baglan,"formalangirdileri",array("veri"),
    "ait_oldugu_form_id=".$form_id." and ait_oldugu_alan_id=".$alan_id."");
    if($eskiverikontrol){
        if($eskiverikontrol["veri"] != $veri){ 
        $eskiresimsil = $this->resimlerSil(array($eskiverikontrol["veri"])); 
        if($eskiresimsil){
        $formekle = $this->tablodanGuncelle($baglan,array("veri"=>$veri),"formalangirdileri",array("ait_oldugu_form_id"=>$form_id,"ait_oldugu_alan_id"=>$alan_id));
            if($formekle){
                echo basariMetni("Güncelleme Başarılı...");
            }else {
                echo hataMetni("Resim güncelleme başarısız !");
            }
        }else {
            echo hataMetni("Resim güncelleme başarısız !"); 
        }
    }
    }else {
        echo hataMetni("Resim güncelleme başarısız !"); 
    }
}

public function resimAlanlariGuncelle($baglan,$resimalanlari,$i,$guncellenen_form_id){
    $resimboyutu_sinir = 1024*1024*2;    
    $resimalani_names = [];
    $resimalani_errors = [];
    $resimalani_types = [];
    $resimalani_sizes = [];
    $resimalani_tmpnames = [];
    $resim_urls = array(array());

    for($n=0;$n<$i;$n++){ 
            if(isset($resimalanlari["name"][$n])){

                $x = 0;
                foreach($resimalanlari["name"][$n] as $resimalaniname){
                    $resimalani_names[$n][$x] = $resimalaniname; 
                    $x++;
                }
                $p = 0;
                foreach($resimalanlari["tmp_name"][$n] as $resimalanitmpname){
                    $resimalani_tmpnames[$n][$p] = $resimalanitmpname; 
                    $p++;
                }
                $y = 0;
                foreach($resimalanlari["error"][$n] as $resimalanierror){
                    $resimalani_errors[$n][$y] = $resimalanierror;
                    $y++;
                }
                $z = 0;
                foreach($resimalanlari["type"][$n] as $resimalanitype){
                    $resimalani_types[$n][$z] = $resimalanitype;
                    $z++;
                }

                $t = 0;
                foreach($resimalanlari["size"][$n] as $resimalanisize){
                    $resimalani_sizes[$n][$t] = $resimalanisize;
                    $t++;
                }

                $s = 0;
                foreach($this->resim_urller[$n] as $resim_url){
                    $resim_urls[$n][$s] = $resim_url;
                    $s++;
                }

       
                for($a = 0;$a<count($resimalani_names);$a++){
                    $form_resimurl = "";
                    if(isset($this->alan_idler[$n]["resimalani"][$a])){
                        if($resimalani_errors[$n][$a] != 0){
                            echo hataMetni($n.".bölgenin ".$a.".alanındaki resim yüklenirken hata oluştu. Bu yüzden resim değişmeyecek.");
                            $form_resimurl = $resim_urls[$n][$a];
                        }else {
                            
                            if($resimalani_sizes[$n][$a] > $resimboyutu_sinir){
                                echo hataMetni($n.".bölgenin ".$a.".alanındaki resmin boyutu 2 MB 'den büyük olamaz Bu yüzden resim değişmeyecek.");
                                $form_resimurl = $resim_urls[$n][$a];
                            }else {
                                $tip = $resimalani_types[$n][$a];
                                $resimadi = $resimalani_names[$n][$a];
                
                                $uzantisi = explode(".",$resimadi);
                                $uzantisi = $uzantisi[count($uzantisi)-1]; 
                                // dosyanın uzantısını alıyor birden fazla nokta olma ihtimalinden dolayı son noktadan sonrakini alıyor.
                
                                $form_resimurl = USER_IMAGES_PATH."alanresimi-".$guncellenen_form_id."_".$n."_".$a.".".$uzantisi;
                
                                if($tip == "image/jpeg" || $tip == "image/png" || $tip == "image/jpg"){
                                    if(move_uploaded_file($resimalani_tmpnames[$n][$a],$form_resimurl)){
                                        
                                        echo basariMetni($n.".bölgenin ".$a.".alanındaki resim başarıyla yüklendi");

                                    }else {
                                        echo hataMetni($n.".bölgenin ".$a.".alanındaki resim yüklenirken sorun oluştu Bu yüzden resim değişmeyecek.");
                                        $form_resimurl = $resim_urls[$n][$a];
                                    }
                
                                }else {
                                    echo hataMetni($n.".bölgenin ".$a.".alanındaki resmin uzantısı png veya jpg olmalıdır. Bu yüzden resim değişmeyecek.");
                                    $form_resimurl = $resim_urls[$n][$a];
                                }
                
                            }
                        }
                        
                        $this->resimveriGuncelle($baglan,$form_resimurl,$guncellenen_form_id,$this->alan_idler[$n]["resimalani"][$a]);
                        }
                    }
                    
                }
        }  
}


public function textTabloVeriGuncelle($baglan,$tabloveri,$i,$guncellenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        $a = 0;
        if(isset($tabloveri[$n])){
        foreach($tabloveri[$n] as $tabloverialan){
            $this->sayaclar[$n][$a] = 0;
            $k = 0;
                foreach($tabloverialan as $tabloverisatir){
                    $s = 0;
                        foreach($tabloverisatir as $tabloverial){
                            if(isset($this->alan_idler[$n]["txt1"][$a])){    
                           $this->tabloicerikGuncelle($baglan, $tabloverial, $this->alan_idler[$n]["txt1"][$a], 
                             $this->ustsutunidler[$n]["txt1"][$a][$s], $this->yansutunidler[$n]["txt1"][$a][$k],$guncellenen_form_id,$n,$a);
                           }
                            $s++;
                        }
                        $k++;          
                }
                if($this->sayaclar[$n][$a]>0){
                    echo basariMetni($this->sayaclar[$n][$a]." Kadar Tablo Verisi Güncellendi.");
                 }else {
                    echo hataMetni("Bazı tablo Verileri Güncellenemedi.!");
                 }
                
         $a++;   
        }
        }
}
}

public function textTablo2VeriGuncelle($baglan,$tabloveri2,$i,$guncellenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        $a = 0;
        if(isset($tabloveri2[$n])){
        foreach($tabloveri2[$n] as $tabloverialan){
            $k = 0;
            $this->sayaclar[$n][$a] = 0;
                foreach($tabloverialan as $tabloverisatir){
                    $s = 0;
                        foreach($tabloverisatir as $tabloverial){
                          if(isset($this->alan_idler[$n]["txt2"][$a])){    
                           $this->tabloicerikGuncelle($baglan, $tabloverial, $this->alan_idler[$n]["txt2"][$a], 
                             $this->ustsutunidler[$n]["txt2"][$a][$s], -($k+1),$guncellenen_form_id,$n,$a);
                           }
                            $s++;
                        }
                        $k++;          
                }
            if($this->sayaclar[$n][$a]>0){
                    echo basariMetni($this->sayaclar[$n][$a]." Kadar Tablo Verisi Güncellendi.");
                 }else {
                    echo hataMetni("Bazı tablo Verileri Güncellenemedi.!");
                 }        
         $a++;
           
        }
        
        }

    }
}

public function checkTabloVeriGuncelle($baglan,$tabloverich,$i,$guncellenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        $a = 0;
        if(isset($tabloverich[$n])){ 
             foreach($tabloverich[$n] as $tabloverialan){
                 $this->sayaclar[$n][$a] = 0;
                 $j = 0;
                     foreach($tabloverialan as $tabloverisatir){
                         $k = 0;
                             foreach($tabloverisatir as $tabloverial){
                              if(isset($this->alan_idler[$n]["ch1"][$a])){
                                $this->tabloicerikGuncelle($baglan, $tabloverial, $this->alan_idler[$n]["ch1"][$a],
                                   $this->ustsutunidler[$n]["ch1"][$a][$k], $this->yansutunidler[$n]["ch1"][$a][$j],$guncellenen_form_id,$n,$a);
                            
                                 }
                                $k++; 
                             }  
                            $j++; 
                         }  
                         if($this->sayaclar[$n][$a]>0){
                             echo basariMetni($this->sayaclar[$n][$a]." Kadar Tablo Verisi Güncellendi.");
                           }else {
                             echo hataMetni("Bazı Tablo Verileri Güncellenemedi.!");
                           }
              $a++;   
             }
            }
           
     }
}

public function checkTablo2VeriGuncelle($baglan,$tabloverich2,$i,$guncellenen_form_id){
    for($n=0;$n<=$i;$n++){ 
        if(isset($tabloverich2[$n])){
            $a = 0;
             foreach($tabloverich2[$n] as $tabloverialan){
                 $j = 0;
                     foreach($tabloverialan as $tabloverisatir){
                         $this->sayaclar[$n][$a] = 0;
                         $k = 0;
                             foreach($tabloverisatir as $tabloverial){
                              if(isset($this->alan_idler[$n]["ch2"][$a])){
                                 $this->tabloicerikGuncelle($baglan, $tabloverial, $this->alan_idler[$n]["ch2"][$a],
                                   $this->ustsutunidler[$n]["ch2"][$a][$k],-($j+1),$guncellenen_form_id,$n,$a);
                                 }
                                $k++; 
                             }  
                            $j++; 
                         }
                         if($sayaclar[$n][$a]>0){
                             echo basariMetni($this->sayaclar[$n][$a]." Kadar Tablo Verisi Güncellendi.");
                           }else {
                             echo hataMetni("Bazı Tablo Verileri Güncellenemedi.!");
                           }
              $a++;   
             }
            }
           
     }

}

public function formaAitresimlerBul($baglan,$form_id){
    $resimalani = $this->tablodanSatirlarGetir($baglan,"formalangirdileri","*","ait_oldugu_form_id = ".$form_id." and veri_turu='resimalani'");
    $silinecekresimler = array();
    if(isset($resimalani)){
        if(!empty($resimalani)){
            foreach($resimalani as $alan){
                array_push($silinecekresimler,$alan["veri"]);
            }
        }
    }
    return $silinecekresimler;
}


public function resimlerSil($silinecekresimler){
    if(!empty($silinecekresimler)){
            $i = 0;
            foreach($silinecekresimler as $resimurl){
                if(file_exists($resimurl)){
                    if(unlink($resimurl)){
                        $i++;
                    }
                }
            }
            return $i == count($silinecekresimler);
        }
    return false;
}




public function formSil($baglan,$form_id,$kid){
    $sil = $this->tablodanSil($baglan,"formbilgileri",array("form_id"=>$form_id,"ekleyen_id"=>$kid));
    return $sil;
}


public function onayRedEkle($baglan,$form_id,$metin,$k_id,$onaydurum){

        $ekle = $this->tabloyaEkle($baglan,"formnotlari",array("metin","form_id","ogretmen_id","durum"),
        array($metin,$form_id,$k_id,$onaydurum));
        
        if($ekle){
            $form_degistir = $this->tablodanGuncelle($baglan,array("form_durum"=>$onaydurum),"formbilgileri",array("form_id"=>$form_id));
            if($form_degistir){  
                if($onaydurum == "onay")  echo basariMetni("Onaylama İşlemi Başarılı.");
                else if($onaydurum == "red")  echo basariMetni("Red İşlemi Başarılı.");
            }else {
                if($onaydurum == "onay")  echo basariMetni("Onaylama İşlemi Başarısız.");
                else if($onaydurum == "red")  echo basariMetni("Red İşlemi Başarısız.");
            }
        }else {
            echo hataMetni("Metin Gönderilirken Hata Oluştu.!");
        }

}



public function formBilgileri($baglan,$form_id){
    return $this->tablodanSatirGetir($baglan,"formbilgileri","*","form_id=".$form_id."");
}
public function formTurBilgileri($baglan,$form_turu_id){
    return $this->tablodanSatirGetir($baglan,"formturbilgileri","*","tur_id=".$form_turu_id."");
}
public function bolgeBilgileri($baglan,$form_turu_id){
    return $this->tablodanSatirlarGetir($baglan,"formareabilgileri","*","ait_oldugu_form_turu_id=".$form_turu_id." ORDER BY bolge_id ASC");
}



public function alanBilgileri($baglan,$form_turu_id,$bolge_id){
return $this->tablodanSatirlarGetir($baglan,"formalanbilgileri","*","aitoldugu_form_turu_id = ".$form_turu_id." and ait_oldugu_bolge_id=".$bolge_id." ORDER BY alan_id ASC");
}

public function alanVerisiGetir($baglan,$form_id,$alan_id){
    return $this->tablodanSatirGetir($baglan,"formalangirdileri","*","ait_oldugu_form_id=".$form_id." and ait_oldugu_alan_id=".$alan_id."");
}
public function alanVerileriGetir($baglan,$form_id,$alan_id){
    return $this->tablodanSatirlarGetir($baglan,"formalangirdileri","*","ait_oldugu_form_id=".$form_id." and ait_oldugu_alan_id=".$alan_id."");
}

public function alanSeceneklerGetir($baglan,$alan_id){
    return $this->tablodanSatirlarGetir($baglan,"formsecenekbilgileri","*","ait_oldugu_alan_id=".$alan_id."");
}

public function tabloUstNitelikGetir($baglan,$alan_id){
    return $this->tablodanSatirlarGetir($baglan,"formtablosutunlar","*","ait_oldugu_alan_id=".$alan_id."");
}
public function tabloUstNitelikSay($baglan,$alan_id){
    return $this->tabloSatirSay($baglan,"formtablosutunlar","*","ait_oldugu_alan_id=".$alan_id."");
}

public function tabloYanNitelikGetir($baglan,$alan_id){
    return $this->tablodanSatirlarGetir($baglan,"formtablosatirlar","*","ait_oldugu_alan_id=".$alan_id."");
}
public function tabloYanNitelikSay($baglan,$alan_id){
    return $this->tabloSatirSay($baglan,"formtablosatirlar","*","ait_oldugu_alan_id=".$alan_id."");
}
public function tabloIcerikGetir($baglan,$form_id,$alan_id,$nitelikid,$yannitelikid){
    return $this->tablodanSatirGetir($baglan,"formttablogirdiler",array("icerik"),"
        ait_oldugu_alan_id = ".$alan_id." and ait_oldugu_form_id=".$form_id." and
        ait_oldugu_nitelik_id = ".$nitelikid." and ait_oldugu_yannitelik_id=".$yannitelikid."
    ");
}

public function tabloSatirSayisi($baglan,$alanid,$formid){
 
    return $this->tablodanSatirGetir($baglan,"formttablogirdiler",array("count(distinct ait_oldugu_yannitelik_id)"),
    "ait_oldugu_alan_id=".$alanid." and ait_oldugu_form_id=".$formid."");
}

public function onayMetniCek($baglan,$form_id){
return $this->tablodanSatirGetir($baglan,"formnotlari","*","form_id=".$form_id."");
}
public function puanMetniCek($baglan,$form_id){
    return $this->tablodanSatirGetir($baglan,"puanvenotlar","*","form_id = ".$form_id."");
}




public function gonderilenFormlariSay($baglan,$kid,$form_turu_id){
    return $this->tabloSatirSay($baglan,"formbilgileri","*","ekleyen_id=".$kid." 
    and form_turu_id=".$form_turu_id."");
    
}

public function akademisyeneGonderilenFormlariSay($baglan,$kid,$form_turu_id,$my_id){
    return $this->tabloSatirSay($baglan,"formbilgileri","*","ekleyen_id=".$kid." 
    and form_turu_id=".$form_turu_id." and gonderilen_akademisyen_id=".$my_id."");
}


public function akademisyeneGonderilenFormlariGetir($baglan,$kid,$form_turu_id,$my_id,$currentSayfa2,$slimit){
    return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","ekleyen_id=".$kid." and form_turu_id=".$form_turu_id." and gonderilen_akademisyen_id=".$my_id."
    LIMIT ".$slimit." OFFSET ".($currentSayfa2-1)*$slimit."");
}

public function gonderilenFormlariGetir($baglan,$kid,$form_turu_id,$currentSayfa2,$slimit){
    return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","ekleyen_id=".$kid." and form_turu_id=".$form_turu_id."
    LIMIT ".$slimit." OFFSET ".($currentSayfa2-1)*$slimit."");

}

public function berirliTurdekiFormlariSay($baglan,$form_turu_id,$my_id = -1){
    if($my_id !=-1) return $this->tabloSatirSay($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." and gonderilen_akademisyen_id=".$my_id."");
    else return $this->tabloSatirSay($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id."");
    
}

public function berirliTurdekiFormlariGetir($baglan,$form_turu_id,$limit,$currentSayfa,$my_id=-1){
    if($my_id !=-1) return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." 
    and gonderilen_akademisyen_id=".$my_id." LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit."");
    else return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit."");

}

public function berirliDurumdakiFormlariGetir($baglan,$form_turu_id,$goster,$limit,$currentSayfa,$my_id =-1){
    if($my_id!=-1) return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." and gonderilen_akademisyen_id=".$my_id." 
    and form_durum = '".$goster."' LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit."");
    else return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." 
    and form_durum = '".$goster."' LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit."");
}


public function berirliDurumdakiFormlariSay($baglan,$form_turu_id,$goster,$my_id = -1,$k_id=-1){
    $sayi = 0;
    if($my_id!=-1){
        $sayi = $this->tabloSatirSay($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." and gonderilen_akademisyen_id=".$my_id."
        and form_durum='".$goster."'");
    
    } 
    else if($k_id!=-1){
    $sayi = $this->tabloSatirSay($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id." and ekleyen_id=".$k_id."
    and form_durum='".$goster."'");
    }  
    else {
    $sayi = $this->tabloSatirSay($baglan,"formbilgileri","*","form_turu_id=".$form_turu_id."
    and form_durum='".$goster."'");
    }
    if($sayi == -1) $sayi = 0;
    return $sayi;
}



public function beklemedekiFormlariSay($baglan,$kid){
if($kid==-1) return $this->tabloSatirSay($baglan,"formbilgileri","*","form_durum='bekleme'");
return $this->tabloSatirSay($baglan,"formbilgileri","*","form_durum='bekleme' and gonderilen_akademisyen_id=".$kid."");

}

public function beklemedekiFormlariGetir($baglan,$limit,$currentSayfa,$kid){
    if($kid==-1) return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","form_durum='bekleme'
    order by eklenme_tarihi desc LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit.""); 
    return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","form_durum='bekleme' and gonderilen_akademisyen_id=".$kid."
    order by eklenme_tarihi desc LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit."");
}

public function yanitVerilenFormlariSay($baglan,$kid){
    return $this->tabloSatirSay($baglan,"formbilgileri","*","ekleyen_id=".$kid." and form_durum!='bekleme'");
}
public function yanitVerilenFormlariGetir($baglan,$kid,$limit,$currentSayfa){
    return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","ekleyen_id=".$kid." and form_durum!='bekleme'
    order by eklenme_tarihi desc 
    LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit."");
}

public function formUstBilgiGetir($baglan,$formturid){
  return $this->tablodanSatirGetir($baglan,"formturbilgileri","*","tur_id=".$formturid."");
}



public function gonderdigimFormlariGetir($baglan,$myid,$currentSayfa,$limit){

    return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","ekleyen_id=".$myid."
     LIMIT ".$limit." OFFSET ".($currentSayfa-1)*$limit." ");
}

public function gonderdigimFormlariSay($baglan,$myid){

    return $this->tabloSatirSay($baglan,"formbilgileri","*","ekleyen_id=".$myid."");

}


public function ustBilgiAraIdSorguVer($baglan,$aranan){
    $bulunan_idler = array();
    $bulunanbasliklar = $this->tablodanSatirlarGetir($baglan,"formturbilgileri",array("tur_id")," baslik LIKE '%".$aranan."%'");
    
    if($bulunanbasliklar){
    foreach($bulunanbasliklar as $baslik){
        array_push($bulunan_idler,$baslik["tur_id"]);
    }
    }else {return "";}

    $sorgu = "";
    $s = 0;
    for($i = 0;$i<count($bulunan_idler);$i++){
        if($i==count($bulunan_idler)-1)  $sorgu .= "form_turu_id=".$bulunan_idler[$i];
        else $sorgu .= "form_turu_id=".$bulunan_idler[$i]." or ";
    }

    return $sorgu;
}

public function gonderdigimFormlardaAra($baglan,$myid,$currentSayfa,$slimit,$aranan){
    $sorgu = $this->ustBilgiAraIdSorguVer($baglan,$aranan);
    return $this->tablodanSatirlarGetir($baglan,"formbilgileri","*","ekleyen_id=".$myid." and (".$sorgu.") LIMIT ".$slimit." OFFSET ".($currentSayfa-1)*$slimit."");
}
    
public function gonderdigimFormlarAramaSay($baglan,$myid,$aranan){
    $sorgu = $this->ustBilgiAraIdSorguVer($baglan,$aranan);
    return $this->tabloSatirSay($baglan,"formbilgileri","*","ekleyen_id=".$myid." and (".$sorgu.")");
}   




}
?>