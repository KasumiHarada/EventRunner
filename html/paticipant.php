<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';

session_start();

// DBに接続する
$db = get_db_connect();

// hidden送信されたevent_idを変数に格納
$event_id = get_post('event_id');

// sessionからuser_idを取得
$user_id = $_SESSION['user_id'];

// paticipantsテーブルに参加者として追加 user.php
if (insert_paticipants($db, $user_id, $event_id)){
  set_message('参加登録しました');
} else {
  set_error('参加登録できません');
}

redirect_to(SEARCH_URL);