<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/event.php';

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

try{
    $sql ="INSERT INTO comments (user_id, event_id, comment)VALUES(:user_id, :event_id, :comment)";

} catch (PDOException $e){
    print 'だめ'.$e->getMessage();
}

include_once('../view/detail_view.php');  