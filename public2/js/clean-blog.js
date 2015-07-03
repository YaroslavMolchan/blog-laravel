// My Scripts
function toTranslit(text) {
    return text.replace(/([а-яёіїєЄэ])|([\s_-])|([^a-z\d])/gi,
        function(all, ch, space, words, i) {
            if (space || words) {
                return space ? '_' : '';
            }
            var code = ch.charCodeAt(0),
                index = code == 1025 || code == 1105 ? 0 : code > 1071 ? code - 1071 : code - 1039,
                t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                    'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                    'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                    'shch', '', 'y', '', 'e', 'yu', 'ya',
                    '', '', '', '', 'ye', '', 'i', 'yi'
                ];
            if (ch.charCodeAt(0) == 1028)
                return 'Ye';
            if (ch.charCodeAt(0) == 1030)
                return 'I';
            if (ch.charCodeAt(0) == 1031)
                return 'Yi';
            //alert(code);
            return t[index];
        });
}

function placeholderIsSupported() {
	var test = document.createElement('input');
	return ('placeholder' in test);
}
$(function() {
	if (placeholderIsSupported()) {
		$(".control-label").not(".visible").hide();
	}
	
    $(document).on('click', '.ajaxRequest', function(ev) {
        ev.preventDefault();
        var url = $(this).attr('href');
		bootbox.confirm("Вы хотите выполнить данное действие?", function(result) {
			if (result == true) {
				$.post(url, function(data) {
						if (data.updateList){
							//$.fn.yiiListView.update(data.updateList);
                            alert(1);
                            $.pjax.reload({container:'#comments'});
						}
						if (data.notify) {
							//$.notify(data.notify, "info");
						}
						else {
							//$.notify("Действие выполнено успешно!", "info");
						}
                    alert(2);
				}, 'json');
			} else {
				  //$.notify("Действие отменено!", "error");
			}
            alert(3);
		}); 
	});
	
    $('.modal').on('click', '.sendModalForm', function(ev) {
        ev.preventDefault();
        var form = $(this).closest('form')[0];
        var data = new FormData(form);
        $.ajax({
            'url': $(form).attr('action'),
            'data': data,
            'type': "POST",
            'dataType': "json",
            'processData': false,
            'contentType': false,
            'success': function(data) {
                if (data.status=="success"){
                    $('.modal').modal('hide');
					if (data.notify) {
						$.notify(data.notify, "info");
                    }
					
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                    else if (data.reload){
                        window.location.reload();
                    }
                    else if (data.updateList){
                        $.fn.yiiListView.update(data.updateList);
                    }
                    else if (data.updateGrid){
                        $.fn.yiiGridView.update(data.updateGrid);
                    }
                }
                else {
                    $(".errorMessage").hide(); 
                    $.each(data, function(key, val) {                                               
                    $("#"+key+"_em_").text(val);                                                    
                    $("#"+key+"_em_").show();
                    });
                }
            },
        });
    });
	
    $(document).on('click', '.getForm', function(ev) {
        ev.preventDefault();
        var url = $(this).attr('href');
        var modal = $('.modal');
        $.post(url, function(data) {
            modal.html(data).modal('show');
			if (placeholderIsSupported()) {
				$(".control-label").not(".visible").hide();
			}
        });
    });
});

// Contact Form Scripts
$(function() {
    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

// Floating label headings for the contact form
$(function() {
    $("body").on("input propertychange", ".floating-label-form-group", function(e) {
        $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
    }).on("focus", ".floating-label-form-group", function() {
        $(this).addClass("floating-label-form-group-with-focus");
    }).on("blur", ".floating-label-form-group", function() {
        $(this).removeClass("floating-label-form-group-with-focus");
    });
});

// Navigation Scripts to Show Header on Scroll-Up
jQuery(document).ready(function($) {
    var MQL = 1170;

    //primary navigation slide-in effect
    if ($(window).width() > MQL) {
        var headerHeight = $('.navbar-custom').height();
        $(window).on('scroll', {
                previousTop: 0
            },
            function() {
                var currentTop = $(window).scrollTop();
                //check if user is scrolling up
                if (currentTop < this.previousTop) {
                    //if scrolling up...
                    if (currentTop > 0 && $('.navbar-custom').hasClass('is-fixed')) {
                        $('.navbar-custom').addClass('is-visible');
                    } else {
                        $('.navbar-custom').removeClass('is-visible is-fixed');
                    }
                } else {
                    //if scrolling down...
                    $('.navbar-custom').removeClass('is-visible');
                    if (currentTop > headerHeight && !$('.navbar-custom').hasClass('is-fixed')) $('.navbar-custom').addClass('is-fixed');
                }
                this.previousTop = currentTop;
            });
    }
});
