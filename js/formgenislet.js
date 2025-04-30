$(document).ready(function(){
    var bolgesayisi = $("button.genislet").attr("id")[9];

    var b = 3;
    for(i=b;i<bolgesayisi;i++){
        $("fieldset#formbolgesi"+i).hide();
    }

    $(document).on('click','button.genislet',function(){

    if(b<=bolgesayisi){     
    j = b+3;
    for(var i=b;i<j;i++){
        $("fieldset#formbolgesi"+i).show();
    }
    b = j;
    }else {
       $(this).hide();
    }
     
    });
   
});