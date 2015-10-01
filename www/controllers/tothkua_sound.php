<?php
	
	$contents = array();
	$mime = '.mp3';
	$files = glob(MUSIC_PATH. 'tothkua/*'. $mime);
	$titles = array(
		'stage_a' => 'ノボリアガルモノガタリ（STAGE1～5）',
		'option' => 'ジュンビチュウ！！(OPTION MODE)',
		'stage_b' => 'チカトシ（STAGE6～9）',
		'boss' => 'ゲートキーパー(STAGE10 BOSS)',
		'stage_c_old' => 'チテイノハシッコ（STAGE11～14・旧ver）',
		'stage_c_new' => 'チテイノハシッコ（STAGE11～14・新ver）',
		'ranking' => 'デキルカナ（ハイスコアランキング）',
		'horaanakaze' => 'ホラアナカゼ（？？？）',
		'timepenalty' => 'ツヨイヤツ（タイムアップペナルティ）',
		'menu' => 'メニューノ３（メニュー画面）',
		'endingscene' => 'タビノヤド（エンディング）',
		'ahureruchikara' => 'アフレルチカラ（メッセージ）',
		'bootup' => 'ブートアップ（クレジットタイトル）',
		'practice' => 'ボールハジキッ（練習ステージ）',
		'gameover' => 'ナサケナクテ（GAMEOVER）',
	);
	foreach($titles as $file=>$title){
		$path = MUSIC_PATH. 'tothkua/'. $file. $mime;
		if(!file_exists($path)){
			continue;
		}
		
		$contents[] = array('path' => MUSIC_URI. 'tothkua/'. $file, 'title' => $title, 'category' => 'TOTHKUA_SOUND');
	}
	self::appendJS('tracking_media.js');
	// foreach($files as $path){
		// $base = basename($path, $mime);
		// $contents[] = array('path' => MUSIC_URI. 'tothkua/'. $base. $mime, 'title' => $titles[$base]);
	// }
?>