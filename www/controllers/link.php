<?php
	self::appendBreadCrumb('りんく', 'link');
	self::setPageTitle('りんく');
	
	function makeSiteLink($title = "No Title", $url = "", $banner = "", $description = "")
	{
		$site = array();
		$site['title'] = $title;
		$site['url'] = $url;
		$site['banner'] = BANNER_URI. '/'. $banner;
		$site['description'] = $description;
		
		return $site;
	}
	// self::appendJS('chunklekit/canvasdraw.js');
	// self::appendJS('chunklekit/keyControll.js');
	// self::appendJS('chunklekit/string.js');
	// self::appendJS('chunklekit/wordPrint.js');
	// self::appendJS('litrosound/Litrosound.js');
	// self::appendJS('topanim.js');
	$linkList = array();
	$linkList[] = makeSiteLink('月詠龍', 'http://karasu-ryu.jp/', 'tsukuyomiryu.jpg', '【イラスト】【読み物】【ブログ】');
	$linkList[] = makeSiteLink('シロデココ', 'http://dekoco.net/', 'shirodekoko.png', '【イラスト】【ブログ】');
	$linkList[] = makeSiteLink('lintw.net', 'http://lintw.net/', 'lintw.gif', '【イラスト】');
	$linkList[] = makeSiteLink('アイス＆クリフ', 'http://nkymtky.web.fc2.com/icecliff/index.htm', 'icecliff.jpg', '【ゲーム】');
	$linkList[] = makeSiteLink('シーレの物置場', 'http://www.geocities.jp/recpix/', 'crepix.png', '【ゲーム】【イラスト】');
	
	if(@$_GET['shuffle'] !== 'no'){
		shuffle($linkList);
	}
