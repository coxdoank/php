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
ORDER BY (
  CASE e.package_name
  WHEN 'Daily_Staging 4g New.dtsx'
  THEN 1
  WHEN 'Daily SSAS.dtsx'
  THEN 2
  WHEN 'Upload Target BDV.dtsx'
  THEN 3
  WHEN 'Upload Approve BDV.dtsx'
  THEN 4
  WHEN 'Upload Brand Master.dtsx'
  THEN 5
  WHEN 'Upload Brand Detail.dtsx'
  THEN 6
  WHEN 'Upload Segment Group.dtsx'
  THEN 7
  WHEN 'Insurance coverage category.dtsx'
  THEN 8    
  END
) asc
OPTION
	(RECOMPILE)



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
ORDER BY (
  CASE e.package_name
  WHEN 'Daily_Staging.dtsx'
  THEN 1
  WHEN 'Daily_Staging 2.dtsx'
  THEN 2
  WHEN 'Daily_Staging_Merge.dtsx'
  THEN 3
  WHEN 'Daily_SSAS_Merge.dtsx'
  THEN 4
  WHEN 'Daily Upload Supplier.dtsx'
  THEN 5
  END
) asc
OPTION
	(RECOMPILE)



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
ORDER BY (
  CASE e.package_name
  WHEN 'MainPrsgDay.dtsx'
  THEN 1
  WHEN 'MainContainer.dtsx'
  THEN 2
  WHEN 'main_etl1_a.dtsx'
  THEN 3
  WHEN 'PKG1000000.dtsx'
  THEN 4
  WHEN 'PKG2000001.dtsx'
  THEN 5
  WHEN 'PKG4000002.dtsx'
  THEN 6
  WHEN 'PKG3000000.dtsx'
  THEN 7
  WHEN 'PKG6000000.dtsx'
  THEN 8
  END
) asc
OPTION
	(RECOMPILE)


    
            