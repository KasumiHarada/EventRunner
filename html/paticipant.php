<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';

session_start();

// DBに接続する
$db = get_db_connect();

// hidden送信されたevent_idを変数に格納
$event_id = get_post('event_id');
// sessionからuser_idを取得
$user_id = $_SESSION['user_id'];

// insert文でpaticipantsテーブルに追加
$sql="
  INSERT INTO
    paticipants(
    user_id,
    event_id
    )
    VALUES(
    :user_id,
    :event_id
    )
";

// $stmt=$db->prepare($sql);
// $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
// $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
// $stmt->execute();
execute_query($db, $sql, array($event_id, $user_id));

set_message('参加登録しました');

redirect_to(HOME_URL);