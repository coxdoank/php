<?php
//koneksi sql server
$Server	      = "sofmonmis01";
$Database     = array("Database"=>"SSISDB");
$connection	  = sqlsrv_connect($Server, $Database);

// $Sekarang = '26-01-2021';
$Sekarang = date("d-m-Y");

$sql = "
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
AND convert(varchar,e.start_time, 105) = '$Sekarang'
ORDER BY start_time desc
OPTION
	(RECOMPILE)
";

$stmt = sqlsrv_query($connection, $sql);
if($stmt === false){ die(print_r(sqlsrv_errors(), true)); }

// SQLSRV_FETCH_ASSOC - use with field name
// SQLSRV_FETCH_NUMERIC - use with no 

while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
	$row5 = date_format($row['start_time'], 'Y-m-d H:i:s');
	$row6 = date_format($row['end_time'], 'Y-m-d H:i:s');	
	$insertSQL = "INSERT INTO ssis_job (project_name, package_name, project_lsn, status, status_desc, start_time, end_time, elapsed_time_min) VALUES ('$row[project_name]', '$row[package_name]', '$row[project_lsn]', '$row[status]', '$row[status_desc]', '$row5', '$row6', '$row[elapsed_time_min]')";
	print_r($insertSQL);
    $Server01	   = "sofbi01";
    $Database02    = array("Database"=>"MisMonitor");
    $connection02  = sqlsrv_connect($Server01, $Database02);
	$stmt01 	   = sqlsrv_query($connection02, $insertSQL);
	if($stmt01 === false){ die(print_r(sqlsrv_errors(), true)); }
}
?>