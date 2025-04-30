$(document).ready(function(){
    
 
    var formbaslik = "";
    var bolgebasliklari = [];
    
    var bolgeCount = 0;
    var secilen = "";
    
    var bolgeLimit = 20;
    var alanLimit = 50;
    let alanlar = Create2DArray(bolgeLimit);
    var alanSayaclar = [];
    
    var secenekSayaclar = Create2DArray(bolgeLimit);
    var sutunSayaclar = Create2DArray(bolgeLimit);
    var yansutunSayaclar = Create2DArray(bolgeLimit);
    var radiosecenekSayaclar = Create2DArray(bolgeLimit);
    var checksecenekSayaclar = Create2DArray(bolgeLimit);
    
    $(document).on('click','#bolgeekle',function(){
       
        $("#bolgegerial").css("visibility","visible");
        
        if(bolgeCount<=bolgeLimit){
             bolgeCount++; 
          
           var formalani = '<div class="bolge'+bolgeCount+'"><hr><br>'+
                       ' <a> '+bolgeCount+'. Form Bölgesinin Başlığını Girin (Bölgede istenecek bilgiler için açıklayıcı olmalı) : </a>'+
        '<input id="bolgebaslik'+bolgeCount+'" type="text" name="bolgebaslik['+(bolgeCount-1)+']"></input><br>'+
                   '<a id="alanbaslik">'+bolgeCount+'. Form Bölgesi İçin Eklenecek Alan Türü Seçin : </a>'+
                   '<select id="alan_turu'+bolgeCount+'" class="alan_turu" name="alan_turu'+bolgeCount+'">'+
                   '<option value="textbox">Textbox-Yazı kutusu</option>'+
                   '<option value="radio">Radio Grubu-Tekli Seçim Aracı</option>'+
                   '<option value="checkbox">Checkbox Grubu-Çoklu Seçim Aracı</option>'+
                   '<option value="textarea">Textarea-Metin kutusu</option>'+
                   '<option value="selectmenu">Select-Çoktan Seçmeli Menü</option>'+
                   '<option value="veritablo">Veri Tablosu</option>'+
                   '<option value="date">Date-Tarih Seçim Aracı</option>'+
                   '<option value="datetime">Datetime-Tarih/Saat Seçim Aracı</option>'+
                   '<option value="resimalani">Resim yükleme alanı</option>'+
                   '</select> '+
                   '<input type="button" id="alanturuekle'+bolgeCount+'" class="alanturuekle" value="Alan Ekle" /> '+
                   '<input type="button" id="alangerial'+bolgeCount+'" class="alangerial" value="Son Alanı Geri Al" /> '+ 
                   '<br><div id="aciklamagirisleri'+bolgeCount+'"></div><hr></div>';   
          $("#formlar").prepend(formalani);
           
           
         
          alanSayaclar[bolgeCount-1] = 0;
           
       }else {
           $("#formlar").prepend("<h5>"+bolgeLimit+"'den Fazla Form Bölgesi Eklenemez.!</h5>");
       }
    });
    
    $(document).on('click','#bolgegerial',function(){
         
        $(".bolge"+bolgeCount).html("");    
        alanSayaclar[bolgeCount-1] = 0;
        
        for (var i=0;i<alanlar[bolgeCount-1].length;i++) {
                    alanlar[bolgeCount-1][i] = [];
         }

        secimCount = 0;
        if(secenekSayaclar[bolgeCount-1]!== null){
             for (var i=0;i<secenekSayaclar[bolgeCount-1].length;i++) {
                    secenekSayaclar[bolgeCount-1][i] = [];
              }
        }
        if(sutunSayaclar[bolgeCount-1]!== null){
              for (var i=0;i<sutunSayaclar[bolgeCount-1].length;i++) {
                    sutunSayaclar[bolgeCount-1][i] = [];
              }
        }
        if(yansutunSayaclar[bolgeCount-1]!== null){
              for (var i=0;i<yansutunSayaclar[bolgeCount-1].length;i++) {
                    yansutunSayaclar[bolgeCount-1][i] = [];
              }
        }
        if(radiosecenekSayaclar[bolgeCount-1]!== null){
              for (var i=0;i<radiosecenekSayaclar[bolgeCount-1].length;i++) {
                    radiosecenekSayaclar[bolgeCount-1][i] = [];
              }
        }
         if(checksecenekSayaclar[bolgeCount-1]!== null){
              for (var i=0;i<checksecenekSayaclar[bolgeCount-1].length;i++) {
                    checksecenekSayaclar[bolgeCount-1][i] = [];
              }
        }
        tempCount[bolgeCount] = 0;
        if(bolgeCount>=1){
        bolgeCount--;
        }else{
            bolgeCount = 1;
        }   
        
    });
    
 
    
   
    
    
    var secimCount = 0;
    
    var tempCount  = new Array(alanLimit).fill(0);
    var tempidx = 1;
    $(document).on('click','.alanturuekle',function(){
        
    if(secimCount<=alanLimit){    
        
    var bolgeidx = $(this).attr("id")[12];
    
    if(bolgeidx !==tempidx){
        secimCount = tempCount[bolgeidx];
    }
    tempidx = bolgeidx;
    


    
    secilen = str_kontrol($('#alan_turu'+bolgeidx).find(":selected").val());  
    
    secimCount++;
    tempCount[bolgeidx] = secimCount;
    
    if(secilen ==="textbox" || secilen==="textarea" || secilen==="date" || secilen==="datetime" || secilen==="resimalani"){
            var alanaciklama = '<div id="alan'+(bolgeidx)+'_'+(secimCount)+'"><br><div id="alanaciklamagiris">'+
                '<a id="alansecimacikla">Seçtiğiniz '+secimCount+'. Alan Olan '+secilen+' İçin Bir Açıklama Girin : </a>'+
                '<input type="hidden" name="alanturleri['+(bolgeidx-1)+"]["+(secimCount-1)+']" value="'+secilen+'">'+
                '<input id="alanaciklama'+bolgeidx+'_'+secimCount+'" type="text" name="alanlar['+(bolgeidx-1)+"]["+(secimCount-1)+']"></input><br>'+
            '</div><br></div> ';

            $("#aciklamagirisleri"+bolgeidx).append(alanaciklama);
                       
    }
    
    if(secilen==="radio"){
        var radiogrupsecenekgiris = '<div id="alan'+(bolgeidx)+'_'+(secimCount)+'"><br><div id="alanaciklamagiris">'+
                '<a id="alansecimacikla">Seçtiğiniz '+secimCount+'. Alan Olan '+secilen+' Grubu İçin Bir Açıklama Girin : </a>'+
                '<input type="hidden" name="alanturleri['+(bolgeidx-1)+"]["+(secimCount-1)+']" value="'+secilen+'">'+
                '<input id="alanaciklama'+bolgeidx+'_'+secimCount+'" type="text" name="alanlar['+(bolgeidx-1)+"]["+(secimCount-1)+']"></input><br>'+
            '</div><br><br><div id="secenekgiris'+secimCount+'">'+
                '<a id="grupsecenekgiraciklama">Seçtiğiniz '+secimCount+'. Alan Olan '+secilen+' Grubu  İçin Seçenekleri Girin . </a><br>'+
                '<div id="radiosecenekaciklamalar'+bolgeidx+'_'+secimCount+'"><br></div><br><br>'+
                '<input type="button" id="radiosecenekekle'+bolgeidx+'_'+secimCount+'" class="radiosecenekekle" value="Daha Fazla Seçenek Ekle" /> '+
                 '<input type="button" id="radiogerial'+bolgeidx+'_'+secimCount+'" class="radiogerial" value="Son Seçeneği Geri Al" />'+
                '<br><br>'+   
        '</div></div> ';

        $("#aciklamagirisleri"+bolgeidx).append(radiogrupsecenekgiris);
        radiosecenekSayaclar[bolgeidx-1][secimCount-1] = 0;
    }
    
    if(secilen==="checkbox"){
       var checkgrupsecenekgiris = '<div id="alan'+(bolgeidx)+'_'+(secimCount)+'"><br><div id="alanaciklamagiris">'+
                '<a id="alansecimacikla">Seçtiğiniz '+secimCount+'. Alan Olan '+secilen+' Grubu İçin Bir Açıklama Girin : </a>'+
                '<input type="hidden" name="alanturleri['+(bolgeidx-1)+"]["+(secimCount-1)+']" value="'+secilen+'">'+
                '<input id="alanaciklama'+bolgeidx+'_'+secimCount+'" type="text" name="alanlar['+(bolgeidx-1)+"]["+(secimCount-1)+']"></input><br>'+
            '</div><br><br><div id="secenekgiris'+secimCount+'">'+
                '<a id="grupsecenekgiraciklama">Seçtiğiniz '+secimCount+'.  Alan Olan '+secilen+' Grubu İçin Seçenekleri Girin . </a><br>'+
                '<div id="checksecenekaciklamalar'+bolgeidx+'_'+secimCount+'"><br></div><br><br>'+
                '<input type="button" id="checksecenekekle'+bolgeidx+'_'+secimCount+'" class="checksecenekekle" value="Daha Fazla Seçenek Ekle" /> '+
                '<input type="button" id="checkgerial'+bolgeidx+'_'+secimCount+'" class="checkgerial" value="Son Seçeneği Geri Al" />'+
                '<br><br>'+   
        '</div></div> ';

        $("#aciklamagirisleri"+bolgeidx).append(checkgrupsecenekgiris);
        checksecenekSayaclar[bolgeidx-1][secimCount-1] = 0;

    }
    
    if(secilen==="veritablo"){
        var tablogiris = '<div id="alan'+(bolgeidx)+'_'+(secimCount)+'"><br><div id="alanaciklamagiris">'+
                '<a id="alansecimacikla">Seçtiğiniz '+secimCount+'.  Alan Olan '+secilen+' İçin Bir Açıklama Girin : </a>'+
                '<input type="hidden" name="alanturleri['+(bolgeidx-1)+"]["+(secimCount-1)+']" value="'+secilen+'">'+
                '<input id="alanaciklama'+bolgeidx+'_'+secimCount+'" type="text" name="alanlar['+(bolgeidx-1)+"]["+(secimCount-1)+']"></input><br>'+
            '</div><br><br><div id="sutungiris'+secimCount+'">'+
                'Tablonuzuna Sütunlar Ekleyin ve Sütun Başlıkları Girin.  '+
                '<div id="sutunaciklamalar'+bolgeidx+'_'+secimCount+'"><br></div><br>'+
                '<input type="button" id="sutunekle'+bolgeidx+'_'+secimCount+'" class="sutunekle" value="Sütun Ekle" /> '+
                 '<input type="button" id="sutungerial'+bolgeidx+'_'+secimCount+'" class="sutungerial" value="Geri Al" />'+
                '<div id="yansutunaciklamalar'+bolgeidx+'_'+secimCount+'"><br></div><br>'+
                '<input type="button" id="yansutunekle'+bolgeidx+'_'+secimCount+'" class="yansutunekle" value="Satır ekle" /> '+
                 '<input type="button" id="yansutungerial'+bolgeidx+'_'+secimCount+'" class="yansutungerial" value="Geri Al" /><br><br>'+
                '<a>Tabloya Girilecek Veri Tipini Seçin : </a>'+
                '<input value="text" type="radio" id="veritipi'+bolgeidx+'_'+secimCount+'" name="veritipi['+(bolgeidx-1)+']['+(secimCount-1)+']"> Metin Kutusu '+
                '<input value="check" type="radio" id="veritipi'+bolgeidx+'_'+secimCount+'" name="veritipi['+(bolgeidx-1)+']['+(secimCount-1)+']"> Seçim Aracı'+
                '</div><br><br>'+    
        '</div> </div>';

        $("#aciklamagirisleri"+bolgeidx).append(tablogiris);
        sutunSayaclar[bolgeidx-1][secimCount-1] = 0;
        yansutunSayaclar[bolgeidx-1][secimCount-1] = 0;
    }
    
            
    if(secilen==="selectmenu"){
       var secenekgiris = '<div id="alan'+(bolgeidx)+'_'+(secimCount)+'"><br><div id="alanaciklamagiris">'+
                '<a id="alansecimacikla">Seçtiğiniz '+secimCount+'.  Alan Olan '+secilen+' İçin Bir Açıklama Girin :</a>'+
                '<input type="hidden" name="alanturleri['+(bolgeidx-1)+"]["+(secimCount-1)+']" value="'+secilen+'">'+
                '<input id="alanaciklama'+bolgeidx+'_'+secimCount+'" type="text" name="alanlar['+(bolgeidx-1)+"]["+(secimCount-1)+']"></input><br>'+
            '</div><br><br><div id="secenekgiris'+secimCount+'">'+
                '<a id="secenekgiraciklama">Seçtiğiniz '+secimCount+'. Alan Olan Select Menu İçin Seçenekleri Girin .</a><br>'+
                '<div id="secenekaciklamalar'+bolgeidx+'_'+secimCount+'"><br></div><br><br>'+
                '<input type="button" id="secenekekle'+bolgeidx+'_'+secimCount+'" class="secenekekle" value="Daha Fazla Seçenek Ekle" />'+
                '<br><br>'+   
        '</div></div> ';


        $("#aciklamagirisleri"+bolgeidx).append(secenekgiris);
        secenekSayaclar[bolgeidx-1][secimCount-1] = 0;

    }
     alanlar[bolgeidx-1][secimCount-1] = secilen;  
     alanSayaclar[bolgeidx-1]+=1;
    }else {
    
        $("#formlar").prepend("<h5>"+alanLimit+" den Fazla Form Alanı Eklenemez.!</h5>");
    }
    
     });

     function tumBolgeleriveAlanlariSil(){

        alanlar = Create2DArray(bolgeLimit);
        alanSayaclar = [];
        
        secenekSayaclar = Create2DArray(bolgeLimit);
        sutunSayaclar = Create2DArray(bolgeLimit);
        yansutunSayaclar = Create2DArray(bolgeLimit);
        radiosecenekSayaclar = Create2DArray(bolgeLimit);
        checksecenekSayaclar = Create2DArray(bolgeLimit);
        bolgebasliklari = [];

        bolgeCount = 0;
        secimCount = 0;
        $("#formlar").html("");
     }

     
     
     
     $(document).on("click",".yansutungerial",function(){
        var idal = $(this).attr("id").slice(14).split("_");
        var bolge = idal[0];
        var alan = idal[1];
        console.log(bolge+""+alan   );
        console.log(yansutunSayaclar[bolge-1][alan-1]);
       $("div#yansutunaciklama"+bolge+"_"+alan+"_"+(yansutunSayaclar[bolge-1][alan-1])).remove();
       if(yansutunSayaclar[bolge-1][alan-1]>0){
            yansutunSayaclar[bolge-1][alan-1]--; 
       }else {
           yansutunSayaclar[bolge-1][alan-1] = 0;
       }
     });
     
     $(document).on("click",".sutungerial",function(){
        var idal = $(this).attr("id").slice(11).split("_");
        var bolge = idal[0];
        var alan = idal[1];
        console.log(bolge+""+alan   );
        console.log(sutunSayaclar[bolge-1][alan-1]);
       $("div#sutunaciklama"+bolge+"_"+alan+"_"+(sutunSayaclar[bolge-1][alan-1])).remove();
       if(sutunSayaclar[bolge-1][alan-1]>0){
            sutunSayaclar[bolge-1][alan-1]--; 
       }else {
           sutunSayaclar[bolge-1][alan-1] = 0;
       }
     });
     
     $(document).on("click",".checkgerial",function(){
        var idal = $(this).attr("id").slice(11).split("_");
        var bolge = idal[0];
        var alan = idal[1];
        console.log(bolge+""+alan   );
        console.log(checksecenekSayaclar[bolge-1][alan-1]);
       $("div#checksecenekaciklama"+bolge+"_"+alan+"_"+(checksecenekSayaclar[bolge-1][alan-1])).remove();
       if(checksecenekSayaclar[bolge-1][alan-1]>0){
            checksecenekSayaclar[bolge-1][alan-1]--; 
       }else {
           checksecenekSayaclar[bolge-1][alan-1] = 0;
       }
     });
     
     $(document).on("click",".radiogerial",function(){
        var idal = $(this).attr("id").slice(11).split("_");
        var bolge = idal[0];
        var alan = idal[1];
        console.log(bolge+""+alan   );
        console.log(radiosecenekSayaclar[bolge-1][alan-1]);
       $("div#radiosecenekaciklama"+bolge+"_"+alan+"_"+(radiosecenekSayaclar[bolge-1][alan-1])).remove();
       if(radiosecenekSayaclar[bolge-1][alan-1]>0){
            radiosecenekSayaclar[bolge-1][alan-1]--; 
       }else {
           radiosecenekSayaclar[bolge-1][alan-1] = 0;
       }
     });
     
     
     
     $(document).on("click",".alangerial",function(){
       
       var bolgeidAl= $(this).attr("id").slice(10);
       var bolgeid = bolgeidAl.split("_")[0];
       console.log(bolgeid);
       $("#alan"+bolgeid+"_"+secimCount).html("");
       alanSayaclar[bolgeid-1] -=1; 
       
       if(alanlar[bolgeCount-1][secimCount-1]!==null){
          alanlar[bolgeCount-1][secimCount-1] = null;  
       }
       
        if(secenekSayaclar[bolgeCount-1][secimCount-1]!== null){
            secenekSayaclar[bolgeCount-1][secimCount-1] = null; 
        }
        if(sutunSayaclar[bolgeCount-1][secimCount-1]!== null){
           sutunSayaclar[bolgeCount-1][secimCount-1] = null;   
        }
        if(yansutunSayaclar[bolgeCount-1][secimCount-1]!== null){
            yansutunSayaclar[bolgeCount-1][secimCount-1] = null;
        }
        if(radiosecenekSayaclar[bolgeCount-1][secimCount-1]!== null){
           radiosecenekSayaclar[bolgeCount-1][secimCount-1] = null;
        }
         if(checksecenekSayaclar[bolgeCount-1][secimCount-1]!== null){
           checksecenekSayaclar[bolgeCount-1][secimCount-1] = null;
        }
       
       if(secimCount>=1){
        secimCount--;
        tempCount[bolgeid]--;
        }else{
            secimCount = 1;
            tempidx = 1;
        }   
     });
     
    var bolgeidx2 = 1;
    var secimidx2  = 1;
    var idAl2 = "";
    $(document).on('click','.sutunekle',function(){
    idAl2= $(this).attr("id").slice(9);
    const idParca = idAl2.split("_");
    
    bolgeidx2 = idParca[0];
    secimidx2 = idParca[1];
    
    sutunSayaclar[bolgeidx2-1][secimidx2-1]+=1;
    
     var yenisutun = '<div id="sutunaciklama'+bolgeidx2+'_'+secimidx2+'_'+sutunSayaclar[bolgeidx2-1][secimidx2-1]+'"><br><input id="sutunaciklama'+bolgeidx2+'_'+secimidx2+'_'+sutunSayaclar[bolgeidx2-1][secimidx2-1]+'"'+
             'type="text" name="sutun['+(bolgeidx2-1)+"]["+(secimidx2-1)+']['+sutunSayaclar[bolgeidx2-1][secimidx2-1]+']" /><br></div>';

    
    $("#sutunaciklamalar"+bolgeidx2+"_"+secimidx2).append(yenisutun);
    
    
    });
    
    var bolgeidx3 = 1;
    var secimidx2 = 1;
    $(document).on('click','.yansutunekle',function(){
    idAl3= $(this).attr("id").slice(12);
    const idParca = idAl3.split("_");
    
    bolgeidx3 = idParca[0];
    secimidx3 = idParca[1];
    
    yansutunSayaclar[bolgeidx3-1][secimidx3-1]+=1;
    
     var yenisatir = '<div id="yansutunaciklama'+bolgeidx3+'_'+secimidx3+'_'+yansutunSayaclar[bolgeidx3-1][secimidx3-1]+'"><br><input id="yansutunaciklama'+bolgeidx3+'_'+secimidx3+'_'+yansutunSayaclar[bolgeidx3-1][secimidx3-1]+'"'+
             'type="text" name="yansutun['+(bolgeidx3-1)+"]["+(secimidx3-1)+']['+yansutunSayaclar[bolgeidx3-1][secimidx3-1]+']" /><br></div>';

    
    $("#yansutunaciklamalar"+bolgeidx3+"_"+secimidx3).append(yenisatir);
    
    
    });
     
   
    
    var bolgeidx1 = 1;
    var secimidx1  = 1;
    var idAl = "";
    
    $(document).on('click','.secenekekle',function(){
    idAl= $(this).attr("id").slice(11);
    const idParca = idAl.split("_");
    
    bolgeidx1 = idParca[0];
    secimidx1 = idParca[1];
    
    secenekSayaclar[bolgeidx1-1][secimidx1-1]+=1;
    var yenisecenek = '<br><input id="secenekaciklama'+bolgeidx1+'_'+secimidx1+'_'+secenekSayaclar[bolgeidx1-1][secimidx1-1]+'"'+
             'type="text" name="secenek['+(bolgeidx1-1)+"]["+(secimidx1-1)+']['+secenekSayaclar[bolgeidx1-1][secimidx1-1]+']" /><br>';

    
    $("#secenekaciklamalar"+bolgeidx1+"_"+secimidx1).append(yenisecenek);
   

    });
    
    var bolgeidx3 = 1;
    var secimidx3  = 1;
    var idAl3 = "";
    $(document).on('click','.radiosecenekekle',function(){
    idAl3= $(this).attr("id").slice(16);
    const idParca = idAl3.split("_");
    
    bolgeidx3 = idParca[0];
    secimidx3 = idParca[1];
    
    radiosecenekSayaclar[bolgeidx3-1][secimidx3-1]+=1;
    
    var yenigrupsecenek = '<div id="radiosecenekaciklama'+bolgeidx3+'_'+secimidx3+'_'+radiosecenekSayaclar[bolgeidx3-1][secimidx3-1]+'"><br>\n\
        <input id="radiosecenekaciklama'+bolgeidx3+'_'+secimidx3+'_'+radiosecenekSayaclar[bolgeidx3-1][secimidx3-1]+'"'+
             'type="text" name="'+secilen+'grupsecenek['+(bolgeidx3-1)+']['+(secimidx3-1)+']['+radiosecenekSayaclar[bolgeidx3-1][secimidx3-1]+']" /><br></div>';
    
    
    $("#radiosecenekaciklamalar"+bolgeidx3+"_"+secimidx3).append(yenigrupsecenek);
   

    });
    
    var bolgeidx4 = 1;
    var secimidx4  = 1;
    var idAl4 = "";
    $(document).on('click','.checksecenekekle',function(){
    idAl4= $(this).attr("id").slice(16);
    const idParca = idAl4.split("_");
    
    bolgeidx4 = idParca[0];
    secimidx4 = idParca[1];    
    checksecenekSayaclar[bolgeidx4-1][secimidx4-1]+=1;    
    var yenigrupsecenek = '<div id="checksecenekaciklama'+bolgeidx4+'_'+secimidx4+'_'+checksecenekSayaclar[bolgeidx4-1][secimidx4-1]+'">\n\
                <br><input id="checksecenekaciklama'+bolgeidx4+'_'+secimidx4+'_'+checksecenekSayaclar[bolgeidx4-1][secimidx4-1]+'"'+
             'type="text" name="'+secilen+'grupsecenek['+(bolgeidx4-1)+"]["+(secimidx4-1)+']['+checksecenekSayaclar[bolgeidx4-1][secimidx4-1]+']" /><br></div>';   
    
    $("#checksecenekaciklamalar"+bolgeidx4+"_"+secimidx4).append(yenigrupsecenek);
    
    });
   
    
    


    
   
    //Seçilenleri önizlemeye aktar
    $(document).on('click','#tamamla',function(){
        
        $("#formonizleme").css("visibility","visible");
        formbaslik = str_kontrol($("#form_baslik").val());
        $("h3#fbaslik").text(formbaslik);
      
        for(var i=1;i<=bolgeCount;i++){
        bolgebasliklari[i] = str_kontrol($("input#bolgebaslik"+i).val()); 
        } 
        
        
        $("#bolgeonizleme").html("");
        var bolgeonizleme = ""; 
        for(var j =1;j<bolgebasliklari.length;j++){
            console.log(bolgebasliklari[j]);
            bolgeonizleme ='<fieldset name="formbolgesi1">'+
                    '<legend>'+str_kontrol(bolgebasliklari[j])+'</legend><div id="bolgeonizleme'+j+'"></div>'+    
                '</fieldset>'; 
             $("#bolgeonizleme").append(bolgeonizleme);   
        }
        
      

    
       for(var i=0;i<alanlar.length;i++){
           for(var j=0;j<alanlar[i].length;j++){
               
               if(alanlar[i][j] === "selectmenu"){
                 var secenekonizle ="";
                    for(var z=1;z<=secenekSayaclar[i][j];z++){
                     var secenekaciklama = str_kontrol($("input#secenekaciklama"+(i+1)+"_"+(j+1)+"_"+z).val());
                     secenekonizle+='<option value="secenek'+z+'">'+secenekaciklama+'</option>';
                 }  
                 var selectonizleme = '<a>'+alanaciklama+'</a> : '+
                '<select name="select1">'+
                    secenekonizle+
                '</select><br><br>';
                $("#bolgeonizleme"+(i+1)).append(selectonizleme);
                
                   
               }else if(alanlar[i][j] === "textbox"){
                 var textboxonizleme = '<a>'+alanaciklama+' : </a>'+
                '<input type="text" name="txt'+(i+1)+'_'+(j+1)+'" /><br><br>';
               $("#bolgeonizleme"+(i+1)).append(textboxonizleme);
               }else if(alanlar[i][j] === "checkbox"){
                 var checksecenekonizle = "<fieldset><legend>"+alanaciklama+" : </legend>";
                 for(var k=1;k<=checksecenekSayaclar[i][j];k++){
                     var secenekaciklama = str_kontrol($("input#checksecenekaciklama"+(i+1)+"_"+(j+1)+"_"+k).val());
                     checksecenekonizle+='<input type="checkbox" value="'+secenekaciklama+'" name="chck['+(i+1)+']['+(j+1)+']['+k+']" /> '+secenekaciklama+'<br>';
                 }
                 var checkonizle = checksecenekonizle+"</fieldset>";
                 $("#bolgeonizleme"+(i+1)).append(checkonizle);
               }else if(alanlar[i][j] === "radio"){
                 var radiosecenekonizle = "<fieldset><legend>"+alanaciklama+" : </legend>";
                 for(var k=1;k<=radiosecenekSayaclar[i][j];k++){
                     var secenekaciklama = str_kontrol($("input#radiosecenekaciklama"+(i+1)+"_"+(j+1)+"_"+k).val());
                     radiosecenekonizle+='<input type="radio" value="'+secenekaciklama+'" name="radio['+(i+1)+']['+(j+1)+']" /> '+secenekaciklama+'<br>';
                 }
                 var radioonizle = radiosecenekonizle+"</fieldset>";
                 $("#bolgeonizleme"+(i+1)).append(radioonizle);
               }else if(alanlar[i][j]==="textarea"){
                 var textareaonizleme = '<a>'+alanaciklama+' : </a>'+
                '<textarea name="txtarea'+(i+1)+'_'+(j+1)+'"></textarea><br><br>';
               $("#bolgeonizleme"+(i+1)).append(textareaonizleme);  
                   
               }else if(alanlar[i][j] == "resimalani"){
                var resimalanionizleme = "<a>"+alanaciklama+" : </a>"+"<input type='file' name='deneme_resim'></input>";
                $("#bolgeonizleme"+(i+1)).append(resimalanionizleme);
               }else if(alanlar[i][j]==="date"){
                  var dateonizleme = '<a>'+alanaciklama+' : </a>'+
                '<input type="date" name="date'+(i+1)+'_'+(j+1)+'" /><br><br>';
               $("#bolgeonizleme"+(i+1)).append(dateonizleme);
               }else if(alanlar[i][j]==="datetime"){
                  var datetimeonizleme = '<a>'+alanaciklama+' : </a>'+
                '<input type="datetime-local" name="datetime'+(i+1)+'_'+(j+1)+'" /><br><br>';
               $("#bolgeonizleme"+(i+1)).append(datetimeonizleme);
               }else if(alanlar[i][j]==="veritablo"){
                   
                 var sutunonizleme = "<th scope='col'></th>";
                 var yansutunonizleme = "";
                 
                bossutunlar = [];
                bossutunlar = bossutunlar.fill(false);
                for(var z=1;z<=sutunSayaclar[i][j];z++){
                    var sutunaciklama = str_kontrol($("input#sutunaciklama"+(i+1)+"_"+(j+1)+"_"+z).val());
                    
                    sutunonizleme+="<th scope='col'>"+sutunaciklama+"</th>";
                    
                }
                
                bosyansutunlar = [];
                bosyansutunlar = bosyansutunlar.fill(false);
                for(var z=1;z<=yansutunSayaclar[i][j];z++){
                    var yansutunaciklama = str_kontrol($("input#yansutunaciklama"+(i+1)+"_"+(j+1)+"_"+z).val());
                    if(!$.trim(yansutunaciklama)){
                        bosyansutunlar[z] = true;
                    }else {
                    yansutunonizleme += "<tr id='satirlar"+(i+1)+"_"+(j+1)+"_"+z+"'><th scope='row'>"+yansutunaciklama+"</th></tr>";
                    }
                    
                }   
                
                if(yansutunSayaclar[i][j] < 1){
                    //yan sutun boş
                     var tabloonizleme = '<a>'+alanaciklama+'</a><br> <table style="border-collapse:collapse">'
                          +'<thead><tr>'
                          +sutunonizleme                 
                          +'</tr></thead><tbody><tr id="satirlar'+(i+1)+'_'+(j+1)+'"></tr></tbody>'
                          +'</table>';
                  $("#bolgeonizleme"+(i+1)).append(tabloonizleme);
                  
                 var veritipi = str_kontrol($("#veritipi"+(i+1)+"_"+(j+1)+":checked").val());
                 
                 var satironizleme = "<td></td>";
                  for(var n=1;n<=sutunSayaclar[i][j];n++){
                         
                         if(veritipi==="check"){ 
                         satironizleme += "<td id='tabloverichck"+n+"'><input type='checkbox' name='tablovericheck["+(i+1)+"]["+(j+1)+"]["+n+"]' \n\
                        class='tablovericheck' id='tablovericheck' /></td>";      
                        }else if(veritipi==="text"){
                          satironizleme +="<td id='tabloveri"+n+"'><a class='tablogiris' id='tablogiris"+(i+1)+"_"+(j+1)+"_"+n+"'>--</a></td>";
                          }
                  }
                  $("tr#satirlar"+(i+1)+"_"+(j+1)).append(satironizleme);
                   
                }else if(sutunSayaclar[i][j] < 1){
                      //üst sutun boş
                    var tabloonizleme = '<a>'+alanaciklama+'</a><br> <table style="border-collapse:collapse">'
                          +'<tbody>'+
                          yansutunonizleme+'</tbody>'
                          +'</table>';
                  $("#bolgeonizleme"+(i+1)).append(tabloonizleme);
                  
                 var veritipi = str_kontrol($("#veritipi"+(i+1)+"_"+(j+1)+":checked").val());
                 console.log(veritipi);
                      for(var m=1;m<=yansutunSayaclar[i][j];m++){
                         if(bosyansutunlar[m]){
                             continue;
                         } 
                         if(veritipi==="check"){ 
                         var checkekle = "<td id='tabloverichck"+m+"'><input type='checkbox' name='tablovericheck["+(i+1)+"]["+(j+1)+"]["+m+"]' \n\
                        class='tablovericheck' id='tablovericheck' /></td>";
                         $("tr#satirlar"+(i+1)+"_"+(j+1)+"_"+m).append(checkekle);       
                          }else if(veritipi==="text"){
                          var satironizleme="<td id='tabloveri"+m+"'><a class='tablogiris' id='tablogiris"+(i+1)+"_"+(j+1)+"_"+m+"'>--</a></td>";
                          $("tr#satirlar"+(i+1)+"_"+(j+1)+"_"+m).append(satironizleme);
                          }
                      }
                }else {
                    //ikiside dolu
                    var tabloonizleme = '<a>'+alanaciklama+'</a><br> <table style="border-collapse:collapse">'
                          +'<thead><tr>'
                          +sutunonizleme                 
                          +'</tr></thead><tbody>'+
                          yansutunonizleme+'</tbody>'
                          +'</table>';
                  $("#bolgeonizleme"+(i+1)).append(tabloonizleme);
                  
                 var veritipi = str_kontrol($("#veritipi"+(i+1)+"_"+(j+1)+":checked").val());
                 
                  for(var n=1;n<=sutunSayaclar[i][j];n++){
                      for(var m=1;m<=yansutunSayaclar[i][j];m++){
                         if(bossutunlar[n] || bosyansutunlar[m]){
                             continue;
                         } 
                         if(veritipi==="check"){ 
                         var checkekle = "<td id='tabloverichck"+m+"_"+n+"'><input type='checkbox' name='tablovericheck["+(i+1)+"]["+(j+1)+"]["+m+"]["+n+"]' \n\
                        class='tablovericheck' id='tablovericheck' /></td>";
                         $("tr#satirlar"+(i+1)+"_"+(j+1)+"_"+m).append(checkekle);       
                          }else if(veritipi==="text"){
                          var satironizleme="<td id='tabloveri"+m+"_"+n+"'><a class='tablogiris' id='tablogiris"+(i+1)+"_"+(j+1)+"_"+m+"_"+n+"'>--</a></td>";
                          $("tr#satirlar"+(i+1)+"_"+(j+1)+"_"+m).append(satironizleme);
                          }
                      }
                  }
                }
                

              
                  
                  
               }
               
               
               
               
               
               }
           }
             
        
        $("input#gonder").css("visibility","visible");
        
    });
    
    
});
