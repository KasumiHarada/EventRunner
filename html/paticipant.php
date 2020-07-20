<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/function.php';

session_start();

// DBに接続する
$db = get_db_connect();

$event_id = get_post('event_id');

