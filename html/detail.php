<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';

session_start();

// DBに接続する
$db = get_db_connect();

$event_id = get_post('event_id');

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

// 参加者を取り出す
$sql ="
  SELECT 
    events.event_id,
    paticipants.user_id,
    users.name
  FROM events LEFT OUTER JOIN paticipants ON events.event_id = paticipants.event_id
  JOIN users ON paticipants.user_id = users.user_id
  WHERE events.event_id =:event_id;
  ";
$stmt=$db->prepare($sql);
$stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
$stmt->execute();
$paticipants =$stmt->fetchAll();


include_once '../view/detail_view.php';