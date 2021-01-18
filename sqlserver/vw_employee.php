<?php
include "connection/connectsql.php"; 

$tsql = "SELECT [project_name]
,[package_name]
,[project_lsn]
,[status]
,[status_desc]
,[start_time]
,[end_time]
,[elapsed_time_min] FROM ssis";  
// $stmt = sqlsrv_query( $conn, $tsql); 
// while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC))  
// {  
//      echo "Col1: ".$row[0]."\n";  
//      echo "Col2: ".$row[1]."\n";  
//      echo "Col2: ".$row[2]."\n";  
//      echo "Col2: ".$row[3]."\n";  
//      echo "Col2: ".$row[4]."\n";  
//      echo "Col2: ".$row[5]."\n";  
//      echo "Col2: ".$row[6]."\n";  
//      echo "Col3: ".$row[2]."<br>\n";  
// }  

?>

<table class="table table-bordered">
     <thead>
     <tr>
          <th style="width: 10px">#</th>
          <th>Project Name</th>
          <th>Package</th>
          <th style="width: 40px">Status</th>
     </tr>
     </thead>
     <tbody>
<?php 
$stmt = sqlsrv_query( $conn, $tsql); 
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) 
$no = 1;
{ 
?>     
     <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row[0] ?></td>
          <td>
          <div class="progress progress-xs">
               <div class="progress-bar bg-warning" style="width: 70%"></div>
          </div>
          </td>
          <td><span class="badge bg-warning">70%</span></td>
     </tr>
<?php $no++; } ?>     
     </tbody>
</table>