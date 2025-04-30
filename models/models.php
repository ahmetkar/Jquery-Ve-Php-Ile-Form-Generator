<?php
if(count(get_included_files()) ==1){
    http_response_code(404);
    include('../view/404.php');
    exit;
}
class Models {

    public static function sifrele($str){return md5(sha1($str));}

    public static function ozelkarakterSil($str){
        //XSS ve Sql injection saldırılarına karşı önlem
          $old = array("(",")","{","}","[",",","'",'"',"*","]");
          $new = array("","","","","","","","","","");
          $new_str = str_replace($old,$new,$str);
          return $new_str;
    }

    private function generateInsertSql($tablo,$hangialanlar,$ne){
        $alan_sorgu = "";
        $len = count($hangialanlar);
        for($i=0;$i<$len;$i++){
            if($i == ($len-1)){
            $alan_sorgu.=$hangialanlar[$i]."";    
            }else {
            $alan_sorgu.=$hangialanlar[$i].","; 
            }
        }
        $eklenecekler = "";
        $len = count($ne);
        for($i=0;$i<$len;$i++){
            if($i == ($len-1)){
            $eklenecekler.="'".$ne[$i]."'";    
            }else {
            $eklenecekler.="'".$ne[$i]."',"; 
            }
        }
     $sql = "INSERT INTO ".$tablo."(".$alan_sorgu.") VALUES (".$eklenecekler.")";
     return $sql;
    }

    private function generateUpdateSql($alanarr,$tablo,$wherearr){
        $alan_sorgu = "";
        $len = count($alanarr);
        for($i=0;$i<$len;$i++){
            $keys = array_keys($alanarr)[$i];
            if($i == ($len-1)){
            $alan_sorgu.=$keys."='".$alanarr[$keys]."'";    
            }else {
            $alan_sorgu.=$keys."='".$alanarr[$keys]."',"; 
            }
        }
    
        $where_sorgu = "";
        $len = count($wherearr);
        for($i=0;$i<$len;$i++){
            $keys = array_keys($wherearr)[$i];
            if($i == ($len-1)){
            $where_sorgu.=$keys."=".$wherearr[$keys]."";    
            }else {
            $where_sorgu.=$keys."=".$wherearr[$keys]." and "; 
            }
        }
    $sql = "UPDATE ".$tablo." SET ".$alan_sorgu." WHERE ".$where_sorgu." ";
    return $sql;
    }


    private function generateDeleteSql($tablo,$where,$ifade="and"){
        $alan_sorgu = "";
        $len = count($where);
        for($i=0;$i<$len;$i++){
            $keys = array_keys($where)[$i];
            if($i == ($len-1)){
            $alan_sorgu.=$keys."='".$where[$keys]."'";    
            }else {
            $alan_sorgu.=$keys."='".$where[$keys]."' ".$ifade." "; 
            }
        }
     $sql = "DELETE from ".$tablo." WHERE ".$alan_sorgu." ";
     return $sql;
    }

    private function generateSelectSql($tablo,$sutunlar = "*",$whereifade,$unionifade=" "){
        $sql = "Select ";
        if($sutunlar == "*"){
            $sql.="*";
        }else {
        $len = count($sutunlar);
        for($i=0;$i<$len;$i++){
            if($i == ($len-1)){
            $sql.="".$sutunlar[$i];    
            }else {
            $sql.="".$sutunlar[$i].",";
            }
        }
        }
        
        //whereifade : a = 3 and b=7 // a = 7 or a = 9 // a = 'ke' or b='ke'
        
        
        $sql .= " from ".$tablo."";

        if(!empty($unionifade)){
        $sql .= " ".$unionifade;    
        }
        if($whereifade != ""){
            $sql .= " where ".$whereifade."";
        }

        return $sql;
    }

   

    private function addToSqlLimit($sql,$limit=-1,$offset=-1){
        if($limit!=-1 && $offset!=-1){
            $sql .= " LIMIT ".$limit." OFFSET ".$offset."";
            return $sql;
        }
        return "";
    }


