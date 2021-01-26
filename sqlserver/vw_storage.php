<?php
/*
* PHP Probe for PRTG Network Monitor (https://www.paessler.com/prtg)
* With this script you can monitor the diskspace of a php-enabled webserver with PRTG Network Monitor
*                  
*    - Copy the script below into a folder of your web server that is configured to run PHP scripts (e.g. /yourpath)
*    - Edit the $username and $password constants below to your liking
*    - Test the script by calling it in a web browser, e.g. 
*
*		http://yourserver/yourpath/prtgphpprobe.php?drive=C:&user=myuser&pass=mypass
*
*    - In the URL, replace the "drive" value C: with the according value: 
*
*		Windows server	The drive letter you want to monitor, followed by a colon
*		Linux server	The path you want to monitor, for example / for root
*
*    - In the URL, replace myuser and mypass by the values you entered in the script.
*    - As soon as the script returns the desired values, you can add it as a HTTP Content sensor in PRTG. 
*
*	 - See /en/topic/1023 for more details.
*
* date: 2010-02-18
* author: Daniel Zobel
* requires: PHP 4.x
*
* (c) 2010 by Paessler AG, www.paessler.com
*/

/* ***************************************************************************************
   L O G I N   C O N F I G U R A T I O N
*************************************************************************************** */
$username    = 'harry.handoko';
$password    = '';

/* No need to change parameters after this line 
*************************************************************************************** */
echo("<html><head><title>PRTG Network Monitor PHP Probe</title></head><body>");

/* Catch Parameters From URL */
   $user = $_GET["user"];
   $pass = $_GET["pass"];
   $drive = $_GET["drive"];

/* Check Login */
   if ($username<>$user) {
       echo("Sorry, user '".$user."' does not exist here...");
   } else if ($password<>$pass) {
       echo("Sorry, your password is incorrect...");
   } else if (is_dir($drive)) {

/* Get Disk Data */
   $freespace          = disk_free_space($drive);
   $total_space        = disk_total_space($drive);
   $percentage_free    = $freespace ? round($freespace / $total_space, 2) * 100 : 0;
   
/* Show in HTML */
        echo("<b>".$drive."</b> has [".$percentage_free."] % free diskspace<br>");
        echo("<b>".$drive."</b> has [".round($freespace/1024/1024)."] MB free diskspace<br>");
   } else {
        echo("Sorry, <b>".$drive."</b> does not exist here...");
   };
echo("</body></html>");
?>