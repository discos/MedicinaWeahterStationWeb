<?php
$requestedTime= $_POST['time'];
$requestedField= $_POST['what'];
$servername = "192.167.189.101";
$username = "web";
$password = "web4med";
$dbname = "Weather";

$sql = "SELECT time,".$requestedField." FROM Hail where time between date_sub(now(),INTERVAL 1 ".$requestedTime.") and now();";

$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}        

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$numrows= mysqli_num_rows($result);
$rows = array();
$rows[]=['time',$requestedField];  
if($numrows > 0){
    for($x=0; $x < $numrows ; $x++){
        $rows[]=mysqli_fetch_row($result);              
    }       
    echo json_encode($rows, JSON_NUMERIC_CHECK);    
} else {
    echo "empty db";
}

mysqli_close($conn);
?>