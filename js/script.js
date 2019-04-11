// dao nguoc
$(document).ready(function(){
	var body = $('body');
		

			$('.has-matchHeight', body).matchHeight();
});


$(document).ready(function(){
	$(".more-content").click(function(){
		$(".cut-gradient").fadeToggle();
	});
	$(".down-icon").click(function(){
		$(".st-description").fadeToggle();
	});
	$(".down-icon").click(function(){
		$(this).toggleClass('icondaonguoc');
	});
});
$(document).ready(function(){
	$(".down-icon1").click(function(){
		$(this).toggleClass('icondaonguoc');
	});
	$(".down-icon1").click(function(){
		$(".facilities").fadeToggle();
	});
});
$(document).ready(function(){
	$(".down-icon2").click(function(){
		$(this).toggleClass('icondaonguoc');
	});
	$(".down-icon2").click(function(){
		$(".roomsm").fadeToggle();
		$(".roomlg").fadeToggle();
	});
});

// end dao nguoc
$(function() {
	$('.btn-like').click(function(event) {
		/* Act on the event */
		$(this).addClass('daonguoc');
		$(this).next().slideToggle();
		// $(this).children().css( "transform", "rotate(180deg)");
	});

});
$(function() {
	$('.heading').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
		// $(this).children().css( "transform", "rotate(180deg)");
	});
});
$(function() {
	$('.dangky').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
		// $(this).children().css( "transform", "rotate(180deg)");
	});
});
$(document).ready(function(){
	$('.menu1').click(function(){
		$('nav').toggleClass('open'); 
	});
	$('.fa.fa-angle-left').click(function(){
		$('nav').removeClass('open'); });
})
$(document).ready(function(){
	$('.chodeformdangki').slideUp();
	var stt=0;
	$("img .slide").each(function(){
		if($(this).is(':visible'))
			stt=$(this).attr("stt");
	});
	$("#next").click(function()
	{
		next= ++stt;
		$(" img .slide").hide();
		$(" img .slide").eq(next).show();
	});
});
// cho de dang ki
$(function() {
	$('.bookphong').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
	});

});

//hết form chạy
// date
$(function() {

	$('input[name="datetimes"]').daterangepicker({
		opens:'left',
		"autoApply": true,
		startDate: moment().startOf('hour'),
		endDate: moment().startOf('hour').add(32, 'hour'),
		locale: {
			format: 'M/DD/YYYY'
		}
	});
});

$(window).scroll(function () {
    if ($(window).scrollTop() >= 611) {
        $('.widget').addClass('fixed');
    } 
    if ($(window).scrollTop() >= 2500) {
        $('.widget').removeClass('fixed');
    }
     if ($(window).scrollTop() < 611) {
        $('.widget').removeClass('fixed');
    }
});
$(window).scroll(function () {
    if ($(window).scrollTop() >= 611) {
        $('.widgetroom').addClass('fixed');
    } 
    if ($(window).scrollTop() >= 2500) {
        $('.widgetroom').removeClass('fixed');
    }
     if ($(window).scrollTop() < 611) {
        $('.widgetroom').removeClass('fixed');
    }
});
// guests
jQuery(document).ready(function($){
/* People minus-add */
$('.gmz-number-wrapper').each(function () {
	var timeOut = 0;
	var t = $(this);
	var input = t.find('input');
	var min = input.data('min');
	var max = input.data('max');
 	//Change room value
 	$('input[name="number_room"]', t).change(function () {
 		var rooms = parseInt($(this).val());
 		var html   = rooms;
 		if (typeof rooms == 'number') {
 			if (rooms < 2) {
 				html = rooms + ' Room';
 			} else {
 				html = rooms + ' Rooms';
 			}
 		}
 		$('.people-inner .room').html(html);
 	});
 	$('input[name="number_room"]', t).trigger('change');

	//Change adult value
	$('input[name="number_adult"]', t).change(function () {
		var adults = parseInt($(this).val());
		var html   = adults;
		if (typeof adults == 'number') {
			if (adults < 2) {
				html = adults + ' Adult';
			} else {
				html = adults + ' Adults';
			}
		}
		$('.people-inner .adult').html(html);
	});

	$('input[name="number_adult"]', t).trigger('change');

	//Change adult value
	$('input[name="number_child"]', t).change(function () {
		var childs = parseInt($(this).val());
		var html   = childs;
		if (typeof childs == 'number') {
			if (childs < 2) {
				html = childs + ' Children';
			} else {
				html = childs + ' Childrens';
			}
		}
		$('.people-inner .child').html(html);
	});
	$('input[name="number_child"]', t).trigger('change');
	t.find('.control').on("click", function() {
		var $button = $(this);
		numberButtonFunc($button);
	});

	t.find('.control').on("mousedown touchstart", function() {
		var $button = $(this);
		timeOut = setInterval(function(){
			numberButtonFunc($button);
		}, 150);
	}).bind('mouseup mouseleave touchend', function() {
		clearInterval(timeOut);
	});

	function numberButtonFunc($button){
		var oldValue = $button.parent().find(".text input").val();

		if ($button.hasClass('add')) {
			if (oldValue < max) {
				var newVal = parseFloat(oldValue) + 1;
			}else{
				newVal = max;
			}
		} else {
			if (oldValue > min) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = min;
			}
		}

		$button.parent().find(".text input").val(newVal);
		$button.parent().find(".text .value").text(newVal);
		$('input[name="'+$button.parent().find("input").attr('name')+'"]', '.people-dropdown').trigger('change');
	}
});

$('.people-inner').click(function(){
	var t = $(this);
	t.parent().find('.formbook').slideToggle();
});
$(document).mouseup(function(e) 
{
    var container = $(".formbook");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});

$('.check-like').each(function(){
	var parent = $(this);
	$('.glyphicon', parent).click(function(){
		var t = $(this);
		var currentLike = parent.find('.like').text();

		parent.toggleClass('open');

		if(parent.hasClass('open')){
			currentLike++
			parent.find('.like').text(currentLike);
		}else{
			currentLike--
			parent.find('.like').text(currentLike);
		}

	});
})

});
$(document).ready(function(){
			$('.formbook').slideUp();
			var stt=0;
			$("img .slide").each(function(){
				if($(this).is(':visible'))
					stt=$(this).attr("stt");
			});
			$("#next").click(function()
			{
				next= ++stt;
				$(" img .slide").hide();
				$(" img .slide").eq(next).show();
			});
		}); 
