<?php
$requestedTable= $_POST['table'];
$requestedTime= $_POST['time'];
$requestedField= $_POST['what'];
$multiplier= $_POST['multiplier'];
$servername = "192.167.189.101";
$username = "web";
$password = "web4med";
$dbname = "Weather";

error_log($multiplier);

$sql = "SELECT time,".$requestedField." FROM ".$requestedTable." where time between date_sub(now(),INTERVAL 1 ".$requestedTime.") and now();";

$conn = new mysqli($servername, $username, '', $dbname);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}        

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$numrows= mysqli_num_rows($result);

$rows = array();
$table= array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'date'),
    array('label' => 'Value', 'type' => 'number'), 
    array('role' => 'tooltip', 'type' => 'string')
);
if($numrows > 0){
    for($x=0; $x < $numrows ; $x++){
        //$rows[]=mysqli_fetch_row($result);
        $res=mysqli_fetch_row($result);
        // assumes dates are patterned 'yyyy-MM-dd hh:mm:ss'
        preg_match('/(\d{4})-(\d{2})-(\d{2})\s(\d{2}):(\d{2}):(\d{2})/', $res[0], $match);
        $year = (int) $match[1];
        $month = (int) $match[2] - 1; // convert to zero-index to match javascript's dates
        $day = (int) $match[3];
        $hours = (int) $match[4];
        $minutes = (int) $match[5];
        $seconds = (int) $match[6];
	$data= str_replace(',', '', number_format($res[1] * $multiplier, 2));
        $row_format= array();
        $row_format[]= array('v' =>"Date($year, $month, $day, $hours, $minutes, $seconds)");
        $row_format[]= array('v' => $data);
        $row_format[]= array('v' => "Date: $res[0]\nValue: $data");
        $rows[]= array('c' => $row_format);
    }       
    $table['rows'] = $rows;
    echo json_encode($table, JSON_NUMERIC_CHECK);    
} else {
    echo "empty db";
}

mysqli_close($conn);
?>
