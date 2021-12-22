function drawField(p_container,p_table, p_time, p_field, p_multiplier) {

   var _multiplier= p_multiplier || 1;
   console.log(_multiplier);

   var jsonWind =$.ajax({
       url: "dbField.php",   
       type: 'POST',  
       dataType:"json",       	
       data:{
               table: p_table,
               time: p_time,
               what: p_field,
	       multiplier: _multiplier
            },
       async: false          
    });
       
    //debugger;
    //console.log(jsonWind);
    jsonWind=  JSON.parse(jsonWind.responseText);    

    // Define the chart to be drawn.
    var table = new google.visualization.DataTable(jsonWind);    

    console.log(table);    
        
    // Set chart options
    var options = {       
       curveType: 'function',  
       legend: 'none',
       chartArea:{
          left:150,
          top:50,
          width:'80%',
          height:'65%'
         },
       vAxis: { 
         viewWindowMode: 'maximized' 
         },   
       hAxis:{
          format:'yyyy-MM-dd HH:mm',
          slantedText:true,
          slantedTextAngle:30,
       }
    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.LineChart(document.getElementById(p_container));
    chart.draw(table, options);
 }
