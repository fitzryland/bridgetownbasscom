$(document).ready(function(){"use strict";function i(){var e=$("#taxsort").sortable("toArray"),n=JSON.stringify(e).replace(/\"/g,"'");t.val(n);console.log(n)}var e=$("#taxsort"),t=$(".taxbox .taxorder"),n=$("#search"),r={show:function(){},hide:function(){}};$("#taxpool li").each(function(){$(this).fadeOut()});e.on("click","li span",function(){var e=$(this).parents("li");e.find("span").remove();$("#taxpool").append(e.clone());e.remove();i()});$("#taxpool").on("click","li",function(){$("li.empty")&&$("li.empty").remove();var t=$(this).clone().append("<span>X</span>");$(this).remove();e.append(t);i()});e.on("sortupdate",function(){i()});n.keypress(function(e){if(e.which==13)return!1});n.keyup(function(){var e=$(this).val();e?$("#taxpool li").each(function(){$(this).text().search(new RegExp(e,"i"))<0?$(this).fadeOut():$(this).show()}):$("#taxpool li").each(function(){$(this).fadeOut()})})});