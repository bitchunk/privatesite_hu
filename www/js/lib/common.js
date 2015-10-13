$(function(){
	$('#mailprompt').click(function(){
		window.prompt('連絡・質問等はこちら', jq8o());
	});
	
	function jq8o(){
		var s = '147,56,145,142,157,144,141,151,100,147,155,141,151,154,56,143,157,155';
		var radix = 8;
		return s.split(',').map(function(c){return String.fromCharCode(parseInt(c, radix));}).join('');
	}
});
