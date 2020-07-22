<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/event.php';
require_once '../model/detail.php';
require_once '../model/user.php';

session_start();

// DBに接続する
$db = get_db_connect();

$user = get_login_user($db);

// post送信されたevent_idを取得
$event_id = get_post('event_id');

// DBからイベント情報（詳細）を取り出す
$events = get_event_info_detail($db, $event_id);

// 参加者を取り出すdetail.php
$paticipants = get_paticipants($db, $event_id);

include_once '../view/detail_view.php';