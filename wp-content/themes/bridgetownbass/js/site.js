$(document).ready(function() {
	"use strict";
	var $posters = $('.poster');
	// Panel Height Set


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