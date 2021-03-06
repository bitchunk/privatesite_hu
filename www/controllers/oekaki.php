<?php
	self::appendBreadCrumb('おえかき', 'oekaki');
	self::setPageTitle('おえかき' );

	$ignore = self::getIgnore();
	
	// $title = array(
	// 'tothkua' => 'TOTHKUA',
	// 'pitmap' => 'PITMAP',
	// 'litrokeyboard' => 'LitroKeyboard',
	// 'common' => 'その他',
	// );
	$dir = glob(THUMB_PATH. '*', GLOB_ONLYDIR);
	$pictDirs = array();
	// $reg = "/(.*)(?:\.([^.]+$))/";
	$reg = "/\.([^.]+$)/";
	// $blace = '/'. '{*.jpg,*.jpeg,*.gif,*.png}';
	$blace = '{*.jpg,*.jpeg,*.gif,*.png}';
	if(defined('SERVER_FILENAME_ENCODE')){
		mb_internal_encoding(SERVER_FILENAME_ENCODE);
	}
	foreach($dir as $category_path){
		$category = basename($category_path);
		if(isset($ignore[$category]) && $ignore[$category] === true){
			continue;
		}
		$pictDirs[$category] = array();
		$year_dir = glob($category_path. '/*', GLOB_ONLYDIR);
		foreach($year_dir as $year_path){
			$filesTime = array();
			$year = basename($year_path);
			if(isset($ignore[$category][$year]) && $ignore[$category][$year] === true){
				continue;
			}
			$pictDirs[$category][$year. ''] = array();
			// var_dump($pictDirs);
			$pictFiles = glob($year_path.  '/'. $blace, GLOB_BRACE);
			foreach($pictFiles as $pict_path){
				// $thumb_ext = defined('SERVER_FILENAME_ENCODE') ? basename(mb_convert_encoding($pict_path, DEFAULT_ENCODE, SERVER_FILENAME_ENCODE)) : basename($pict_path);
				// $thumb_ext = basename($pict_path);
				$thumb_ext = substr(strrchr("/$pict_path",'/'),1);
				
				if(isset($ignore[$category][$year]) && $ignore[$category][$year] === $thumb_ext){
					continue;
				}
				//thmubはjpgでpictはpngだったり
				$pict_ext = $thumb_ext;
				$pPath = PICT_PATH. '/'. $category. '/'. $year. '/'. $pict_ext;
				if(file_exists($pPath) === false){
					// var_dump($pict_path, mb_detect_encoding($pict_path, "ASCII,JIS,UTF-8,CP51932,SJIS-win", true));
					// var_dump($pict_path, $pict_ext, $pPath);
					$e = glob(preg_replace($reg, '', $pPath). $blace, GLOB_BRACE);
					$pict_ext =  basename($e[0]);
				}
				
				$pictDirs[$category][$year][] = array(
					'thumb' => THUMB_URI. '/'. $category. '/'. $year. '/'. urlencode($thumb_ext),
					'pict' => PICT_URI. '/'. $category. '/'. $year. '/'. urlencode($pict_ext),
				);
				$filesTime[] = filemtime($pict_path);
			}
			array_multisort($filesTime, SORT_DESC, $pictDirs[$category][$year]);
		}
		krsort($pictDirs[$category]);
		
		// var_dump($pictDirs['tothkua']);
	}

/*
ﾃﾚｯﾃﾚｰﾚｰ ﾃﾚｯﾃﾚｰﾚｰ
￣￣￣￣￣￣￣￣￣￣￣￣
   ――  と(  ‘ᾥ’ ) ￣￣
―― ‐   /🍱⊂_ノ ―＿―
     ――./ ／⌒￣ｿ
   ￣￣  -'´      ￣￣￣
￣￣￣￣￣￣￣￣￣￣￣￣
BENTO ATATAME MASUKA MAN
。︒--๐　　⊸　-๐
▇▇▇▇▇▇▇▇▇
▔▔▔▔▔▔▔▔▔
　　　　̾̾ᗝ̾̾
　　 NIKUMAN
▁▁▁▁▁▁▁▁▁
▇▇▇▇▇▇▇▇▇
--๐　⊸　。　⊸︒-๐
 */
	// var_dump($dir);
	// echo json_encode($dirs);
