<?php
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/event.php';
require_once '../model/user.php';

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

// 参加予定のイベントをDBから取り出して表示
$events = get_join_events($db, $user_id);

// 主催予定のイベントをDBから取り出して表示event.php
$hostEvents = get_host_events($db, $user_id);

// 参加履歴をDBから取り出して表示

include_once VIEW_PATH . 'mypage_view.php';