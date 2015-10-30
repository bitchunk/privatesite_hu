<?php
	require PHP_LIBRARY_DIR. "/twitteroauth/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;
	define('CONSUMER_KEY', '4YdXy4VckvBpIlH1i9dfu0H3e');
	define('CONSUMER_SECRET', 'R3c7iLX3Ot0qNqajghW1BEVDtpgbbnTpmRcNI7CLozhfiXHSgX');
	$access_token	= '2835986358-cMNw76Z7inNzaUn0BOwrAIswPDZC8La0pC6jdPe';
	$access_token_secret = 'uSvjxoJ2yrLTiU2cySrCBcgpVi27VWYhqA95HCM8KyEl1';
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
	
	self::appendBreadCrumb('りんく', 'link');
	self::setPageTitle('りんく');
	//TODO ピックアップ＆関連ツイート表示機能
	function makeSiteLink($title = "No Title", $url = "", $banner = "", $description = "")
	{
		$banner = !empty($banner) ? $banner : 'nobanner.png';
		$site = array();
		$site['title'] = $title;
		$site['url'] = $url;
		$site['banner'] = preg_match("/^https?\:\/\/.*/", $banner) ? $banner : BANNER_URI. '/'. $banner;
		$site['description'] = $description;
		
		
		return $site;
	}
	
	self::appendJS('http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha1.js');
	self::appendJS('http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha256.js');
	self::appendJS('http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-base64-min.js');
	self::appendJS('lib/oauth-1.0a.js');
	$linkList = array();
	$artists = array();
	$artists[] = makeSiteLink('月詠龍', 'http://karasu-ryu.jp/', 'tsukuyomiryu.jpg', '【イラスト】【読み物】【ブログ】');
	$artists[] = makeSiteLink('シロデココ', 'http://dekoco.net/', 'shirodekoko.png', '【イラスト】【ブログ】');
	// $artists[] = makeSiteLink('シロデココ', 'http://dekoco.net/', '', '【イラスト】【ブログ】');
	$artists[] = makeSiteLink('lintw.net', 'http://lintw.net/', 'lintw.gif', '【イラスト】');
	$artists[] = makeSiteLink('アイス＆クリフ', 'http://nkymtky.web.fc2.com/icecliff/index.htm', 'icecliff.jpg', '【ゲーム】');
	$artists[] = makeSiteLink('シーレの物置場', 'http://www.geocities.jp/recpix/', 'crepix.png', '【ゲーム】【イラスト】');
	$artists[] = makeSiteLink('ちょこざいな千鳥足ライフ', 'http://nostalgicsky.blog17.fc2.com/', 'cchidoriashil.png', '【ブログ】');
	$artists[] = makeSiteLink('らっこ屋', 'http://namori1229.tumblr.com/', 'rakkoya.jpg', '【イラスト】');

	$tools = array();
	$tools[] = makeSiteLink('EDGE2', 'http://takabosoft.com/edge2', 'http://takabosoft.com/wp-content/themes/takabosoft/edge2/banner00.png', '【ツール】');
	$tools[] = makeSiteLink('けものサーバ', 'http://kemono.cc/', 'kemoserver.gif', '【ホームページスペース】【検索】');
	$tools[] = makeSiteLink('けもサーチ', 'http://www.kemonosearch.com/', 'kemobar13.gif', '【検索】');
	$tools[] = makeSiteLink('クリエイター×コレクション', 'http://www.kurikore.com/', 'creatorcollection.png', '【検索】');
	
	list($f, $i) = explode(" ", microtime());
	srand(((float)$f * 1000000) + $i);
	
	if(@$_GET['shuffle'] !== 'no'){
		shuffle($artists);
		shuffle($tools);
	}
///https?\:\/\/[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+/	
	// $content = $connection->get("search/tweets", array('q' => $artists[0]['title']. ' OR '. $artists[0]['url'], 'result_type' => 'recent', 'count' => '3',));
	$q = trim(preg_replace("/https?\:\/\/([-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/", "$1", $artists[0]['url']), '/');
	$content = $connection->get("search/tweets", array(
		'q' => "\"". urlencode($q). "\"",
		'result_type' => 'recent',
		// 'f' => 'tweets',
		'include_entities' => 'true',
		'count' => '3',
		// 'max_id' => '659346139171393536',
		// 'since_id' => '629346139171393536'
			));
	// var_dump(trim(preg_replace("/https?\:\/\/([-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/", "$1", $artists[0]['url']), '/'));	
	// var_dump( "\"". $q. "\"");	
	$pickupIds = array();
	foreach($content->statuses as $status){
		$pickupIds[] = $status->id_str;
	}
	// var_dump($content, $pickupIds);
	// var_dump($pickupIds);
	// var_dump(((float)$f * 1000000) + $i);
	$linkList['artists'] = $artists;
	$linkList['tools'] = $tools;
	
