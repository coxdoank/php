<?php  
$serverName     = "DESKTOP-G7RN3PM"; 
$uid            = "";   
$pwd            = "";  
$databaseName   = "Employee"; 

$connectionInfo = array( "UID"=>$uid,                            
                         "PWD"=>$pwd,                            
                         "Database"=>$databaseName); 

/* Connect using SQL Server Authentication. */  
$conn = sqlsrv_connect( $serverName, $connectionInfo);  

$tsql = "SELECT FirstName, LastName, Email FROM tblContact";  

/* Execute the query. */  

$stmt = sqlsrv_query( $conn, $tsql);  

if ( $stmt )  
{  
     echo "Statement executed.<br>\n";  
}   
else   
{  
     echo "Error in statement execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
}  

/* Iterate through the result set printing a row of data upon each iteration.*/  

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  
{  
     echo "Col1: ".$row[0]."\n";  
     echo "Col2: ".$row[1]."\n";  
     echo "Col3: ".$row[2]."<br>\n";  
}  

/* Free statement and connection resources. */  
sqlsrv_free_stmt( $stmt);  
sqlsrv_close( $conn);  
?>  