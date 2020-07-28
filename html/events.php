<?php
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/event.php';
require_once '../model/user.php';
require_once '../model/detail.php';

session_start();

// ログイン済みか確認し、falseならloginページへリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

// DBに接続する
$db = get_db_connect();
// sessionからuser_idを取得
$user_id = $_SESSION['user_id'];

// userの名前と紹介を取り出して表示user.php
$user = get_user_info($db, $user_id);

// login済みのuser_idをセッションから取得して変数に格納
$user = get_login_user($db);

// DBからイベント情報を取り出し$eventsに格納 event.php
$events = get_event_info($db);

// get送信された並べ替えの機能を取得してsessionに格納
$sort = get_get('sort');
$_SESSION['sort'] = $sort;


// sort
$events = get_events_sort($db);
include_once '../view/events_view.php';