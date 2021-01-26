<?php
//koneksi sql server
$Server	      = "otodaymis01";
$Database     = array("Database"=>"SSISDB");
$connection	  = sqlsrv_connect($Server, $Database);

// $Sekarang = '26-01-2021';
$Sekarang = date("d-m-Y");

$sql = "
SELECT 
execs.project_name, execs.package_name, execs.project_lsn, opers.status,
status_desc = CASE opers.status 
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
opers.start_time, opers.end_time,
elapsed_time_min = datediff(mi, opers.start_time, opers.end_time)
FROM internal.executions AS execs INNER JOIN
internal.operations AS opers ON execs.execution_id = opers.operation_id AND
convert(varchar,opers.start_time, 105) = '$Sekarang' AND
execs.project_name = 'SSIS Overdue Daily'
ORDER BY opers.start_time desc
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