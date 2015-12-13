<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
<meta name="viewport" content="width=320, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta name="viewport" content="width=320, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

<?php
	require_once(VIEW_PATH . '/headerbase/'. DispatchController::$headerBase. '.php');
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="author" content="しふたろう">

<?php
 if(!empty(DispatchController::$cardsmeta)){
	require_once(VIEW_PATH . '/cardsmeta/'. DispatchController::$cardsmeta. '.php');
}else{
	require_once(VIEW_PATH . '/cardsmeta/'. DispatchController::$DEFAULT_CARDSMETA. '.php');
}
?>

<!-- <meta name="viewport" content="width=device-width; initial-scale=1.0"> -->

<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
<link rel="stylesheet" href="/css/common.css" />

<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<script src="/js/lib/jquery-2.0.0.min.js"></script>
<script src="/js/lib/jquery.easing.1.3.js"></script>
<script src="/js/litrosound/Litrosound.js"></script>
<script src="/js/common.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer>
	{lang: 'ja'}
</script>
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-46774451-2']);
	_gaq.push(['_setDomainName', 'kemono.jp']);
	_gaq.push(['_setAllowLinker', true]);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})(); 
</script>
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, "script", "twitter-wjs"));</script>
<?php
foreach(DispatchController::$additionalScripts as $index=>$filename){
	if(!isURL($filename)){
		echo '<script src="/js/'. $filename. '"></script>'. "\n";
	}else{
		echo '<script src="'. $filename. '"></script>'. "\n";
	}
}
foreach(DispatchController::$additionalHeaders as $index=>$tags){
	echo $tags. "\n";
}
?>
</head>
<body>
<div id="container">
	<h1><span class="hide">ひとくちふ</span></h1>
	<header>
		<nav>
			<div class="otemoto">
				<h1><span class="hide">メニュー</span><a href="<?php echo PROTOCOL_HOST; ?>"><img id="banner" src="/img/banner/banner_nav.png"></a><div class="otmt_sep">&nbsp;</div></h1>
				<div class="menu">
					<ul class="clip">
						<li id="youji"><a href="javascript:void(0)"><img src="/img/common/null.png" /></a></li>
						<li id="top"><a href="/"><img src="/img/common/null.png" /></a></li>
						<li id="about"><a href="/about"><img src="/img/common/null.png" /></a></li>
						<li id="oekaki"><a href="/oekaki"><img src="/img/common/null.png" /></a></li>
						<li id="appli"><a href="/appli"><img src="/img/common/null.png" /></a></li>
						<li id="link"><a href="/link"><img src="/img/common/null.png" /></a></li>
					</ul>
				</div>
			</div>
			<hr class="clear" />
			<?php echo DispatchController::outputBreadCrumb(); ?>
			<hr class="clear" />
			<!-- <div class="donate"><?php if(!empty(self::$donateButton)){echo self::$donateButton;}?></div> -->
			
		</nav>
	</header>

