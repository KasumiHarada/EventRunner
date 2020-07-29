<?php
require_once '../conf/const.php';
require_once MODEL_PATH.'functions.php';
require_once MODEL_PATH.'user.php';

session_start();

// DBに接続する
$db = get_db_connect();

$action = get_post('action');

// hidden送信されたevent_idを変数に格納
$event_id = get_post('event_id');

// sessionからuser_idを取得
$user_id = $_SESSION['user_id'];

// すでに登録されているかチェック
$user = get_userid_from_paticipants($db,$user_id,$event_id);

// paticipantsテーブルにuser_idが存在しなければ、参加者として新規登録をする
if (!isset($user['user_id']) && $action ==='join'){

  // paticipantsテーブルに参加者として追加 user.php
  if (insert_paticipants($db, $user_id, $event_id)){
    set_message('参加登録しました');
    redirect_to(DETAIL_URL.'?event_id='.$event_id);
  } else {
    set_error('登録できません');
  }

} else if(isset($user['user_id']) && $action ==='delete') {
  // 参加を取りやめる
  if (delete_paticipants($db, $user_id, $event_id)){
    set_error('参加を取り消しました');
    redirect_to(DETAIL_URL.'?event_id='.$event_id);
  }
}