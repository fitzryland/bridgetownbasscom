$(document).ready(function() {
	"use strict";
	var $taxsort = $('#taxsort');
	$('#taxsort li span').on("click", function() {
		$(this).parents("li").remove();
	});
	$('#taxpool li').on("click", function() {
		if ($('li.empty')) {
			$('li.empty').remove();
		}
		var $newTax = $(this).clone().append("<span>X</span>");
		
		$taxsort.append($newTax);
	});
});