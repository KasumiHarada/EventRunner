<?php 
// 参加予定のイベントをDBから取り出して表示●
function get_join_events($db, $user_id){
    $sql="
      SELECT 
        users.user_id, 
        paticipants.paticipant_id,
        events.event_name
      FROM users LEFT OUTER JOIN paticipants ON users.user_id = paticipants.user_id
      JOIN events ON paticipants.event_id =events.event_id
      WHERE users.user_id = :user_id
    "; 
    return fetch_all_query($db, $sql, array($user_id));
  }

// 主催予定のイベントをDBから取り出して表示●
function get_host_events($db, $user_id){

    $sql ="
    SELECT 
      location.location,
      location.address,
      events.event_name,
      events.time,
      events.date,
      events.introduction
    FROM
      location LEFT OUTER JOIN events ON location.location_id = events.location_id 
    WHERE
      user_id = :user_id
    ";
  
    return fetch_all_query($db, $sql, array($user_id));
}

// イベント情報を取り出す（select文）●
function get_event_info($db){
  $sql ="
    SELECT
      events.event_id,
      events.event_name,
      events.date,
      location.location
    FROM
      events LEFT OUTER JOIN location location ON events.location_id = location.location_id  
  ";
   
  return fetch_all_query($db, $sql);
}
// // 開催場所と住所をDBへ登録する
// function insert_location($db,$sql,$location,$address){

//     $sql = "
//     INSERT INTO
//         location(
//         location,
//         address
//         )
//     VALUES (:location, :address)
//     ";
    
//     execute_query($db, $sql, array($location, $address));

// }