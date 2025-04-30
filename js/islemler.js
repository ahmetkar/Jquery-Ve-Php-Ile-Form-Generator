
 function str_kontrol(value){
        let new_value = value.replace(/</g," ").replace(/>/g," ").replace(/'/g," ").replace(/"/g," ").replace(/=/g," ");
        return new_value;
  }
    
    function Create2DArray(rows) {
        var arr = [];
        for (var i=0;i<rows;i++) {
           arr[i] = [];
        }
        return arr;
      }
      
    function Create2DArrayAndFill(rows,cols){
        var arr = [];
        for (var i=0;i<rows;i++) {
           arr[i] = new Array(cols).fill(1);
        } 
        return arr;
      }



