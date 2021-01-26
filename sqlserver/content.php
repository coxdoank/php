<?php
include "connection/connectsql.php"; 

// $Sekarang = '17-01-2021';

$query_otodaily = "
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

$query_rk_oto = "
SELECT 
execs.project_name, execs.package_name, opers.status,
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
execs.project_name = 'RK Project'
ORDER BY opers.start_time desc
OPTION
	(RECOMPILE)
";  

$query_overdue_oto = "
SELECT 
execs.project_name, execs.package_name, opers.status,
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

$query_otodaily_summary = sqlsrv_query($conn_otomonmis01, $query_otodaily); 
$row_otodaily = sqlsrv_fetch_array($query_otodaily_summary, SQLSRV_FETCH_ASSOC);

$query_rkoto_summary = sqlsrv_query($conn_otodaymis01, $query_rk_oto); 
$row_rkoto = sqlsrv_fetch_array($query_rkoto_summary, SQLSRV_FETCH_ASSOC);

$query_overdueoto_summary = sqlsrv_query($conn_otodaymis01, $query_overdue_oto); 
$row_overdueoto = sqlsrv_fetch_array($query_overdueoto_summary, SQLSRV_FETCH_ASSOC);

if(empty($row_otodaily['package_name'])){
  $lbl_otodaily = 'Not Started';
    }elseif($row_otodaily['status_desc'] == 'Running'){
  $lbl_otodaily = 'Running';
    }elseif($row_otodaily['package_name'] == 'Insurance coverage category.dtsx' and $row_otodaily['status_desc'] == 'Succeeded'){
  $lbl_otodaily = 'Completed';       
    }

// if(empty($row_otodaily['package_name'])){
//   $lbl_otodaily = 'Daily Job Not Started';
//     }elseif($row_otodaily['status_desc'] == 'Running'){
//   $lbl_otodaily = 'Running';

//     }elseif($row_otodaily['package_name'] == 'Insurance coverage category.dtsx' and $row_otodaily['status_desc'] == 'Succeeded'){
//   $lbl_otodaily = 'Daily Job Completed - Prepare Run Next Project';

//     }elseif($row_rkoto['status_desc'] == 'Running'){
//   $lbl_otodaily = 'Running';

//     }elseif($row_rkoto['package_name'] == '00_Main_Package.dtsx' and $row_rkoto['status_desc'] == 'Succeeded'){
//   $lbl_otodaily = 'RK Job Completed - Prepare Run Next Project';      

//     }elseif($row_overdueoto['status_desc'] == 'Running'){
//   $lbl_otodaily = 'Running';

//     }elseif($row_overdueoto['package_name'] == 'SSAS Daily MoveTo.dtsx' and $row_overdueoto['status_desc'] == 'Succeeded'){
//   $lbl_otodaily = 'Completed';       
//     }

$query_sofdaily = "
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


$query_rk_sof = "
SELECT 
execs.project_name, execs.package_name, opers.status,
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
execs.project_name = 'RK Project'
ORDER BY opers.start_time desc
OPTION
	(RECOMPILE)
";  

$query_overdue_sof = "
SELECT 
execs.project_name, execs.package_name, opers.status,
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
execs.project_name = 'SOF Overdue Daily'
ORDER BY opers.start_time desc
OPTION
	(RECOMPILE)
";  

$query_sofdaily_summary = sqlsrv_query($conn_sofmonmis01, $query_sofdaily); 
$row_sofdaily = sqlsrv_fetch_array($query_sofdaily_summary, SQLSRV_FETCH_ASSOC);

$query_rksof_summary = sqlsrv_query($conn_sofdaymis01, $query_rk_sof); 
$row_rksof = sqlsrv_fetch_array($query_rksof_summary, SQLSRV_FETCH_ASSOC);

$query_overduesof_summary = sqlsrv_query($conn_sofdaymis01, $query_overdue_sof); 
$row_overduesof = sqlsrv_fetch_array($query_overduesof_summary, SQLSRV_FETCH_ASSOC);

if(empty($row_sofdaily['package_name'])){
    $lbl_sofdaily = 'Not Started';
   }elseif($row_sofdaily['status_desc'] == 'Running'){
     $lbl_sofdaily = 'Running';
    }elseif($row_sofdaily['package_name'] == 'Daily_SSAS_Merge.dtsx' and $row_sofdaily['status_desc'] == 'Succeeded'){
      $lbl_sofdaily = 'Completed'; 
    }else{
      $lbl_sofdaily = 'Wait Start Next Package'; 
    }

