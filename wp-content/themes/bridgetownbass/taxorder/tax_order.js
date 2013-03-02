$(document).ready(function() {
	"use strict";
	var $taxsort = $('#taxsort'),
		$input = $('.taxbox input');
	$('#taxsort').on("click", "li span", function() {
		var $li = $(this).parents("li");
		$('#taxpool').append($li.clone());
		$li.remove();
		updateJSON();
	});
	$('#taxpool li').on("click", function() {
		if ($('li.empty')) {
			$('li.empty').remove();
		}
		var $newTax = $(this).clone().append("<span>X</span>");
		$(this).remove();
		$taxsort.append($newTax);
		updateJSON();
	});
	$('#clickclack').click(function() {
		updateJSON();
	});
	function updateJSON() {
		var idarray = $( "#taxsort" ).sortable( "toArray" ),
			jsonstr = JSON.stringify(idarray).replace(/\"/g,"'");
			$input.val(jsonstr);
//			console.log(jsonstr);
	}
});