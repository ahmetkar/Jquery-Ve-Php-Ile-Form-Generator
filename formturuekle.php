<?php

//Form türü ekleme sayfası
//Form türü berirli form şablonlarıdır. Burada kullanıcı formun başlığını,içinde bulunacak textbox vs. alanları ve bu alanların
//bulunduğu bölgeleri ekler.Kod bunu alıp veritabanındaki tablolara ekler.
           
  
include("veritabani.php");
include("oturumbaslat.php");
include("ayarlar.php");

if($_SESSION["ktipi"] != 0){
        http_response_code(404);
        include('view/404.php');
        exit;
}
include ("view/sidebar.php");

require_once "models/formturumodel.php";    

?>
<html>
    <head>
        
        <script src="js/islemler.js"></script>
         <script src="js/formonizle.js"></script>
        
        <style type="text/css">
        
        table th[scope=col] {
         background-color: #d1084b;
         color: #fff;
         font-weight: 600;
         }
        table th[scope=row] {
         background-color: #4a061d;
         color: #fff;
         font-weight: 600;
         }
    </style>     
    </head>
<?php



$fg = new FormTuruModel();

if(isset($_POST["gonder"])){
    try { 
   
    $form_baslik = null;
    $bolge_basliklar = null;

    $alanlar = null;
    $alanturleri = null;

    $sutunlar = null;
    $yansutunlar = null;
    $tablotipleri = null;

    $radiosecenekler = null;
    $checkboxsecenekler = null;
    $selectsecenekler = null;


    $zorunluislemler = false;

    
    $ekleyen_id = $_SESSION["kid"];
    
    if(isset($_POST["form_baslik"]) && !empty($_POST["form_baslik"])){
        $form_baslik = htmlspecialchars($_POST["form_baslik"]);
        $zorunluislemler = true;
    }else {
        $zorunluislemler = false;
        echo hataMetni("Form başlığı girmek zorunludur");
    }

    
    if(isset($_POST["bolgebaslik"])){
        $bolge_basliklar = $_POST["bolgebaslik"];
    }

    if(isset($_POST["alanlar"]) && isset($_POST["alanturleri"])){
        $alanlar = $_POST["alanlar"];
        $alanturleri = $_POST["alanturleri"];
    }

    if(isset($_POST["radiogrupsecenek"])){
    $radiosecenekler = $_POST["radiogrupsecenek"];
    }
    if(isset($_POST["checkboxgrupsecenek"])){
    $checkboxsecenekler = $_POST["checkboxgrupsecenek"];
    }
    if(isset($_POST["secenek"])){
    $selectsecenekler = $_POST["secenek"];
    }

    if(isset($_POST["sutun"])){
        $sutunlar = $_POST["sutun"];    
    }
    if(isset($_POST["yansutun"])){
        $yansutunlar = $_POST["yansutun"];
    }

    if(isset($_POST["veritipi"])){
    $tablotipleri = $_POST["veritipi"];
    }
    

       
      
    //form turu ekle

     if($zorunluislemler){
        $form_resimurl = "";

        
        if(isset($_FILES["form_resim"])){
            $form_resimurl = $fg->formResimEkle($_FILES["form_resim"]);
            if(empty($form_resimurl)){
                die(hataMetni("Form resmi yüklenemedi"));
            }
        }else {
                die(hataMetni("Form resmi yüklenmedi"));
        } 

        if($fg->formTuruEkle($baglan,$form_baslik,$ekleyen_id,$form_resimurl    )){


        
        if(!isset($bolge_basliklar)){
            die(hataMetni("form için bölge ve alanlar eklemediniz..Lütfen tekrar deneyiniz."));
        }    

      

        $veriler = array("alanlar"=>$alanlar,"alanturleri"=>$alanturleri,
        "radiosecenekler"=>$radiosecenekler,"checkboxsecenekler"=>$checkboxsecenekler,"selectsecenekler"=>$selectsecenekler,
        "sutunlar"=>$sutunlar,"yansutunlar"=>$yansutunlar,"tablotipleri"=>$tablotipleri);

        $bolgelerekle = $fg->mezuniyetFormBolgelerVeAlanlarEkle($baglan,$bolge_basliklar,$veriler);
         
        if($bolgelerekle){
           echo basariMetni("Tüm alan ve bölgeler başarıyla eklendi");
        }else {
            echo hataMetni("Bölge ve Alan Eklemeleri Basarisiz.! Lütfen Tekrar Deneyin.");
        }   

    

        }else {
            echo hataMetni("Form türünün eklenmesi başarısız oldu.");
        }

        }else {
            echo hataMetni("Zorunlu olarak doldurulması gereken bazı alanlar boş");
        }
        
      }catch(Exception $e){
        echo hataMetni("Hata Oluştu -> Kodu : ".$e->getCode()."<br>".$e->getMessage()."<br>");
    }
 }
       
              
       

?>
        
 
        
       
    <body>
        <form action="" method="post" enctype="multipart/form-data">
     
            <a>Form Başlığı Giriniz : </a>
            <input id="form_baslik" type="text" name="form_baslik"></input>
            <hr>
            <a>Form Görselini yükleyiniz : </a>
            <input id="form_resim" type="file" name="form_resim"></input> 
            <hr>
   
            <a>Form İçin Bölgeler Ekleyin :</a>
            <div id="formbolgesiekleme">
            <input type="button" class="btn btn-outline-secondary" id="bolgeekle" value="Yeni Form Bölgesi Ekle" />
            <input style="visibility:hidden" type="button" class="btn btn-outline-secondary" id="bolgegerial" value="Son Bölgeyi Geri Al" />
            </div>
            
            <div id="formlar">
           
            </div>
                
               
            <input type="button" class="btn btn-outline-info" name="tamamla" id="tamamla" value="Tamamla ve Önizle" />
            <input id="gonder" class="btn btn-outline-success" style="visibility:hidden" type="submit" name="gonder" value="Yeni Form Türü Oluştur"/>
    
        </form>
        
        <form>
                  <div style="visibility:hidden" id="formonizleme">
                    <hr>
                    <h5>Formun Genel Görünümü </h5><br>
                <h3 id="fbaslik">Form Başlığı</h3><br>  
                    <div id="bolgeonizleme"></div>
                
                </div>
                <br><br>
            
            
        </form>
        
        
    </body>
    
  <?php include("view/footer.php"); ?>  
</html>