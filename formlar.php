<?php

//Form türlerini görüntüle 
include ("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");
include ("view/sidebar.php");


require_once "models/formturumodel.php";
require_once "models/formmodel.php";
require_once "models/kullanicimodel.php";

$klview = new KullaniciModel();
$fm = new FormModel();
$ft = new FormTuruModel();


$my_id = $_SESSION["kid"];



    echo "<h3 align='center'>Formlar</h3><br>";
    $formlar = $ft->FormlariGetir($baglan);
    if($formlar){
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
        foreach($formlar as $form){
            $kullanici = $klview->kullaniciBilgileri($baglan, $form["ekleyen_id"]);
          
       echo '
      <div  style="width:32%;height:40%;" class="col">
        <div class="card border-secondary mb-3">
        <div class="text-center">
              <img src="'.$form["resim_url"].'" style="width:250px;height:250px;" class="card-img-top" alt="...">
              <div class="card-body text-secondary">
                      ';
                        if($akademisyen_kontrol){
                            echo ' <a class="btn btn-outline-success btn-sm" href="gelenformlarigoruntule.php?form_turu_id='.$form["tur_id"].'">'
                                    . 'Formları Görüntüle</a><br>';
                            if($_SESSION["ktipi"] == 0){
                    echo '<br> <a class="btn btn-outline-danger btn-sm" href="formsil.php?form_turu_id='.$form["tur_id"].'">'
                                    . 'Form Türünü Sil</a><br>';
                    echo '<br> <a class="btn btn-outline-warning btn-sm" href="formturuguncelle.php?form_turu_id='.$form["tur_id"].'">'
                                    . 'Form Türünü Güncelle</a>';                
                            }
                        }else {
                echo '<a href="ogrenciyeniform.php?form_turu_id='.$form["tur_id"].'" class="btn btn-outline-success btn-sm">'
                                .'Yeni Form Gönder'    
                            .'</a>';
                        }
                        
             echo ' </div>';
    
             
             if($yonetici_kontrol){
                $beklemesayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"bekleme",-1,-1);
                $onaysayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"onay",-1,-1);
                $redsayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"red",-1,-1);
             }else if($sadece_akademisyen){
                $beklemesayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"bekleme",$my_id,-1);
                $onaysayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"onay",$my_id,-1);
                $redsayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"red",$my_id,-1);
             }else {
                $beklemesayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"bekleme",-1,$my_id);
                $onaysayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"onay",-1,$my_id,);
                $redsayisi = $ft->formSayiGetir($baglan,$form["tur_id"],"red",-1,$my_id);
             }
                    echo '<ul class="list-group list-group-flush">
                    <li class="list-group-item"><h5 class="card-title">'.$form["baslik"].'</h5></li>   
                <li class="list-group-item">
                    <span class="badge text-bg-success">Onaylanan Form Sayısı : '.$onaysayisi.'</span>
                    <span class="badge text-bg-danger">Reddedilen Form Sayısı : '.$redsayisi.'</span>
                </li>
                <li class="list-group-item"><span class="badge text-bg-secondary">Beklemedeki Form Sayısı : '.$beklemesayisi.'</span></li>
                
            </ul>'; 

                            
            echo '</div>		
            </div>
        </div>';

        }
        echo ' </div>';
    }else {
        echo hataMetni("Formlar Bulunamadı.!");
    }



?>


<html>
    
    <?php 
 
 
    
    include("view/footer.php");
    ?>
    
    
    
</html>
