$(document).ready(function() {
	"use strict";
	var $taxsort = $('#taxsort');
	$('#taxsort').on("click", "li span", function() {
		var $li = $(this).parents("li");
		$('#taxpool').append($li.clone());
		$li.remove();
	});
	$('#taxpool li').on("click", function() {
		if ($('li.empty')) {
			$('li.empty').remove();
		}
		var $newTax = $(this).clone().append("<span>X</span>");
		$(this).remove();
		$taxsort.append($newTax);
	});
	$('#clickclack').click(function() {
		console.log($( "#taxsort" ).sortable( "toArray" ));
	});
});