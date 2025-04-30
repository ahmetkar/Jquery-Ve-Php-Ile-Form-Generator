<!DOCTYPE html>

<html>
    <?php
    include("veritabani.php"); 
    session_start();
    include("ayarlar.php"); 
    
  
   if(isset($_SESSION["kid"])){ 

    include ("view/sidebar.php");
    
       
    require_once "models/kullanicimodel.php";
    require_once "models/formmodel.php";

    $klview = new KullaniciModel();
    $fm = new FormModel();


    $kid = $_SESSION["kid"];


  echo "<br<br>";
  echo '<div class="list-group">'; 
  if($akademisyen_kontrol){
          
          $sayfa = 1;
          if(isset($_GET["p"])){
                  $sayfa = htmlspecialchars(ozelkarakterSil($_GET["p"]));
          }
          $sayfasayisi = 1;
          $limit = 4;
          $suankiSayfa = $sayfa;


            if($yonetici_kontrol){
              $formsay = $fm->beklemedekiFormlariSay($baglan,-1);
              
              $beklemedekiformlar = $fm->beklemedekiFormlariGetir($baglan,$limit,$suankiSayfa,-1);
            }else {
            $formsay =$fm->beklemedekiFormlariSay($baglan,$kid);

            $beklemedekiformlar = $fm->beklemedekiFormlariGetir($baglan,$limit,$suankiSayfa,$kid);
            }
            if($beklemedekiformlar){
              $sayfasayisi = $formsay/$limit;
                  foreach($beklemedekiformlar as $form){
                 $formbaslik = $fm->formTurBilgileri($baglan,$form['form_turu_id']);
                 if($formbaslik){
                 $kullanici = $klview->kullaniciBilgileri($baglan, $form["ekleyen_id"]);
                    if($kullanici){
                    echo '<a href="formgoruntule.php?form_id='.$form["form_id"].'" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">'.$formbaslik["baslik"].' Gönderildi.</h5>
                              <small>'.$form["eklenme_tarihi"].'</small>
                            </div>
                            <p class="mb-1">'.$kullanici["adsoyad"].' Yeni Bir Form Gönderdi.</p>
                          </a><br>';    
                    }
                 }
             } 

                     
            if($sayfasayisi>1){
              echo '<nav aria-label="...">
              <ul class="pagination pagination-lg justify-content-center">';
              if($suankiSayfa>1){
                echo '<li class="page-item"><a href="bildirimler.php?p='.($suankiSayfa-1).'"
                  class="page-link">Önceki</a></li>';
              }
              $range = 5;
              $start_page = max(1, $suankiSayfa - $range);
              $end_page = min($sayfasayisi, $suankiSayfa + $range);

              for($i = $start_page;$i<=$end_page;$i++){
              if($i == $suankiSayfa){
                  echo '<li class="page-item disabled"><a class="page-link" href="bildirimler.php?p='.$i.'">'.$i.'</a></li>';
              }else {
                  echo '<li class="page-item"><a class="page-link" href="bildirimler.php?p='.$i.'">'.$i.'</a></li>';
              }
              }
              if($suankiSayfa<$sayfasayisi){
              echo '<li class="page-item">
                  <a class="page-link" href="bildirimler.php?p='.($suankiSayfa+1).'">Sonraki</a>
              </li>';
              }
          
              echo '</ul>
              </nav>';
          }
            }


             
  }else {
            $sayfa = 1;
            if(isset($_GET["p"])){
                    $sayfa = htmlspecialchars(ozelkarakterSil($_GET["p"]));
            }
            $sayfasayisi = 1;
            $limit = 4;
            $suankiSayfa = $sayfa;
           
    
            $formsay = $fm->yanitVerilenFormlariSay($baglan,$_SESSION["kid"]);
            $yanitverilenformlar = $fm->yanitVerilenFormlariGetir($baglan,$_SESSION["kid"],$limit,$suankiSayfa);
            
            if($yanitverilenformlar){
              $sayfasayisi = $formsay/$limit;
                 foreach($yanitverilenformlar as $form){
                 $formbaslik = $fm->formTurBilgileri($baglan,$form['form_turu_id']);
                
                 if($formbaslik){

                  $kullanici = false; 
                  if($form["form_durum"] == "onay" || $form["form_durum"] == "red"){
                  $onayverencek = $fm->onayMetniCek($baglan,$form["form_id"]);
                  if($onayverencek){
                   $kullanici = $klview->kullaniciBilgileri($baglan, $onayverencek["ogretmen_id"]);
                  }
                 }
                 
                    if($kullanici){
                    echo '<a href="formgoruntule.php?form_id='.$form["form_id"].'" class="list-group-item list-group-item-action" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">Gönderdiğiniz '.$formbaslik["baslik"].' adlı Form '; 
                              if($form["form_durum"] == "onay"){
                                  echo 'onaylandı.</h5>'
                                    .'<small>'.$form["eklenme_tarihi"].'</small>'
                                  .'</div>'
                                  .'<p class="mb-1">'.$kullanici["adsoyad"].' tarafından onaylandı.</p>'
                                .'</a><br>';  
                              }else if($form["form_durum"] == "red"){
                                  echo "reddedildi</h5>"
                                    ."<small>".$form["eklenme_tarihi"]."</small>"
                                  ."</div>"
                                  ."<p class='mb-1'>".$kullanici["adsoyad"]."  tarafından reddedildi.</p>"
                                ."</a><br>";
                                  
                              }

                    }
                 }
             }
             if($sayfasayisi>1){
              echo '<nav aria-label="...">
              <ul class="pagination pagination-lg justify-content-center">';
              if($suankiSayfa>1){
                echo '<li class="page-item"><a href="bildirimler.php?p='.($suankiSayfa-1).'"
                  class="page-link">Önceki</a></li>';
              }
           
              $range = 5;
              $start_page = max(1, $suankiSayfa - $range);
              $end_page = min($sayfasayisi, $suankiSayfa + $range);

              for($i = $start_page;$i<=$end_page;$i++){
              if($i == $suankiSayfa){
                  echo '<li class="page-item disabled"><a class="page-link" href="bildirimler.php?p='.$i.'">'.$i.'</a></li>';
              }else {
                  echo '<li class="page-item"><a class="page-link" href="bildirimler.php?p='.$i.'">'.$i.'</a></li>';
              }
              }
              if($suankiSayfa<$sayfasayisi){
              echo '<li class="page-item">
                  <a class="page-link" href="bildirimler.php?p='.($suankiSayfa+1).'">Sonraki</a>
              </li>';
              }
          
              echo '</ul>
              </nav>';
          }
        }
       
        }

        
        
       
        echo '</div>';
        echo "<br<br>";
        
   include("view/footer.php");
  }else {
    header("Location:girisyap.php");
  }
    ?>
    
    
</html>