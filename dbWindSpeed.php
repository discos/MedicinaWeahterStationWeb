<?php
$requestedTime= $_POST['time'];
$servername = "192.167.189.101";
$username = "web";
$password = "web4med";
$dbname = "Weather";

$sql = "SELECT time,wind_speed_ave,wind_dir_ave FROM Wind where time between date_sub(now(),INTERVAL 1 ".$requestedTime.") and now();";

$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}        


//$sql = "SELECT time,wind_speed_ave FROM Wind  WHERE time>0;"
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$numrows= mysqli_num_rows($result);
$rows = array();
$rows[]=['time','speed','direction'];  
if($numrows > 0){
    for($x=0; $x < $numrows ; $x++){
        $rows[]=mysqli_fetch_row($result);              
	$rows[1]= $rows[1]*3.6;
    }       
    echo json_encode($rows, JSON_NUMERIC_CHECK);    
} else {
    echo "empty db";
}




/* $fake={  cols: [{id: 'task', label: 'Task', type: 'string'},
{id: 'hours', label: 'Hours per Day', type: 'number'}],
rows: [{c:[{v: 'Work'}, {v: 11}]},
{c:[{v: 'Eat'}, {v: 2}]},
{c:[{v: 'Commute'}, {v: 2}]},
{c:[{v: 'Watch TV'}, {v:2}]},
{c:[{v: 'Sleep'}, {v:7, f:'7.000'}]}]
}; */

//$fake= array("MDB"=>10, "EDB"=>5, "GR"=>15);
//echo json_encode($fake);

mysqli_close($conn);
?>