// (function($) {
// 	$.fn.shorten = function (settings) {

// 		var config = {
// 			showChars: 0,
// 			ellipsesText: "...",
// 			moreText: "more",
// 			lessText: "less"
// 		};

// 		if (settings) {
// 			$.extend(config, settings);
// 		}

// 		$(document).off("click", '.morelink');

// 		$(document).on({click: function () {

// 			var $this = $(this);
// 			if ($this.hasClass('less')) {
// 				$this.removeClass('less');
// 				$this.html(config.moreText);
// 			} else {
// 				$this.addClass('less');
// 				$this.html(config.lessText);
// 			}
// 			$this.parent().prev().toggle();
// 			$this.prev().slideToggle();
// 			return false;
// 		}
// 	}, '.morelink');

// 		return this.each(function () {
// 			var $this = $(this);
// 			if($this.hasClass("shortened")) return;

// 			$this.addClass("shortened");
// 			var content = $this.html();
// 			if (content.length > config.showChars) {
// 				var c = content.substr(0, config.showChars);
// 				var h = content.substr(config.showChars, content.length - config.showChars);
// 				var html = c + '<span class="moreellipses"> </span><span class="morecontent"><span>' + h + '</span> <a href="#" class="morelink">' + config.ellipsesText + '' + config.moreText + '</a></span>';
// 				$this.html(html);
// 				$(".morecontent span").hide();
// 			}
// 		});

// 	};

//  })(jQuery);
 $(document).ready(function(){
 	$('.menu1').click(function(){
 		$('nav').toggleClass('open1'); 
 	});
 	$('.fa.fa-angle-left').click(function(){
 		$('nav').removeClass('open1'); });
 })
 $("li").click(function(event) {
 	$('.fa.fa-angle-down').toggleClass('daonguoc');
 	t = $(this);

 	t.parent().find('ul').slideToggle();

 });
 // down
 $(function() {
	$('.down').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
		// $(this).children().css( "transform", "rotate(180deg)");
	});
});
$(document).ready(function(){
	//$('.formbook').slideUp();
	var stt=0;
	$("img .slide").each(function(){
		if($(this).is(':visible'))
			stt=$(this).attr("stt");
	});
	$("#next").click(function()
	{
		next= ++stt;
		$(" img .slide").hide();
		$(" img .slide").eq(next).show();
	});
});
 // end dowwn
 //Facilities
 $(document).ready(function(){
 	$(".showmore").click(function(){
 		var t = $(this);
 		$(".room-facility").toggleClass('more');
 		if($(".room-facility").hasClass('more')){
 			t.text('Show Less');
 		}else{
 			t.text('Show All');
 		}
 	});
 });
//Description
 $(document).ready(function(){
 	$(".showmore_des").click(function(){
 		var t = $(this);
 		$(".more-content").toggleClass('more');
 		
 		if($(".more-content").hasClass('more')){
 			t.text('Show Less') ;

 			$(".st-description .cut-gradient").css("display","none");

 		}else{
 			t.text('Show All');
 			$(".st-description .cut-gradient").css("display","block");
 		}
 	});
 });
 //Rule
 $(document).ready(function(){
 	$(".showmore_rule").click(function(){
 		var t = $(this);
 		$(".more_content_rule").toggleClass('more');
 		
 		if($(".more_content_rule").hasClass('more')){
 			t.text('Show Less') ;

 			$(" .cut_gradient_rule").css("display","none");

 		}else{
 			t.text('Show All');
 			$(" .cut_gradient_rule").css("display","block");
 		}
 	});
 });
// hide forrm book 
