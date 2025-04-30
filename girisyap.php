
<?php

session_start();

include("veritabani.php");
include("ayarlar.php");


require_once "models/kullanicimodel.php";

$uyari_mesaji = "  ";  

$kl = new KullaniciModel();
if(isset($_POST["giris"])){
    
    $kadi = null;
    $pass = null;
    $sonuc = null;

    
    
    if(isset($_POST["pkadi"]) && !empty($_POST["pkadi"]) && isset($_POST["ppass"]) && !empty($_POST["ppass"])){
    $kadi =htmlspecialchars($_POST["pkadi"]);
    $pass = htmlspecialchars($_POST["ppass"]);
    
    
    $sonuc = $kl->girisKontrol($baglan,$kadi,$pass,"personel");
    
   if(isset($_POST["hatirla"]) && $sonuc){
        //Beni hatırla
        $time = time()+3600;
        //1 saatliğine kullanıcı ve adını çerez olarak ekle
        setcookie("pkadi", $kadi,$time);
        setcookie("ppass",$pass,$time);
    }
    }
    if(isset($_POST["okadi"]) && !empty($_POST["okadi"]) && isset($_POST["opass"]) && !empty($_POST["opass"])){
    $kadi = htmlspecialchars($_POST["okadi"]);
    $pass = htmlspecialchars($_POST["opass"]);
    
    
    
    $sonuc = $sonuc = $kl->girisKontrol($baglan,$kadi,$pass,"ogrenci");
    if(isset($_POST["hatirla"]) && $sonuc){
        //Beni hatırla
        $time = time()+3600;
        //1 saatliğine kullanıcı ve adını çerez olarak ekle
        setcookie("okadi", $kadi,$time);
        setcookie("opass",$pass,$time);
    }
    }
    
   
    
    if($kadi !== null && $pass !=null){
    
    if($sonuc){
        $_SESSION["kid"] = $sonuc["kullanici_id"];
        $_SESSION["kadi"] = $sonuc["kullanici_adi"];
        $_SESSION["adsoyad"] = $sonuc["adsoyad"];
        $_SESSION["ktipi"] = $sonuc["kullanici_tipi"];
        $uyari_mesaji =  "Giriş başarılı";
        header("Location:index.php");
    }else {
        $uyari_mesaji = "<center>Giriş İşlemi Başarısız. Bilgilerinizi Kontrol Ediniz</center>";
    }
    }else {
        $uyari_mesaji = "<center>Girdiğiniz Kullanıcı Adı veya Şifre Geçersiz.</center>";
    }
}


?>
 <!doctype html>
<html data-bs-theme="light">
  <head><script src="js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sisteme Giriş Yap</title>

    <!-- Favicons -->
<meta name="theme-color" content="#712cf9">
<link rel="stylesheet" href="css/giris1.css">    
    
  </head>
 	
	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onClick="ogrenci()">Öğrenci Girişi</button>
				<button type="button" class="toggle-btn" onClick="personel()">Personel Girişi</button>
			</div>
                        <?php echo "<span id='uyari'>".$uyari_mesaji."</span>"; ?>
                        
			<form method="post" action="" id="ogrenci" class="input-group">
                                <?php if(isset($_COOKIE["okadi"]) && isset($_COOKIE["opass"])){
				echo '<input value="'.$_COOKIE["okadi"].'" name="okadi" type="text" class="input-field" placeholder="Kullanıcı Adı Giriniz" required />
				<input value="'.$_COOKIE["opass"].'" name="opass" type="password" class="input-field" placeholder="Şifre Giriniz" required />';
                                }else {
                                echo '<input value="" name="okadi" type="text" class="input-field" placeholder="Kullanıcı Adı Giriniz" required />
				<input value="" name="opass" type="password" class="input-field" placeholder="Şifre Giriniz" required />';
                                } ?>
				<input name="hatirla" type="checkbox" class="check-box" /><span> Remember Me</span>
				<input name="giris" type="submit" class="submit-btn" value="Giriş yap" />
			</form>
			<form method="post" action="" id="personel" class="input-group">
                                <?php if(isset($_COOKIE["pkadi"]) && isset($_COOKIE["ppass"])){
				echo '<input value="'.$_COOKIE["pkadi"].'" name="pkadi" type="text" class="input-field" placeholder="Kullanıcı Adı Giriniz" required />
				<input value="'.$_COOKIE["ppass"].'" name="ppass" type="password" class="input-field" placeholder="Şifre Giriniz" required />';
                                }else {
                                echo '<input value="" name="pkadi" type="text" class="input-field" placeholder="Kullanıcı Adı Giriniz" required />
				<input value="" name="ppass" type="password" class="input-field" placeholder="Şifre Giriniz" required />';
                                } ?>
                                <input name="hatirla" type="checkbox" class="check-box" /><span> Remember Me</span>
				<input name="giris" type="submit" class="submit-btn" value="Giriş yap" />
			</form>
                        
		</div>
	</div>
	<script>
	var x= document.getElementById("ogrenci");
	var y= document.getElementById("personel");
	var z= document.getElementById("btn");
		
	function personel(){
		x.style.left="-400px";
		y.style.left="50px";
		z.style.left="110px";
	}
		function ogrenci(){
		x.style.left="50px";
		y.style.left="450px";
		z.style.left="0px";
	}
		
	</script>
</html>   
