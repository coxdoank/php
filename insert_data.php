<?php
//koneksi sql server
$Server	      = "otobi04\sql2019";
$Database     = array("Database"=>"SSISDB");
$connection	  = sqlsrv_connect($Server, $Database);

$query01 = "
SELECT 
	e.project_name,
	e.package_name,
	e.project_lsn,
	e.status, 
	status_desc = CASE e.status 
						WHEN 1 THEN 'Created'
						WHEN 2 THEN 'Running'
						WHEN 3 THEN 'Cancelled'
						WHEN 4 THEN 'Failed'
						WHEN 5 THEN 'Pending'
						WHEN 6 THEN 'Ended Unexpectedly'
						WHEN 7 THEN 'Succeeded'
						WHEN 8 THEN 'Stopping'
						WHEN 9 THEN 'Completed'
					END,
	CONVERT(datetime, e.start_time) as start_time,
	CONVERT(datetime, e.end_time) as end_time,
	elapsed_time_min = datediff(mi, e.start_time, e.end_time)
FROM 
	catalog.executions e 
WHERE 
e.project_name LIKE '%' AND
e.package_name LIKE '%' AND
e.execution_id = ISNULL(NULL, e.execution_id) 
--e.end_time = @paradate
ORDER BY 
	e.execution_id DESC
OPTION
	(RECOMPILE)
";

// $stmt01 = sqlsrv_query($connection, $query01);
// // works  
$stmt01 = sqlsrv_query($connection, $query01, array(), array("Scrollable"=>"buffered")); 
$count  = sqlsrv_num_rows($stmt01);
// echo $count;

for ($j=0; $j < $count; $j++) {
    
    $row = sqlsrv_fetch_array($stmt01, SQLSRV_FETCH_NUMERIC);

    $row5 = date_format($row[5], 'Y-m-d');
    $row6 = date_format($row[6], 'Y-m-d');        
    $insertSQL = "INSERT INTO ssis_job (project_name, package_name, project_lsn, status, status_desc, start_time, end_time, elapsed_time_min) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row5', '$row6', '$row[7]')";

    $Server01	   = "sofbi01";
    $Database02    = array("Database"=>"MisMonitor");
    $connection02  = sqlsrv_connect($Server01, $Database02);
    $stmt01 = sqlsrv_query( $connection02, $insertSQL);    

}
    
// while($row = sqlsrv_fetch_array($stmt01, SQLSRV_FETCH_NUMERIC))  
// {  
//     $row5 = date_format($row[5], 'Y-m-d');
//     $row6 = date_format($row[6], 'Y-m-d');
//     $insertSQL = "INSERT INTO ssis_job (project_name, package_name, project_lsn, status, status_desc, start_time, end_time, elapsed_time_min) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row5', '$row6', '$row[7]')";

//     $Server01	   = "sofbi01";
//     $Database02    = array("Database"=>"MisMonitor");
//     $connection02  = sqlsrv_connect($Server01, $Database02);
//     $stmt01 = sqlsrv_query( $connection02, $insertSQL);    

//     var_dump($insertSQL);
//      echo $row[0]."\n";  
//      echo $row[1]."\n";  
//      echo $row[2]."\n"; 
//      echo $row[3]."\n"; 
//      echo $row[4]."\n";   
//      echo date_format($row[5], 'Y-m-d')."\n";
//      echo date_format($row[6], 'Y-m-d')."\n";     
//      echo $row[7]."<br>\n";  
// }



// 	while (!feof($num_columns1)) { 
// 	  $insertSQL = sprintf("INSERT INTO ssis_job (project_name, package_name, project_lsn, status, status_desc, start_time, end_time, elapsed_time_min) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
// 						   GetSQLValueString($fld10[0]->value, "text"),
//                            GetSQLValueString($fld10[1]->value, "text"),
//                            GetSQLValueString($fld10[2]->value, "text"),
//                            GetSQLValueString($fld10[3]->value, "text"),
//                            GetSQLValueString($fld10[4]->value, "text"),
//                            GetSQLValueString($fld10[5]->value, "datetime"),
//                            GetSQLValueString($fld10[6]->value, "datetime"),
//                            GetSQLValueString($fld10[7]->value, "int")
//                         );
    
// $stmt01 = sqlsrv_query( $connection02, $insertSQL);                     
// $rs1->MoveNext(); 
// }
// 	  mysql_select_db($database_ITSMMS, $con);
// 	  $Result2 = mysqli_query($insertSQL, $con) or die(mysqli_error());
// 	  $rs1->MoveNext(); 
// 	};
?>