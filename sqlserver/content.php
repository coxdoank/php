<?php
include "connection/connectsql.php"; 

$tsql_otodaily = "SELECT project_name
,package_name
,project_lsn
,status
,status_desc
,start_time
,end_time
,elapsed_time_min FROM ssis
where convert(varchar, start_time, 105) = '17-01-2021'
ORDER BY (
    CASE package_name
    
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
) asc";  
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
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

                <p>Complete</p>
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

                <p>Complete</p>
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

                <p>Complete</p>
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

                <p>Complete</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">OTO Daily</h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn, $tsql_otodaily); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td><?php echo $no; ?></td>
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

          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">SOF Daily</h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Package Name</th>
                      <th>Progress</th>
                      <th style="width: 40px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php 
                    $stmt = sqlsrv_query($conn, $tsql_otodaily); 
                    $no = 1;
                    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                    {
                    $newDate = $row['start_time']->format('d/m/Y'); // for example
                    ?>                     
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row['package_name']; ?></td>
                      <td>
                      
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                        </div>
                      </td>
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