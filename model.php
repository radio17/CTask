<?php
  
// ----------------------------------------
// 投稿データの格納
// ----------------------------------------
function post_data() {

	// JSONを読み込み
	$data_json = @file_get_contents("data.json");
	$json = json_decode( $data_json );
	
	// 空のファイルまたは、JSON データでは無い
	if ( $json === null ) {
  	
		// 行データを格納する配列を作成  	
		$json = new stdClass;
		$json->item = array();
	}

	// HTML 要素を無効にする
	$_POST['text'] = str_replace("<","&lt;",$_POST['text']);
	$_POST['text'] = str_replace(">","&gt;",$_POST['text']);
	$_POST['title'] = str_replace("<","&lt;",$_POST['title']);
	$_POST['title'] = str_replace(">","&gt;",$_POST['title']);	
	
	// タイトル、テキストをセット
	$board_data = new stdClass;
	$board_data->title = $_POST['title'];
	$board_data->text = $_POST['text'];
  
	// 時刻をセット  
	$timestamp = time();
	$board_data->datetime = date( "Y/m/d H:i:s", $timestamp );
	
	// 配列に新規投稿データを格納
	array_unshift($json->item, $board_data);

	// 全ての投稿データを JSON として全て上書き
	file_put_contents("data.json", json_encode( $json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ) );
  
  // ページをリロード
	header( "Location: {$_SERVER["PHP_SELF"]}" );
	exit();  
}

// ----------------------------------------
// データの表示処理
// ----------------------------------------
function disp_data() {

	// 埋め込み用データを global 宣言 (view.phpで利用)
	global $data_json;

	// JSONデータを読み込む
	$data_json = @file_get_contents("data.json");
	
	// ファイルが存在しない場合
	if ( $data_json === false ) {
		$data_json = "ここに投稿データが表示されます";
		return;
	}

	$json = json_decode( $data_json );
	
	// 空のファイルまたは、JSON データでは無い
	if ( $json === null ) {
		$data_json = "ここに投稿データが表示されます";
		return;
	}

	// 表示用の埋め込みに使用される文字列変数
	$data_json = "";
	foreach( $json->item as $v ) {
		$v->text = str_replace("\n", "<br>\n", $v->text );
		$data_json .= "<div><h1>{$v->title}</h1><time>({$v->datetime})</time><p>{$v->text}</p></div>";
	}
}

?>