$query_etl1oto = "
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

$query_otodwh_summary = sqlsrv_query($conn_otodwhmis01, $query_etl1oto); 
$row_otodwh = sqlsrv_fetch_array($query_otodwh_summary, SQLSRV_FETCH_ASSOC);

if(empty($row_otodwh['package_name'])){
  $lbl_otodwh = 'Not Started';
   }elseif($row_otodwh['status_desc'] == 'Running'){
    $lbl_otodwh = 'Running';
   }elseif($row_otodwh['package_name'] == 'PKG6000000.dtsx' and $row_otodwh['status_desc'] == 'Succeeded'){
    $lbl_otodwh = 'Completed'; 
   }

$query_sofdwh_summary = sqlsrv_query($conn_sofdwhmis01, $query_etl1oto); 
$row_sofdwh = sqlsrv_fetch_array($query_sofdwh_summary, SQLSRV_FETCH_ASSOC);

if(empty($row_sofdwh['package_name'])){
  $lbl_sofdwh = 'Not Started';
   }elseif($row_sofdwh['status_desc'] == 'Running'){
    $lbl_sofdwh = 'Running';
   }elseif($row_sofdwh['package_name'] == 'PKG6000000.dtsx' and $row_sofdwh['status_desc'] == 'Succeeded'){
    $lbl_sofdwh = 'Completed'; 
   }
?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><span id="date_time"></span><script type="text/javascript">window.onload = date_time('date_time');</script></li>
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>OTO Daily</h3>

                <p><?php echo $lbl_otodaily; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>SOF Daily</h3>
                <!-- <sup style="font-size: 20px">%</sup> -->

                <p><?php echo $lbl_sofdaily; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>ETL 1 OTO</h3>

                <p><?php echo $lbl_otodwh; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>ETL 1 SOF</h3>

                <p><?php echo $lbl_sofdwh; ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ===== Job OTO Daily ===== -->

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Job OTO Daily</b> | <?php echo "Last EOD : ".$row_tblpara_oto; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_otomonmis01, $query_otodaily); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

          </div>

          <!-- ===== Job OTO Daily RK & Job OTO Daily Overdue ===== -->

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Job OTO Daily RK</b> | <?php echo "Last EOD : ".$row_tblpara_oto; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_otodaymis01, $query_rk_oto); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Job OTO Daily Overdue</b> | <?php echo "Last EOD : ".$row_tblpara_sof; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_otodaymis01, $query_overdue_oto); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div> 

          <!-- ===== Job SOF Daily & Job SOF Daily RK ===== -->

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Job SOF Daily</b> | <?php echo "Last EOD : ".$row_tblpara_oto; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_sofmonmis01, $query_sofdaily); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Job SOF Daily RK</b> | <?php echo "Last EOD : ".$row_tblpara_sof; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_sofdaymis01, $query_rk_sof); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <!-- ===== Job OTO Daily Overdue ===== -->

          <div class="col-md-6">

            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>Job SOF Daily Overdue</b> | <?php echo "Last EOD : ".$row_tblpara_sof; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_sofdaymis01, $query_overdue_sof); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>           
          <!-- ===== OTODWHMIS01 ===== -->

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>NFS Daily OTO</b> | <?php echo "Last EOD : ".$row_tblpara_otomisstg_oto; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_otodwhmis01, $query_etl1oto); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

          </div> 

          <!-- ===== SOFDWHMIS01 ===== -->

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>NFS Daily SOF</b> | <?php echo "Last EOD : ".$row_tblpara_otomisstg_sof; ?></h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th>Est Time</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn_sofdwhmis01, $query_etl1oto); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td>#</td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      <?php if($row['status_desc']=='Succeeded'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Running'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-info" style="width: 50%"></div>
                        </div>
                      <?php }elseif($row['status_desc']=='Failed'){ ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </td>
                      <?php } ?>
                      <td><?php echo $row['elapsed_time_min'] ?> Min</td>
                      <td>
                      <!-- <span class="badge bg-danger"><?php echo $newDate; ?></span> -->
                      <?php echo $row['status_desc'] ?>
                    </td>
                    </tr>
                    <?php $no++; } ?> 
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->

          </div>  
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->