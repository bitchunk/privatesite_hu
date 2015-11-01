$(function(){
	$('#mailprompt').click(function(){
		window.prompt('連絡・質問等はこちら', jq8o());
	});
	
	function jq8o(){
		var s = '147,56,145,142,157,144,141,151,100,147,155,141,151,154,56,143,157,155'
			, radix = 8;
		return s.split(',').map(function(c){return String.fromCharCode(parseInt(c, radix));}).join('');
	}
	
	$('ul.clip').click(function(){
		$(this).toggleClass('clip');
	});
	
	
	if($('.sns_buttons').size() > 0){
		$.get('http://api.jsdo.it/v0.2/user/show.json?name=shifta_low', function(data){
			if(data != null && data.error == null){
				// $('a.jsdoit-user').attr('href', data.url).html('<img src="https://jsdo.it/img/favicon.ico" />');
				// console.log(data);
				//https://jsdo.it/img/favicon.ico
			}
		});
		$.get('https://api.github.com/users/oshiimizunohuta', function(data){
			if(data != null && data.error == null){
				// console.log(data);
			}
		});
	}
	
	$('article.link dt').eq(0).find('span.hide').each(function(){
		var ids = $(this).text().split(','), elm
		;
		if(ids[0].length == 0){
			return;
		}
		twttr.ready(function(twttr){
		$('article.link section dd').eq(0).append('<div class="pickup"><p class="blink">▼Pickup</p><div class="pickbody close"></div></div>');
		elm = $('article.link section dd .pickup .pickbody').get(0);
			twttr.widgets.createTweet(
				ids[0],
			elm,
			{
//				width: 300
			}).then(function(el){
				setTimeout(function(){
					$(el).parents('.pickup').find('.blink').removeClass('blink');
					$(el).parents('.pickbody').removeClass('close');
					
				}, 400);
			});
		});
	});
	
});
function openDlDesc(self){
	var el = $(self).parents('section').find('dl');
	if(el.hasClass('close')){
		el.removeClass('close');
	}else{
		el.addClass('close');
	}
}
