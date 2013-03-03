$(document).ready(function() {
	"use strict";
	var $taxsort = $('#taxsort'),
		$input = $('.taxbox .taxorder'),
		$search = $('#search');
	
	$('#taxpool li').each(function() {
		$(this).fadeOut();
	});
	
	$taxsort.on("click", "li span", function() {
		var $li = $(this).parents("li");
		$li.find('span').remove();
		$('#taxpool').append($li.clone());
		$li.remove();
		updateJSON();
	});
	$('#taxpool').on("click", "li", function() {
		if ($('li.empty')) {
			$('li.empty').remove();
		}
		var $newTax = $(this).clone().append("<span>X</span>");
		$(this).remove();
		$taxsort.append($newTax);
		updateJSON();
	});
	$taxsort.on("sortupdate", function() {
		updateJSON();
	});
	$search.keypress(function(e) {
		if (e.which == 13) {
			return false;
		}
	});
	$search.keyup(function() {
		var searchT = $(this).val();
		if (searchT) {
			$('#taxpool li').each(function() {
				// If the list item does not contain the text phrase fade it out
				if ($(this).text().search(new RegExp(searchT, "i")) < 0) {
					$(this).fadeOut();
				// Show the list item if the phrase matches and increase the count by 1
				} else {
					$(this).show();
				}
			});
		} else {
			$('#taxpool li').each(function() {
				$(this).fadeOut();
			});
		}
	});
	
	function updateJSON() {
		var idarray = $( "#taxsort" ).sortable( "toArray" ),
			jsonstr = JSON.stringify(idarray).replace(/\"/g,"'");
			$input.val(jsonstr);
			console.log(jsonstr);
	}
});