<?php
	if(@$_GET['method'] == 'dirname'){
		$title = array(
			'tothkua' => 'TOTHKUA',
			'pitmap' => 'PITMAP',
			'litrokeyboard' => 'LitroKeyboard',
			'common' => 'その他',
		);
		
		foreach($title as $id => $name){
			$info = array();
			$info['id'] = $id;
			$info['title'] = $name;
			$dirs[] = $info;
		}
		echo json_encode($dirs);
	}else if(@$_GET['method'] == 'thumbs'){
		$id = $_GET['id'];
		if(empty($id)){
			echo json_encode(false);
			exit;
		}
		
		// $images = glob(PICT_PATH. $id. '/{*.gif,*.jpg,*.png}', array());
		$images = glob(PICT_PATH. $id. '/thumb/*.jpg');
		$dirs = array();
		foreach($images as $name){
			$info = array();
			$info['id'] = $id;
			$info['src'] = '/pictures/?id='. $id. '&type='. basename(dirname($name)). '&name='. basename(str_replace(".jpg", "", $name));
			// $info['src'] = '/pictures/?id='. $id. '&sub='. basename(dirname($name)). '&name='. basename(str_replace(".jpg", "", $name));
			$dirs[] = $info;
		}
		echo json_encode($dirs);
	}else if(@$_GET['method'] == 'source'){
		$id = $_GET['id'];
		$sub = $_GET['sub'];
		
		$src = PICT_PATH. $id. '/'. '';
		if(empty($id)){
			echo json_encode(false);
			exit;
		}
		
	}else if(@$_GET['method'] == 'titles'){
		$id = $_GET['id'];
		if(empty($id)){
			echo json_encode(false);
			exit;
		}
		
		$images = glob(PICT_PATH. $id. '/thumb/{*.gif,*.jpg,*.png}', GLOB_BRACE);
		$titles = glob(PICT_PATH. $id. '/source/{*.gif,*.jpg,*.png}', GLOB_BRACE);
		
		$dirs = array();
		foreach($titles as $title){
			$name = basename($title);
			$info = array();
			$info['title'] = $name;
			$info['id'] = $id;
			$info['src'] = '/pictures/?id='. $id. '&type=thumb&name='. str_replace(array(".jpg", ".png", ".gif"), "", $name);
			$dirs[] = $info;
		}
		foreach($images as $name){
			$info = array();
		}
		echo json_encode($dirs);
		
	}
	exit;
?>