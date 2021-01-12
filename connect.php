<?php
$serverName = "DESKTOP-G7RN3PM";
$connectionInfo = array( "Database"=>"Employee");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if($conn){
    echo "Connection Established <br>";
}else{
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$tsql = "SELECT FirstName, LastName, Email FROM tblContact";  
$stmt = sqlsrv_query( $conn, $tsql); 
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  
{  
     echo "Col1: ".$row[0]."\n";  
     echo "Col2: ".$row[1]."\n";  
     echo "Col3: ".$row[2]."<br>\n";  
}  

?>