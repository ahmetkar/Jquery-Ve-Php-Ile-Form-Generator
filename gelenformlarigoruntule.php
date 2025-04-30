<?php

if(!isset($_GET["form_turu_id"])){
    header("Location:index.php");
}
include ("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");



if($_SESSION["ktipi"] > 1){
    http_response_code(404);
    include('view/404.php');
    exit;
}

require_once "models/formturumodel.php";
require_once "models/formmodel.php";
require_once "models/kullanicimodel.php";

include ("view/sidebar.php");
?>
<script>
    $(document).on('click','button#ara',function(){
        var aranan = $("input#aranan").val();
        var formturuid = $("input#formturuid").val();
        document.location.href = "gelenformlarigoruntule.php?form_turu_id="+formturuid+"&s="+aranan+"";
    });

    $(document).on('change','#secenekler',function(){
        var durum = $(this).val();
        //1 onaylı 0 bekleme 2 red ve hepsi
        var formturuid = $("input#formturuid").val();
        document.location.href = "gelenformlarigoruntule.php?form_turu_id="+formturuid+"&goster="+durum+""
        
    });
</script>

<?php

$kl = new KullaniciModel();
$ft = new FormTuruModel();
$fm = new FormModel();


//Berirli bir form türündeki formları görüntüle


function formlarYazdir($baglan,$form,$formtur){     
        global $kl;
        $kullanici = $kl->kullaniciBilgileri($baglan, $form["ekleyen_id"]);
        echo '<div class="col form_'.$form["form_durum"].'">
        <div class="card border-secondary mb-3">
        <div class="text-center">
              <img src="'.$formtur["resim_url"].'" style="max-width:250px;max-height:250px;" class="card-img-top" alt="...">
              <div class="card-body text-secondary">';  
          echo ' <a class="btn btn-outline-success btn-sm" href="formgoruntule.php?form_id='.$form["form_id"].'">'
                                    . 'Onay İçin Forma Git</a>';
         
          echo ' <ul class="list-group list-group-flush">
                           <li class="list-group-item"><h5 class="card-title">'.$formtur["baslik"].'</h5></li>'
                  .'<li class="list-group-item"><b>Ekleyen Kişi : </b> <a>'.$kullanici["adsoyad"].'</a></li>'
                  . '<li class="list-group-item">';
                  if($form["form_durum"] == "onay"){echo '<span class="badge text-bg-success">Onaylı</span>';}
                  else if($form["form_durum"] == "red"){echo '<span class="badge text-bg-danger">Reddedilmiş</span>';}
                  else if($form["form_durum"] == "bekleme"){echo '<span class="badge text-bg-secondary">Beklemede</span>';}
        
          echo '</li>';
          echo '</ul></div></div>
                </div>';
}



