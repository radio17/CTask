<?php

global $yield;

//タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

require_once("model.php");

// タイトル、本文どちらも空でない場合
if ( isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST' )
{
  // Do validate
  if ( !empty($_POST['title']) && !empty($_POST['text']) )
  {
    post_data();// 投稿データを格納
  }
}

// 表示するデータの読み込み
$yield = disp_data();

// 描画
require_once('view.php');