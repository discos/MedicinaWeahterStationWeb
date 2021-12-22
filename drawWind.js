function drawWind(p_container,p_time,p_field) {
   var jsonWind =$.ajax({
       url: "dbWind.php",   
       type: 'POST',  
       dataType:"json",
       data:{
               time: p_time,
               what: p_field
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
       title: p_field,
       curveType: 'function',
       legend: 'none',
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
