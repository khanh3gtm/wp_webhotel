jQuery(document).ready(function($){
	/* People minus-add */

	
		var body = $('body');
		

			$('.has-matchHeight', body).matchHeight();
		
	
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


        /*t.find('.control').on("click", function() {

        	var $button = $(this);
        	numberButtonFunc($button);

        });*/

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


});

$(function() {
	$('.dangky').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
	});

});
$('.slide .control a').click(function()
{
	var id= $(this).attr('data-id');
	var margin_left=-870*(id-1);
	$ (' .slide .list-img .wrap').css('margin-left',margin_left+'px');
})
;

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

//from chạy
$(function() {
	$('.people-inner').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
	});

});
$(document).ready(function(){
	$('.extras').slideUp();
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
//hết form chạy
// more
$(function() {
	$('.more').click(function(event) {
		/* Act on the event */
		$(this).toggleClass('daonguoc');
		$(this).next().slideToggle();
	});

});
$(document).ready(function(){
	$('.formdebook').slideUp();
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
// end more
// dịch chuyển form
$(window).scroll(function () {
    if ($(window).scrollTop() >= 611) {
        $('.widgets').addClass('fixed');
    } 
    if ($(window).scrollTop() >= 2500) {
        $('.widgets').removeClass('fixed');
    }
     if ($(window).scrollTop() < 611) {
        $('.widgets').removeClass('fixed');
    }
});
// end dịch chuyển
// chọn ngày
$(function() {

	$('input[name="datetimes"]').daterangepicker({

		opens:'center',
		"autoApply": true,
		startDate: moment().startOf('hour'),
		endDate: moment().startOf('hour').add(32, 'hour'),
		locale: {
			format: 'M/DD/YYYY'
		}
	});
});
// end chọn ngày


jQuery(document).ready(function($){
	/* People minus-add */
	
	$('.people-inner').click(function(){
				var t = $(this);
				t.parent().find('.formdebook').slideToggle();
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
// $(document).ready(function){
// 	$('span.text').toggle(function () {
// 		$(".st-description").css({height(auto)});
// 	}, function () {
// 		$(".st-description").css({height(100px)});
// 	});
// }

$(document).ready(function(){
      $('.menu1').click(function(){
      $('nav').toggleClass('open'); 
      });
      $('.fa.fa-angle-left').click(function(){
    //      var t = $(this);

        // t.parent().find('ul').next().slideToggle();
      $('nav').removeClass('open'); });
    })

// chọn ngày theo từng bên
// $(function() {

// 	$('input[name="startday"]').daterangepicker({
// 		singleDatePicker: true,
// 		opens:'left',
// 		"autoApply": true,
// 		startDate: moment().startOf('hour'),
// 		endDate: moment().startOf('hour').add(32, 'hour'),
// 		locale: {
// 			format: 'M/DD/YYYY'
// 		}
// 	});
// });
// $(function() {

// 	$('input[name="endday"]').daterangepicker({
// 		singleDatePicker: true,
// 		opens:'left',
// 		"autoApply": true,
// 		startDate: moment().startOf('hour'),
// 		endDate: moment().startOf('hour').add(32, 'hour'),
// 		locale: {
// 			format: 'M/DD/YYYY'
// 		}
// 	});


// });
$(document).ready(function () {
	$('input[name="date"]').daterangepicker(
	{
		"autoApply": true,
		"locale": {
			"format": "DD/MM/YYYY",
		},
	},
	function (start, end, label) {
		console.log("Callback has been called!");
		$('#reportrange').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
		$('#start').val(start.format('DD/MM/YYYY'));
		$('#end').val(end.format('DD/MM/YYYY'));
		$('#date').val(start.format('DD/MM/YYYY hh:mm') + ' am- ' + end.format('DD/MM/YYYY hh:mm') + ' pm');
	}
	);
});
// $(document).ready(function() {
//     // Configure/customize these variables.
//     var showChar = 100;  // How many characters are shown by default
//     var ellipsestext = "...";
//     var moretext = "Show more >";
//     var lesstext = "Show less";
    

//     $('.more').each(function() {
//         var content = $(this).html();
 
//         if(content.length > showChar) {
 
//             var c = content.substr(0, showChar);
//             var h = content.substr(showChar, content.length - showChar);
 
//             var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
//             $(this).html(html);
//         }
 
//     });
 
//     $(".morelink").click(function(){
//         if($(this).hasClass("less")) {
//             $(this).removeClass("less");
//             $(this).html(moretext);
//         } else {
//             $(this).addClass("less");
//             $(this).html(lesstext);
//         }
//         $(this).parent().prev().toggle();
//         $(this).prev().toggle();
//         return false;
//     });
// });

jQuery(document).ready(function($){
	$("span.text").click(function(e){
		e.preventDefault();
		$(".st-description").toggleClass('more1');
		if($(".st-description").hasClass('more1')){
			$(this).text('View Less');
			$('.cut-gradient').css("display", "none");			
		}else{
			$(this).text('View More');
			$('.cut-gradient').css("display", "block");

		}
	});
	$("span.text1").click(function(r) {
		r.preventDefault();
		$(".facilities").toggleClass('more2');
		if($(".facilities").hasClass('more2')){
			$(this).text('Show less');
		}
		else{
			$(this).text('Show more');
		}
	});
});



