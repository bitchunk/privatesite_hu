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
	
	$('img.picview').click(function(){
		try{
			var src = $(this).parents('a').get(0).href;
			pictView(src);
			return false;
			
		}catch(e){
			console.log(e);
			return false;
		}
		
	});
});

LTSND('shiftal_on', 'HU', function(ltsnd){
	// console.log(ltsnd);
	ltsnd.se.eventPlay('.menu li', 'mouseover', 0);
});

function makeBG(mainScroll, multi, onload)
{
	var cvs = document.createElement('canvas'), ctx = cvs.getContext('2d')
		, img = new Image();
	img.onload = function(){
		var bgw = this.width * multi, bgh = this.height * multi
		, repx = ((mainScroll.cvs.width / bgw) | 0) + 1
		, repy = ((mainScroll.cvs.height / bgh) | 0) + 1
		, x, y
		;
		cvs.width = repx * bgw;
		cvs.height = repy * bgh;
		ctx.imageSmoothingEnabled = false;
		for(y = 0; y < repy; y++){
			for(x = 0; x < repx; x++){
				ctx.drawImage(this, (bgw * x), (bgh * y), bgw, bgh);
			}
		}
		onload();
	};
	img.src = './img/resource/oekaki_back.png';
	return {cvs: cvs, ctx: ctx};
}

function pictView(src){
	var cvs = document.createElement('canvas'), ctx = cvs.getContext('2d')
		, img = new Image()
		, body = window.document.body
		, w = body.offsetWidth, h = body.offsetHeight
		, bg, imgScroll = {}
		, scrollCount = 0
	;
	
	cvs.id = 'picview';
	$('#container').click(function(){
		$('body canvas').remove();
	});
	cvs.width = w > h ? w * 0.9 : w;
	cvs.height = w > h ? h : h * 0.9;

	img.onload = function(){
		var 
			rw = cvs.width / this.width, rh = cvs.height / this.height
			, dw = cvs.width, dh = this.height * rw, dx, dy
			, mul = 2
		;
		imgScroll.cvs = document.createElement('canvas');
		imgScroll.ctx = imgScroll.cvs.getContext('2d');
		imgScroll.cvs.width = this.width;
		imgScroll.cvs.height = this.height;
		// imgScroll.ctx.imageSmoothingEnabled = false;
		imgScroll.ctx.drawImage(this, 0, 0);
		
		if(dh > cvs.height){
			dw = this.width * rh;
			dh = cvs.height;
			rw = rh;
		}
		
		dx = ((cvs.width - dw) / 2) | 0;
		dy = ((cvs.height - dh) / 2) | 0;
		ctx.drawImage(img, dx, dy, dw, dh);
		window.document.body.appendChild(cvs);
		
		// ctx.imageSmoothingEnabled = false;
		bg = makeBG({cvs: cvs, ctx: ctx}, mul, function(){
			function bgScrolling(){
				var x = scrollCount % bg.cvs.width
				, y = scrollCount % bg.cvs.height
				, w = bg.cvs.width, h = bg.cvs.height, i
				, ofs, duration = 32, distance
				;
				ctx.drawImage(bg.cvs, x, y);
				ctx.drawImage(bg.cvs, x - w, y);
				ctx.drawImage(bg.cvs, x - w, y - h);
				ctx.drawImage(bg.cvs, x, y - h);
				if(scrollCount < duration){
					for(i = 0; i < dh; i++){
						distance = duration / Math.exp(( scrollCount) * 0.20) * (dw / duration);
						ofs = Math.cos((i * Math.PI * 1)) * distance;
						ctx.drawImage(imgScroll.cvs, 0, i / rw, imgScroll.cvs.width, 1 / rw, dx + ofs, i, dw, 1);
					}
				}else{
					ctx.drawImage(imgScroll.cvs, dx, dy, dw, dh);
				}
				scrollCount++;
				requestAnimationFrame(bgScrolling);
			}
			requestAnimationFrame(bgScrolling);
		});
		
		
	};
	img.src = src;
}

function openDlDesc(self){
	var el = $(self).parents('section').find('dl');
	if(el.hasClass('close')){
		el.removeClass('close');
	}else{
		el.addClass('close');
	}
}

