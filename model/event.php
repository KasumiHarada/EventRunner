<?php 
// 参加予定のイベントをDBから取り出して表示●
function get_join_events($db, $user_id){
    $sql="
      SELECT 
        users.user_id, 
        paticipants.paticipant_id,
        events.event_name,
        events.event_id
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
      events.introduction,
      events.capacity
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
      events.capacity,
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

// // 入力された値がそれぞれ適切な値かを確認する
// function validate_event($event_name, $name){
//   $is_valid_event_name = is_valid_event_name($event_name);
//   $is_valid_user_name = is_valid_user_name($name);
//   // $is_valid_item_stock = is_valid_item_stock($stock);
//   // $is_valid_item_status = is_valid_item_status($status);

//   return $is_valid_event_name
//     && $is_valid_user_name;
//     // && $is_valid_item_stock
//     // && $is_valid_item_status;
// }


function is_valid_event_name($event_name){
  $is_valid = true;
  if(is_valid_length($event_name, EVENT_NAME_LENGTH_MIN, EVENT_NAME_LENGTH_MAX) === false){
    set_error('イベント名は'. EVENT_NAME_LENGTH_MIN . '文字以上、' . EVENT_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

// function is_valid_user_name($name){
//   $is_valid = true;
//   if(is_valid_length($event_name, EVENT_NAME_LENGTH_MIN, EVENT_NAME_LENGTH_MAX) === false){
//     set_error('イベント名は'. EVENT_NAME_LENGTH_MIN . '文字以上、' . EVENT_NAME_LENGTH_MAX . '文字以内にしてください。');
//     $is_valid = false;
//   }
//   return $is_valid;
// }