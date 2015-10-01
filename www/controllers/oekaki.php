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
	$dir = glob(PICT_PATH. '*', GLOB_ONLYDIR);
	$pictDirs = array();
	// foreach($dir as $id => $name){
	// $info = array();
	// $info['id'] = $id;
	// $info['title'] = $name;
	// $dirs[] = $info;
	// }
	foreach($dir as $category_path){
		$category = basename($category_path);
		if(isset($ignore[$category]) && $ignore[$category] === true){
			continue;
		}
		$pictDirs[$category] = array();
		$year_dir = glob($category_path. '/*', GLOB_ONLYDIR);
		foreach($year_dir as $year_path){
			$year = basename($year_path);
			if(isset($ignore[$category][$year]) && $ignore[$category][$year] === true){
				continue;
			}
			$pictDirs[$category][$year] = array();
			$pictFiles = glob($year_path. '/'. '{*.jpg,*.jpeg,*.gif,*.png}', GLOB_BRACE);
			foreach($pictFiles as $pict_path){
				$pict = basename($pict_path);
				if(isset($ignore[$category][$year]) && $ignore[$category][$year] === $pict){
					continue;
				}
				$pictDirs[$category][$year] = PICT_URI. '/'. $category. '/'. $year. '/'. $pict;
				
			}
		}
		var_dump($pictDirs);
	}
	
	// var_dump($dir);
	// echo json_encode($dirs);
