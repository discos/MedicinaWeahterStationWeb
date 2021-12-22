function drawHail(p_container,p_time,p_field) {
   var jsonHail =$.ajax({
       url: "dbHail.php",   
       type: 'POST',  
       dataType:"json",
       data:{
               time: p_time,
               what: p_field
            },
       async: false          
    });
       
    //debugger;
    //console.log(jsonHail);
    jsonHail=  JSON.parse(jsonHail.responseText);            
    // Define the chart to be drawn.
    var table = new google.visualization.arrayToDataTable(jsonHail);
    console.log(table);    
    // Set chart options
    var options = {
       title: p_field,
       curveType: 'function',
       legend: 'none'               
    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.LineChart(document.getElementById(p_container));
    chart.draw(table, options);
 }