    public  function tabloyaEkle($baglan,$tablo,$hangialanlar,$ne){
        try {
            $sql = $this->generateInsertSql($tablo,$hangialanlar,$ne);
            $alanekle = $baglan->exec($sql);
            if($alanekle > 0){
                return true;
            }else {
                return false;
            }
        }catch(PDOException $ex){
                echo hataMetni("Veritabanında sorun var  -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage()." ".$sql);
                return false;
        }
        return false;
    }

    public  function tablodanGuncelle($baglan,$alanarr,$tablo,$wherearr){
        try {
        $sql = $this->generateUpdateSql($alanarr,$tablo,$wherearr);
        $alanguncelle = $baglan->exec($sql);
        if($alanguncelle >= 0){
            return true;
            
        }else {
            return false;
        }
        }catch(PDOException $ex){
            echo hataMetni("Veritabanında sorun var  -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage());
            return false;
        }
    }

    public  function tablodanSil($baglan,$tablo,$where,$ifade = "and"){
        try {
            $sql = $this->generateDeleteSql($tablo,$where,$ifade);
            $alansil = $baglan->exec($sql);
            if($alansil > 0){
                return true;
            }else {
                return false;
            }
            }catch(PDOException $ex){
                echo hataMetni("Veritabanında sorun var  -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage());
                return false;
            }
        
    }


    public function tablodanHepsiniGetir($baglan,$tablo,$limit = -1,$offset = -1){
        try {
            $sql = $this->generateSelectSql($tablo,"*","");
            if($limit!=-1 && $offset!=-1) $sql = $this->addToSqlLimit($sql,$limit,$offset);
            $veriler = $baglan->query($sql)->fetchAll();
            if(!empty($veriler)){
                return $veriler;
            }
        }catch(PDOException $ex){
            echo hataMetni("Veritabanında sorun var  -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage());
        }
        return "";
    }


    public function tablodanSatirlarGetir($baglan,$tablo,$sutunlar,$whereifade,$limit=-1,$offset=-1,$unionifade=" "){
        try {
            $sql = $this->generateSelectSql($tablo,$sutunlar,$whereifade,$unionifade);
            if($limit!=-1 && $offset!=-1) $sql = $this->addToSqlLimit($sql,$limit,$offset);
            $veriler = $baglan->query($sql)->fetchAll();
            if(!empty($veriler)){
                return $veriler;
            }
            }catch(PDOException $ex){
                echo hataMetni("Veritabanında sorun var  -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage());
            }
            return "";
    }

    public function tablodanSatirGetir($baglan,$tablo,$sutunlar,$whereifade,$limit=-1,$offset=-1,$unionifade=" "){
        try {
            $sql = $this->generateSelectSql($tablo,$sutunlar,$whereifade,$unionifade);
            if($limit!=-1 && $offset!=-1) $sql = $this->addToSqlLimit($sql,$limit,$offset);
            $satir = $baglan->query($sql)->fetch();
            if(!empty($satir)){
                return $satir;
            }
            }catch(PDOException $ex){
                echo hataMetni("Veritabanında sorun var  -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage());
            }
            return "";
    }


    public function tabloSatirSay($baglan,$tablo,$sutunlar,$whereifade,$limit=-1,$offset=-1,$unionifade=" "){
        try {
            $sql = $this->generateSelectSql($tablo,$sutunlar,$whereifade,$unionifade);
            if($limit!=-1 && $offset!=-1) $sql = $this->addToSqlLimit($sql,$limit,$offset);
            $satirsayisi = $baglan->query($sql)->rowCount();
            if($satirsayisi>0){
                return $satirsayisi;
            }
            }catch(PDOException $ex){
                echo hataMetni("Veritabanında sorun var -> Kodu : ".$ex->getCode()."<br>".$ex->getMessage());
            }
            return 0;
    }




    

 
    

    

}

?>