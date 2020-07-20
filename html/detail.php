<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/function.php';

session_start();

// DBに接続する
$db = get_db_connect();

// DBからイベント情報を取り出し$eventsに格納（select文）
$sql ="
  SELECT
    events.event_id,
    events.event_name,
    events.date,
    events.introduction,
    location.location,
    location.address
  FROM
    events LEFT OUTER JOIN location location ON events.location_id = location.location_id  
";

$stmt=$db->prepare($sql);
$stmt->execute();
$events =$stmt->fetch();



//INSERT INTO events(location_id, type_id, event_name, introduction,date)VALUES(1,0,'ワークショップ','ワークショップを開催します',2020);


include_once '../view/detail_view.php';