function getLastValue(p_table,p_field, p_multiplier) {

   var _multiplier= p_multiplier || 1;
   console.log(_multiplier);

   var jsonValue =$.ajax({
       url: "dbLastOne.php",   
       type: 'POST',  
       dataType:"json",
       data:{
               table: p_table,
               what: p_field,
	       multiplier: _multiplier
            },
       async: false          
    });
       
    //debugger;
    //console.log(jsonWind);
    jsonValue=  JSON.parse(jsonValue.responseText);            
    console.log(jsonValue);
    
    // [0] nome campo
    // [1] valore
    return (jsonValue[1]* _multiplier).toFixed(2);
 }
