$(document).ready(function() {
	"use strict";
	// Panel Height Set
	$('.poster').each(function() {
		$(this).load(function() {
			var panelH = $(this).height();
			$(this).parents('article').find('.panel').each(function(i,v) {
				$(v).height(panelH);
			});
			// asign poster dimention .data() to each .poster
			$(this).data("dimentions", { w:$(this).width(), h:$(this).height() });
		});
	});
	function backToPoster(x) {
		var $arti = $(x).parents('article');
		var ogW = $(x).data("dimentions").w,
			ogH = $(x).data("dimentions").h;
		$(x).animate({
			width: ogW,
			height: ogH
		});
		$(x).removeClass('small').addClass('big');
		$arti.find('h2.current').removeClass('current');
	}
	// #cover height set
	function coverSet() {
		var winH = $(window).height();
		$('#cover').height(winH);
	}
	coverSet();
	$(window).resize(function() {
		coverSet();
	});
	// Parse lrgEventImgURLs JSON
	var lrgEventImgURLs = jQuery.parseJSON($('#lrgEventImgURLs').text());
	// Slide Panels
	$('.static h2').click(function() {
		if ($(this).hasClass('current')) {
			var x = $(this).parents('article').find('.poster'); //needs to be poster img
			backToPoster(x);
		} else {
			// find index of clicked element using .index()
			var $arti = $(this).parents('article'),
				clickedI = $arti.find('.static h2').index(this),
				$poster = $arti.find('.poster'),
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
			if ($poster.hasClass('big')) {
				$poster.removeClass('big').addClass('small');

				var wid = 50,
					hi = (5/30) * $poster.data("dimentions").h;
				$poster.animate({
					width: wid,
					height: hi
				});
			}
		}
	});
	// what happens when you click a .poster?
	$('.poster').click(function() {
		if ($(this).hasClass('big')) {
			var i = $('.poster').index(this),
				$cover = $('#cover');
			// show lightbox of really big version
			$cover.fadeIn('fast');
			$cover.html('<img src=\"' + lrgEventImgURLs[i] + '\" class=\"hardHidden\">');
			// size img
			$('#cover img').load(function() {
				var winH = $(window).height(),
					imgW = $('#cover img').width(),
					imgH = $('#cover img').height(),
					tarH = winH * 0.9,
					tarW = tarH * (imgW / imgH);
				$(this).width(tarW).height(tarH).css({
					marginLeft: tarW / 2 * -1,
					marginTop: tarH / 2 * -1
				}).fadeIn('slow');
			});
		} else if ($(this).hasClass('small')) {
			// animate back to original size
			backToPoster(this);
		}
	});
	// Close #cover
	$('#cover').click(function() {
		$(this).fadeOut('slow');
		$(this).empty();
	});
	// Border Color Rotation
	var i = 0,
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
	},150);
});