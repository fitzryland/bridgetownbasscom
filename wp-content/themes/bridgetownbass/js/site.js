$(document).ready(function() {
	"use strict";
	var $posters = $('.poster');
	// Panel Height Set
	$posters.each(function() {
		$(this).load(function() {
			var panelH = $(this).height(),
				$article = $(this).parents('article');
				
			$article.find('.flip').each(function(i,v) {
				$(v).height(panelH);
			});
			// asign poster dimention .data() to each .poster
			$(this).data("dimentions", { w:$(this).width(), h:$(this).height() });
		});
	});
	function backToPoster(x) {
		$(x).animate({
			bottom: 0
		});
		var $arti = $(x).parents('article'),
			$arrow = $arti.find('.arrow');
		
		// var ogW = $(x).data("dimentions").w,
		// 	ogH = $(x).data("dimentions").h;
		// $(x).animate({
		// 	width: ogW,
		// 	height: ogH
		// });
		
		$arrow.removeClass('live');
		$(x).removeClass('small').addClass('big');
		$arti.find('h2.current').removeClass('current');
	}
	// Slide Panels
	$('.static h2').click(function() {
		var $thisPoster = $(this).parents('article').find('.poster');
		$posters.not($thisPoster).each(function() {
			backToPoster(this);
		});
		// retun .poster of all other evnets to .big
		$('.event').on(".big");
		// Decide what to do on click in current event
		if ($(this).hasClass('current')) {
			backToPoster($thisPoster);
		} else {
			// find index of clicked element using .index()
			var $arti = $(this).parents('article'),
				clickedI = $arti.find('.static h2').index(this),
				$arrow = $arti.find('.arrow'),
				tarPanWrap = $arti.find('.panelWrap')[0],
				tarMar = clickedI * -300;
			$(this).siblings().each(function() {
				$(this).removeClass('current');
			});
			$(this).addClass('current');
			// move panel to correct position
			$(tarPanWrap).animate({
				marginLeft: tarMar
			}, "slow");
			// shrink .poster image
			if ($thisPoster.hasClass('big')) {
				$thisPoster.removeClass('big').addClass('small');
				// Slide poster down				
				$thisPoster.animate({
					bottom: -370
				});
				// var wid = 50,
				// 	hi = (5/30) * $poster.data("dimentions").h;
				// $poster.animate({
				// 	width: wid,
				// 	height: hi
				// });
			}
		}
	});
	$('.arrow').click(function() {
		var x = $(this).siblings('.poster');
		backToPoster(x);
	});
	
	// what happens when you click a .poster?
	$posters.click(function() {
		if ($(this).hasClass('big')) {
			var link = $(this).attr('data');
			window.location = link;
		} else if ($(this).hasClass('small')) {
			// animate back to original size
			backToPoster(this);
		}
	});
	// Border Color Rotation
	var i = 0,
		speed = 800,
		colors = new Array("#00dfff","#aa3fff","#ff9f00"),
		$highlights = $('article.highlight');
	setInterval(function() {
		$highlights.each(function() {
			$(this).css('border-color',colors[i]);
		});
		if (i === 2) {
			i = 0;
		} else {
			i = i + 1;
		}
	},speed);
	
	
	
	
});