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

$Time           = date("h:i a"); 
// echo $Time;

// ===== Connect ke OTOMONMIS01 dan OTODAYMIS01 =====

$svr_otomonmis01 = "OTOMONMIS01";
$conninfo_otomonmis01 = array( "Database"=>"SSISDB", "UID"=>"", "PWD"=>"");
$conn_otomonmis01 = sqlsrv_connect($svr_otomonmis01, $conninfo_otomonmis01);

if(!$conn_otomonmis01){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$svr_otodaymis01 = "OTODAYMIS01";
$conninfo_otodaymis01 = array( "Database"=>"SSISDB", "UID"=>"", "PWD"=>"");
$conn_otodaymis01 = sqlsrv_connect($svr_otodaymis01, $conninfo_otodaymis01);

if(!$conn_otodaymis01){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$conn_otomonmis01_tbl_para = sqlsrv_connect("OTODAYMIS01", array("Database"=>"Solos4G"));
$solos4g_tbl_para_oto = "
SELECT last_eod_date=CONVERT(varchar, MAX(ParaDate), 105)
FROM solos4g.dbo.tr_TblPara
WHERE ParaType = 'EOD' and ParaSeq = 1
";
$stmt = sqlsrv_query($conn_otomonmis01_tbl_para, $solos4g_tbl_para_oto);
$row_tblpara_oto = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$row_tblpara_oto = $row_tblpara_oto['last_eod_date'];

// ===== Connect ke SOFMONMIS01 dan SOFDAYMIS01 =====

$svr_sofmonmis01 = "SOFMONMIS01";
$conninfo_sofmonmis01 = array( "Database"=>"SSISDB", "UID"=>"", "PWD"=>"");
$conn_sofmonmis01 = sqlsrv_connect($svr_sofmonmis01, $conninfo_sofmonmis01);

if(!$conn_sofmonmis01){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$svr_sofdaymis01 = "SOFDAYMIS01";
$conninfo_sofdaymis01 = array( "Database"=>"SSISDB", "UID"=>"", "PWD"=>"");
$conn_sofdaymis01 = sqlsrv_connect($svr_sofdaymis01, $conninfo_sofdaymis01);

if(!$conn_sofdaymis01){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$conn_sofdaymis01_tbl_para = sqlsrv_connect("SOFDAYMIS01", array("Database"=>"Solos4G"));
$solos4g_tbl_para_sof = "
SELECT last_eod_date=CONVERT(varchar, MAX(ParaDate), 105)
FROM solos4g.dbo.tr_TblPara
WHERE ParaType = 'EOD' and ParaSeq = 1
";
$stmt = sqlsrv_query($conn_sofdaymis01_tbl_para, $solos4g_tbl_para_sof);
$row_tblpara_sof = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$row_tblpara_sof = $row_tblpara_sof['last_eod_date'];

// ===== Connect ke OTODWHMIS01 =====

$svr_otodwhmis01 = "OTODWHMIS01";
$conninfo_otodwhmis01 = array( "Database"=>"SSISDB", "UID"=>"", "PWD"=>"");
$conn_otodwhmis01 = sqlsrv_connect($svr_otodwhmis01, $conninfo_otodwhmis01);

if(!$conn_otodwhmis01){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$conn_otodwhmis01_tbl_para = sqlsrv_connect("OTODWHMIS01", array("Database"=>"OTO_MIS_STG"));
$otomisstg_tblpara_oto = "
select last_eod_date=convert(varchar, [CURRENT_DATE], 105)
FROM [common].[JOB_CONTROL]
where ETL_ID = 'ETL1_01'
";
$stmt = sqlsrv_query($conn_otodwhmis01_tbl_para, $otomisstg_tblpara_oto);
$row_tblpara_otomisstg_oto = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$row_tblpara_otomisstg_oto = $row_tblpara_otomisstg_oto['last_eod_date'];

// ===== Connect ke SOFDWHMIS01 =====

$svr_sofdwhmis01 = "SOFDWHMIS01";
$conninfo_sofdwhmis01 = array( "Database"=>"SSISDB", "UID"=>"", "PWD"=>"");
$conn_sofdwhmis01 = sqlsrv_connect($svr_sofdwhmis01, $conninfo_sofdwhmis01);

if(!$conn_sofdwhmis01){
    echo "Connection could not be established <br>";
    die(print_r(sqlsrv_errors(), true));
}

$conn_sofdwhmis01_tbl_para = sqlsrv_connect("SOFDWHMIS01", array("Database"=>"OTO_MIS_STG"));
$otomisstg_tblpara_sof = "
select last_eod_date=convert(varchar, [CURRENT_DATE], 105)
FROM [common].[JOB_CONTROL]
where ETL_ID = 'ETL1_01'
";
$stmt = sqlsrv_query($conn_sofdwhmis01_tbl_para, $otomisstg_tblpara_sof);
$row_tblpara_otomisstg_sof = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$row_tblpara_otomisstg_sof = $row_tblpara_otomisstg_sof['last_eod_date'];

?>