function validate(){
	var FN = $('input[name=FN]');
	var LN = $('input[name=LN]');
	var ST = $('input[name=ST]');
	var CT = $('input[name=CT]');
	var ZP = $('input[name=ZP]');
	var SA = $('input[name=SA]');
	var CN = $('select[name=CN]');
	var Code = $('input[name=Code]');
	var stat;
	if(FN.val() == ''){ FN.addClass("merror2"); stat = false; }   
	if(LN.val() == ''){ LN.addClass("merror2"); stat = false; }  
	if(ST.val() == ''){ ST.addClass("merror"); stat = false; }   
	if(CT.val() == ''){ CT.addClass("merror3"); stat = false; }   
	if(ZP.val() == ''){ ZP.addClass("merror3"); stat = false; }  
	if(SA.val() == ''){ SA.addClass("merror3"); stat = false; }   
	if(CN.val() == ''){ CN.addClass("merror"); stat = false; }  
	if(Code.val().toUpperCase() != '5YGFJ'){ Code.addClass("merror"); stat = false; }   
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


