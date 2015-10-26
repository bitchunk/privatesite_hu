<?php
	self::appendBreadCrumb('りんく', 'link');
	self::setPageTitle('りんく');
	
	function makeSiteLink($title = "No Title", $url = "", $banner = "", $description = "")
	{
		$site = array();
		$site['title'] = $title;
		$site['url'] = $url;
		$site['banner'] = preg_match("/^https?\:\/\/.*/", $banner) ? $banner : BANNER_URI. '/'. $banner;
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
	$artists = array();
	$artists[] = makeSiteLink('月詠龍', 'http://karasu-ryu.jp/', 'tsukuyomiryu.jpg', '【イラスト】【読み物】【ブログ】');
	$artists[] = makeSiteLink('シロデココ', 'http://dekoco.net/', 'shirodekoko.png', '【イラスト】【ブログ】');
	$artists[] = makeSiteLink('lintw.net', 'http://lintw.net/', 'lintw.gif', '【イラスト】');
	$artists[] = makeSiteLink('アイス＆クリフ', 'http://nkymtky.web.fc2.com/icecliff/index.htm', 'icecliff.jpg', '【ゲーム】');
	$artists[] = makeSiteLink('シーレの物置場', 'http://www.geocities.jp/recpix/', 'crepix.png', '【ゲーム】【イラスト】');

	$tools = array();
	$tools[] = makeSiteLink('EDGE2', 'http://takabosoft.com/edge2', 'http://takabosoft.com/wp-content/themes/takabosoft/edge2/banner00.png', '【ツール】');
	$tools[] = makeSiteLink('けものサーバ', 'http://kemono.cc/', 'kemoserver.gif', '【ホームページスペース】【検索】');
	$tools[] = makeSiteLink('けもサーチ', 'http://www.kemonosearch.com/', 'kemobar13.gif', '【検索】');
	$tools[] = makeSiteLink('クリエイター×コレクション', 'http://www.kurikore.com/', 'creatorcollection.png', '【検索】');
	
	if(@$_GET['shuffle'] !== 'no'){
		shuffle($artists);
		shuffle($tools);
	}
	
	list($f, $i) = explode(" ", microtime());
	srand(((float)$f * 1000000) + $i);
	// var_dump(((float)$f * 1000000) + $i);
	$linkList['artists'] = $artists;
	$linkList['tools'] = $tools;
	
