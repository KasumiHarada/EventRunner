<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';

session_start();

// DBに接続する
$db = get_db_connect();

// hidden送信されたevent_idを変数に格納
$event_id = get_post('event_id');



