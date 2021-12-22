<?php
$requestedTable= $_POST['table'];
$requestedField= $_POST['what'];
$multiplier= $_POST['multiplier'];
$servername = "192.167.189.101";
$username = "web";
$password = "web4med";
$dbname = "Weather";

$sql = "SELECT ".$requestedField." FROM ".$requestedTable." ORDER BY time DESC LIMIT 1;";

$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}        

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$numrows= mysqli_num_rows($result);
$rows = array();
$rows[]=[$requestedField];  
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
