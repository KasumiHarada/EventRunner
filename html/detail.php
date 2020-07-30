<?php
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/event.php';
require_once '../model/detail.php';
require_once '../model/user.php';
require_once '../model/comment.php';

session_start();

// DBに接続する
$db = get_db_connect();

// ログイン済みのユーザー情報を取得
$user = get_login_user($db);
$user_id = $user['user_id'];

// post送信されたevent_idを取得
$event_id = get_get('event_id');

// DBからイベント情報（詳細）を取り出す
$events = get_event_info_detail($db, $event_id);

// 参加者を取り出すdetail.php
$paticipants = get_paticipants($db, $event_id);

// post送信されたコメントを変数に格納
$comment = get_post('comment');

// コメントがpost送信された場合
if ($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($comment) && is_valid_comment($comment)!==false){
        insert_comments($db, $user_id, $event_id, $comment);
    }  
}

// DBからevent_idに一致するコメントを全て表示
$comments = get_comments($db,$event_id);

// 既に、参加者として登録されているかどうかチェック
$isset_paticipant = isset_paticipant($db, $user_id, $event_id);

include_once (VIEW_PATH .'detail_view.php');