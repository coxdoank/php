<?php
# Define Varibael Default
date_default_timezone_set('Asia/Jakarta');

$Year			= date("Y");
$nxyear		  	= $Year+1;
$lsyear  		= $Year-1;
$Month   		= date("m");
$Month_Name 	= date("M");
$Date			= date("d");
$LsDate		  	= $Date-1;

$Sekarang		= date("d-m-Y");
$Kemarin		= date("$LsDate-m-Y");
$BulanBerjalan	= date("M-Y");

$YeadMonth	    = date("Y-m");
$YeadMonthDateLs= date("Y-m-$LsDate");
$YeadMonthDate  = date("Y-m-d");
$LastWeek		= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
$Tommorow		= date("Y-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));

$serverName = "DESKTOP-G7RN3PM";
$connectionInfo = array("Database"=>"MISMonitor");
$conn = sqlsrv_connect($serverName, $connectionInfo);

if(!$conn){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}
?>