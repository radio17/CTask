<?php

// ----------------------------------------
// 投稿データの格納
// ----------------------------------------
function post_data() {

  // JSONを読み込み
  $data_json = @file_get_contents("data.json");
  $json = json_decode( $data_json );

  // 空のファイルまたは、JSON データでは無い
  if ( $json === null )
  {
    // 行データを格納する配列を作成
    $json = new stdClass;
    $json->item = array();
  }

  // HTML 要素を無効にする
  $text = htmlspecialchars( $_POST['text'] );
  $title = htmlspecialchars( $_POST['title'] );

  // データをセット
  $board_data = new stdClass;
  $board_data->title = $title;
  $board_data->text = $text;
  $board_data->datetime = date( "Y/m/d H:i:s" );

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
function disp_data()
{

  // JSONデータを読み込む
  $data_json = @file_get_contents("data.json");

  // ファイルが存在しない場合
  if ( $data_json === false ) return "ここに投稿データが表示されます";

  $json = json_decode( $data_json );

  // 空のファイルまたは、JSON データでは無い
  if ( !$json ) return "ここに投稿データが表示されます";

  // 表示用の埋め込みに使用される文字列変数
  $output = "";
  foreach( $json->item as $v )
  {
    $v->text = nl2br( $v->text );
    $output .= "<div><h1>{$v->title}</h1><time>({$v->datetime})</time><p>{$v->text}</p></div>";
  }

  return $output;
}