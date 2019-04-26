$(function() {
			$('input[name="daterange"]').daterangepicker({
				opens: 'right',
				"autoApply": true,

			}, function(start, end, label) {
				console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
			});
		});

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

		        $('.control', t).on("mousedown touchstart", function() {
		        	var $button = $(this);
		        	timeOut = setInterval(function(){
		        		numberButtonFunc($button);
		        	}, 250);
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

		});

		// xu ly book lich
		$(function() {
			$('.icon').click(function(event) {
				/* Act on the event */
				$(this).toggleClass('icondaonguoc');
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

		
		// end book lich
		$(document).ready(function(){
			var body = $('body');
			
			$('.has-matchHeight', body).matchHeight(); 
		});