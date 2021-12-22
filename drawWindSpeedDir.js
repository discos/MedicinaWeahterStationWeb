function drawWindSpeedDir(p_container,p_time) {

   console.log(p_container);
   console.log(p_time);

   var JsonWindSpeed =$.ajax({
       url: "dbWindSpeed.php",   
       type: 'POST',  
       dataType:"json",
       data:{time: p_time},
       async: false          
    });
       
    //debugger;
    console.log(JsonWindSpeed);
    JsonWindSpeed=  JSON.parse(JsonWindSpeed.responseText);            

    // Define the chart to be drawn.
    var tableWindSpeed = new google.visualization.arrayToDataTable(JsonWindSpeed);                             
    // Handle wind direction in a new table
    //var tableSpeedRotation= new google.visualization.DataTable();
    //tableSpeedRotation.addColumn('string', 'date');
    //tableSpeedRotation.addColumn('number', 'speed');
    //tableSpeedRotation.addColumn({type: 'string', role: 'style'});   
    //tableSpeedRotation.addRows(tableWindSpeed.getNumberOfRows());
    // Copy data to new table         
    //for(var i=0, maxrows= tableWindSpeed.getNumberOfRows(); i<maxrows; i++){
    //   tableSpeedRotation.setValue(i,0, tableWindSpeed.getValue(i,0));
    //   tableSpeedRotation.setValue(i,1, tableWindSpeed.getValue(i,1));
    //   var rotation= tableWindSpeed.getValue(i,2);
    //   tableSpeedRotation.setValue(i,2,`point { shape-rotation: ${rotation}; shape-type: triangle;}`);
    //}
    //console.log(tableSpeedRotation);
    // Set chart options
    var options = {
       title:'Wind Speed And Direction',
       curveType: 'function',
       vAxes: {
               0: {
                  ticks:[0,5,10,15,25,30],
                  title: 'Speed'
               },
               1: {
                  max:360,
                  min:0,
                  title: 'Direction'
               }
               },
       legend: 'none'               
    };

    // Instantiate and draw the chart.
    var chartWindSpeed = new google.visualization.LineChart(document.getElementById(p_container));
    chartWindSpeed.draw(tableWindSpeed, options);
 }
