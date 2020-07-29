<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'db.php';
require_once MODEL_PATH.'functions.php';
require_once MODEL_PATH.'user.php';

session_start();

// ログイン済みか確認し、falseならloginページへリダイレクト
if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

// DBに接続する
$db = get_db_connect();

// login済みのユーザーIDとパスワードをセッションから取得して返す
$user = get_login_user($db);

// post送信されたコメントを変数に格納
$comment = get_post('comment');

include_once(VIEW_PATH .'detail_view.php');  