try {
$my_id = $_SESSION["kid"];
$goster = "hepsi"; 
$form_turu_id = htmlspecialchars(ozelkarakterSil($_GET["form_turu_id"]));

$formtur = $ft->formturBilgileriGetir($baglan,$form_turu_id);

echo '<div class="row justify-content-center"> 
<input type="text" id="formturuid" value="'.$form_turu_id.'" hidden/>
<div class="col-5">
    <input class="form-control" type="text" id="aranan" placeholder="Lütfen ad soyad giriniz." />
</div>
<div class="col-2">
    <button id="ara" style="width:100%" class="btn btn-warning" type="submit" name="ara">Arama Yap</button>
</div>
<div class="col-4">
<select class="form-control secenekler" name="goster" id="secenekler">
  <option>Form Durumu Seçin..</option>  
  <option value="hepsi">Tümü</option>
  ';

  echo '<option value="onay">Onaylanmış</option>
  <option value="red">Reddedilmiş</option>';
  echo '<option value="bekleme">İşlem Bekleyen</option>
</select>
</div>
</div><br><br>';

if(isset($_GET["s"]) && !empty($_GET["s"])){
    $aranan =  htmlspecialchars(ozelkarakterSil($_GET["s"]));

    $sayfa2 = 1;
    if(isset($_GET["sp"])){
            $sayfa2 = htmlspecialchars(ozelkarakterSil($_GET["sp"]));
    }
    $sayfasayisi2 = 1;
    $slimit = 9;
    $suankiSayfa2 = $sayfa2;

     
    $sonuclar = $kl->kullaniciAra($baglan,$aranan);

    if($sonuclar){
        $sonucsay = 0;
        echo '<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">'; 
        foreach($sonuclar as $kid){
            if($yonetici_kontrol){

            $formsay = $fm->gonderilenFormlariSay($baglan,$kid["kullanici_id"],$form_turu_id);
   
            $formlarbul = $fm->gonderilenFormlariGetir($baglan,$kid["kullanici_id"],$form_turu_id,$suankiSayfa2,$slimit);

            }else {
             $formsay = $fm->akademisyeneGonderilenFormlariSay($baglan,$kid["kullanici_id"],$form_turu_id,$my_id);

            $formlarbul = $fm->akademisyeneGonderilenFormlariGetir($baglan,$kid["kullanici_id"],$form_turu_id,$my_id,$suankiSayfa2,$slimit);
            }

            if($formlarbul){
            foreach($formlarbul as $form){
            formlarYazdir($baglan,$form,$formtur);
            }
            $sonucsay +=$formsay;
            }
        }
        echo "</div>";
        $sayfasayisi2 = $sonucsay/$slimit;
        if($sayfasayisi2>1){
            echo '<nav aria-label="...">
            <ul class="pagination pagination-lg justify-content-center">';
            if($suankiSayfa2>1){
               echo '<li class="page-item"><a 
               href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&s='.$aranan.'&sp='.($suankiSayfa2-1).'"
                class="page-link">Önceki</a></li>';
            }
            $range = 5;
            $start_page = max(1, $suankiSayfa2 - $range);
            $end_page = min($sayfasayisi2, $suankiSayfa2 + $range);
    
            for($i = $start_page;$i<=$end_page;$i++){
            if($i == $suankiSayfa2){
                echo '<li class="page-item disabled"><a class="page-link" href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&s='.$aranan.'&sp='.$i.'">'.$i.'</a></li>';
            }else {
                echo '<li class="page-item"><a class="page-link" href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&s='.$aranan.'&sp='.$i.'">'.$i.'</a></li>';
            }
            }
           
            if($suankiSayfa2<$sayfasayisi2){
            echo '<li class="page-item">
                <a class="page-link" 
                href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&s='.$aranan.'&sp='.($suankiSayfa2+1).'">Sonraki</a>
            </li>';
            }
        
            echo '</ul>
            </nav>';
        }

    }else {
        echo hataMetni("Herhangi bir sonuç bulunamadı.")."<br>";
    }

    
}else {

$sayfa = 1;
if(isset($_GET["p"])){
        $sayfa = htmlspecialchars(ozelkarakterSil($_GET["p"]));
}
$sayfasayisi = 1;
$limit = 9;
$suankiSayfa = $sayfa;


if(isset($_GET["goster"])){
    $goster = htmlspecialchars(ozelkarakterSil($_GET["goster"]));
    $kabuledilebilir = array("hepsi","bekleme","red","onay");
    if(!in_array($goster,$kabuledilebilir)){
        $goster = "hepsi";
    }
}
$formlar = null;

if($goster == "hepsi"){
if($yonetici_kontrol){

    $formlar= $fm->berirliTurdekiFormlariGetir($baglan,$form_turu_id,$limit,$suankiSayfa,-1);
    $formsay = $fm->berirliTurdekiFormlariSay($baglan,$form_turu_id,-1);
}else {   
    $formlar = $fm->berirliTurdekiFormlariGetir($baglan,$form_turu_id,$limit,$suankiSayfa,$my_id);
    $formsay = $fm->berirliTurdekiFormlariSay($baglan,$form_turu_id,$my_id);
}
}else{
    if($yonetici_kontrol){
    $formlar = $fm->berirliDurumdakiFormlariGetir($baglan,$form_turu_id,$goster,$limit,$suankiSayfa,-1);
    $formsay = $fm->berirliDurumdakiFormlariSay($baglan,$form_turu_id,$goster,-1);
    }else {
    $formlar = $fm->berirliDurumdakiFormlariGetir($baglan,$form_turu_id,$goster,$limit,$suankiSayfa,$my_id);
    $formsay = $fm->berirliDurumdakiFormlariSay($baglan,$form_turu_id,$goster,$my_id); 
    }
}


if($formtur && $formlar && $formsay){
    $sayfasayisi = $formsay/$limit;
    echo '<div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">';
        foreach($formlar as $form){
        formlarYazdir($baglan,$form,$formtur);
        }
    echo "</div>"; 

        
    if($sayfasayisi>1){
        echo '<nav aria-label="...">
        <ul class="pagination pagination-lg justify-content-center">';
        if($suankiSayfa>1){
           echo '<li class="page-item"><a href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&p='.($suankiSayfa-1).'&goster='.$goster.'"
            class="page-link">Önceki</a></li>';
        }
      
        $range = 5;
        $start_page = max(1, $suankiSayfa - $range);
        $end_page = min($sayfasayisi, $suankiSayfa + $range);

        for($i = $start_page;$i<=$end_page;$i++){
        if($i == $suankiSayfa){
            echo '<li class="page-item disabled"><a class="page-link" href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&p='.$i.'&goster='.$goster.'">'.$i.'</a></li>';
        }else {
            echo '<li class="page-item"><a class="page-link" href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&p='.$i.'&goster='.$goster.'">'.$i.'</a></li>';
        }
        }
        if($suankiSayfa<$sayfasayisi){
        echo '<li class="page-item">
            <a class="page-link" href="gelenformlarigoruntule.php?form_turu_id='.$form_turu_id.'&p='.($suankiSayfa+1).'&goster='.$goster.'">Sonraki</a>
        </li>';
        }
    
        echo '</ul>
        </nav>';
    }

}else {
    echo hataMetni("Formlar Bulunamadı.!");
}
    
    echo "<br>";  
}

}catch(Exception $e){
        echo hataMetni("Hata Oluştu.! -> Kodu : ".$e->getCode()."<br>".$e->getMessage()."<br>");
}

 

include("view/footer.php");
?>

