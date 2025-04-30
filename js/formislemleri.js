$(document).ready(function(){

var bolgeLimit =20;
var alanLimit = 50;

$(document).on('click','.tablogiris',function(){
    var idAl= $(this).attr("id").slice(10);
    console.log(idAl);
    var idParca = idAl.split("_");
    var bolge = idParca[0];
    var alan = idParca[1];
    var satir = idParca[2];
    var sutun = idParca[3];
    
    console.log(bolge+"_"+alan+"_"+satir+"_"+sutun);
    
    var tdval = str_kontrol($(this).text());
    console.log(tdval);
    
    var txtekle = "<input type='text' name='tabloveritxt["+(bolge-1)+"]["+(alan-1)+"]["+(satir-1)+"]["+(sutun-1)+"]' class='tabloveritxt' \n\
\n                     id='tabloveritxt"+bolge+"_"+alan+"_"+satir+"_"+sutun+"' \n\
                   value='"+tdval+"' />";
    $("#tabloveri"+bolge+"_"+alan+"_"+satir+"_"+sutun).html(txtekle);
    
    
   });
   
           
   $(document).on('keypress','.tabloveritxt',function(e){
       if(e.which === 13){
       var idAl= $(this).attr("id").slice(12);
       var idParca = idAl.split("_");
       var bolge = idParca[0];
       var alan = idParca[1];
       var satir = idParca[2];
       var sutun = idParca[3];
       
       var duzenlenenmetin = str_kontrol($(this).val());

       var aval = "<input type='text' value='"+duzenlenenmetin+"' name='tabloveritxt["+(bolge-1)+"]["+(alan-1)+"]["+(satir-1)+"]["+(sutun-1)+"]' hidden/> \n\
                   <a style='color:black' id='tablogiris"+bolge+"_"+alan+"_"+satir+"_"+sutun+"' class='tablogiris'>"+duzenlenenmetin+"</a>";
       $("#tabloveri"+bolge+"_"+alan+"_"+satir+"_"+sutun).html(aval);
       }
   });
   
   
   
   $(document).on('click','.tablogiris2',function(){
    var idAl= $(this).attr("id").slice(11);
    console.log(idAl);
    var idParca = idAl.split("_");
    var bolge = idParca[0];
    var alan = idParca[1];
    var satir = idParca[2];
    var sutun = idParca[3];
    
    var tdval = str_kontrol($(this).text());
    
    var txtekle = "<input type='text' name='tabloveritxt2["+(bolge-1)+"]["+(alan-1)+"]["+(satir-1)+"]["+(sutun-1)+"]' class='tabloveritxt2' \n\
\n                     id='tabloveritxt2"+bolge+"_"+alan+"_"+satir+"_"+sutun+"' \n\
                   value='"+tdval+"' />";
    $("#tabloveri1"+bolge+"_"+alan+"_"+satir+"_"+sutun).html(txtekle);
    
    
   });
   
           
   $(document).on('keypress','.tabloveritxt2',function(e){
       if(e.which === 13){
       var idAl= $(this).attr("id").slice(13);
       var idParca = idAl.split("_");
       var bolge = idParca[0];
       var alan = idParca[1];
       var satir = idParca[2];
       var sutun = idParca[3];
       
       var duzenlenenmetin = str_kontrol($(this).val());

       
       var aval = "<input type='text' value='"+duzenlenenmetin+"' name='tabloveritxt2["+(bolge-1)+"]["+(alan-1)+"]["+(satir-1)+"]["+(sutun-1)+"]' hidden/> \n\
                   <a style='color:black' id='tablogiris2"+bolge+"_"+alan+"_"+satir+"_"+sutun+"' class='tablogiris2'>"+duzenlenenmetin+"</a>";
       $("#tabloveri1"+bolge+"_"+alan+"_"+satir+"_"+sutun).html(aval);
       }
   });
   
   
   
   var satirSayaclar2 = Create2DArrayAndFill(bolgeLimit,alanLimit);
   var satirLimit = 20;
   $(document).on('click','.satirekle',function(){
      
    var idAl= $(this).attr("id").slice(9);
    
    const idParca = idAl.split("_");
   
    var i = idParca[0];
    var j = idParca[1];
    var c = idParca[2];
    var type = idParca[3];
   if(satirSayaclar2[i-1][j-1]<satirLimit){  
    satirSayaclar2[i-1][j-1]+=1;
    var satironizleme = "";
    if(type === "0"){
    satironizleme = "";    
    for(var n=1;n<=c;n++){
        satironizleme += "<td id='tabloveri1"+i+"_"+j+"_"+satirSayaclar2[i-1][j-1]+"_"+n+"'>"
       +"<input type='text' name='tabloveritxt2["+(i-1)+"]["+(j-1)+"]["+(satirSayaclar2[i-1][j-1]-1)+"]["+(n-1)+"]' value='' hidden/>"
       +"<a id='tablogiris2"+i+"_"+j+"_"+satirSayaclar2[i-1][j-1]+"_"+n+"' class='tablogiris2'>--</a></td>";
    }
    }else if(type === "1") {
        //checkbox
        for(var n=1;n<=c;n++){
        satironizleme+="<td id='tabloverichck"+i+"_"+satirSayaclar2[i-1][j-1]+"'><input type='text' "
          + "name='tablovericheck2["+(i-1)+"]["+(j-1)+"]["+(satirSayaclar2[i-1][j-1]-1)+"]["+(n-1)+"]' value='pasif' hidden /><input type='checkbox' "
                  +"class='form-check-input' name='tablovericheck2["+(i-1)+"]["+(j-1)+"]["+(satirSayaclar2[i-1][j-1]-1)+"]["+(n-1)+"]'"
                          +"id='tablovericheck' value='aktif' /></td>";
       }
                  
    }
    $("tbody#satirlar2"+i+"_"+j).append("<tr>"+satironizleme+"</tr>");
    }
   });

});