<?php

//タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');	

require_once("model.php");
	
$title_text = $_POST['text'].$_POST['title'];

// タイトル、本文どちらも空でない場合
if ( $_POST['send'] != "" && $title_text != "" ) {
  
  // 投稿データを格納
	post_data();
}

// 表示するデータの読み込み
disp_data();

// 描画
require_once('view.php');

?>