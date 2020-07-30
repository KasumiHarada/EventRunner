<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'functions.php';
require_once MODEL_PATH.'user.php';
require_once MODEL_PATH.'event.php';

session_start();

// ログイン済みか確認し、falseならloginページへリダイレクト
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

// DBに接続する
$db = get_db_connect();

// login済みのuser_idをセッションから取得して変数に格納
$user = get_login_user($db);

// DBからイベント情報を取り出し$eventsに格納 event.php
$events = get_event_info($db);

include_once VIEW_PATH .'index_view.php';
