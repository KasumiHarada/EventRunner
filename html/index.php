<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';

session_start();

// // ログイン済みか確認し、falseならloginページへリダイレクト
// if(is_logined() === false){
//   redirect_to(LOGIN_URL);
// }

// // ユーザIDが存在したら、代入
// if (isset ($_SESSION['user_id'])){
//   $user_id = $_SESSION['user_id'];

//   dd($user_id);

// } else {
//   //ログインしていない
//   header('Location: login.php');
//   exit;
// }

// DBに接続する
$db = get_db_connect();

$user = get_login_user($db);
// DBからイベント情報を取り出し$eventsに格納（select文）

    $sql ="
      SELECT
        events.event_id,
        events.event_name,
        events.date,
        location.location
      FROM
        events LEFT OUTER JOIN location location ON events.location_id = location.location_id  
    ";

    $stmt=$db->prepare($sql);
    $stmt->execute();
    $events =$stmt->fetchAll();



//INSERT INTO events(location_id, type_id, event_name, introduction,date)VALUES(1,0,'ワークショップ','ワークショップを開催します',2020);


include_once '../view/index_view.php';