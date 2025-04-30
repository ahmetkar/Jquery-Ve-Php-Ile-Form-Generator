<?php
class KullaniciModel extends Models {

    public function eskiSifreSorgula($baglan,$k_id){
        return $this->tablodanSatirGetir($baglan,"kullanicilar",array("sifre"),"kullanici_id=".$k_id."");
    }

    public function kullaniciBilgileri($baglan,$id){
        return $this->tablodanSatirGetir($baglan,"kullanicilar","*","kullanici_id = ".$id."");
    }
    public function ogrencibilgiCek($baglan,$kid){
        return $this->tablodanSatirGetir($baglan,"kullanicibilgileri","*","kullanici_id='".$kid."'");
    }

    public function akademisyenSay($baglan){
        return $this->tabloSatirSay($baglan,"kullanicilar","*","kullanici_tipi=1");
    }
    public function akademisyenleriGetir($baglan,$limit,$suankiSayfa){
        return $this->tablodanSatirlarGetir($baglan,"kullanicilar","*","kullanici_tipi = 1",$limit,($suankiSayfa-1)*$limit);
    }
    public function akademisyenleriDirekGetir($baglan){
        return $this->tablodanSatirlarGetir($baglan,"kullanicilar","*","kullanici_tipi = 1");
    }

    public function ogrenciSay($baglan){
        return $this->tabloSatirSay($baglan,"kullanicilar","*","kullanici_tipi=2");
    }

    public function ogrencileriGetir($baglan,$limit,$suankiSayfa){
       
        return $this->tablodanSatirlarGetir($baglan,"kullanicilar","*","kullanici_tipi=2",$limit,($suankiSayfa-1)*$limit);
    }

    public function ogrenciAramaSay($baglan,$aranan){
        return $this->tabloSatirSay($baglan,"kullanicilar","*","kullanici_tipi = 2 and adsoyad LIKE '%".$aranan."%'");
    }

    public function ogrenciAra($baglan,$aranan,$slimit,$suankiSayfa2){
        return $this->tablodanSatirlarGetir($baglan,"kullanicilar","*","kullanici_tipi = 2 and adsoyad LIKE '%".$aranan."%'
        LIMIT ".$slimit." OFFSET ".($suankiSayfa2-1)*$slimit."");
    }

    public function kullaniciAra($baglan,$aranan){
        return $this->tablodanSatirlarGetir($baglan,"kullanicilar","*","adsoyad LIKE '%".$aranan."%'");
    }

    public function kullaniciSil($baglan,$kid){
        $sil = $this->tablodanSil($baglan,"kullanicilar",array("kullanici_id"=>$kid));
        return $sil;
    }
    
    public function girisKontrol($baglan,$kadi,$pass,$ktipi){
    if($ktipi == "personel"){
        $sonuc = $this->tablodanSatirGetir($baglan,"kullanicilar","*","(kullanici_tipi = '0' or kullanici_tipi='1') and 
        kullanici_adi='".$kadi."' and sifre = '".$pass."' ");
        return $sonuc;
    }else {
        $sonuc = $this->tablodanSatirGetir($baglan,"kullanicilar","*","kullanici_tipi = '2' and 
        kullanici_adi='".$kadi."' and sifre = '".$pass."' ");
        return $sonuc;
    }
    }

}

?>