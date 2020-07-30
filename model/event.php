<?php 
// 参加予定のイベントをDBから取り出して表示
function get_join_events($db, $user_id){
    $sql="
      SELECT 
        users.user_id, 
        paticipants.paticipant_id,
        events.event_name,
        events.event_id,
        events.date
      FROM users LEFT OUTER JOIN paticipants ON users.user_id = paticipants.user_id
      JOIN events ON paticipants.event_id =events.event_id
      WHERE users.user_id = :user_id
      ORDER BY events.date
    "; 
    return fetch_all_query($db, $sql, array($user_id));
}

// 主催予定のイベントをDBから取り出して表示
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

// イベント情報を取り出す（select文）
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

// 商品をソートして表示する（新着・少ない順・多い順）
function get_events_sort($db){
  $order_by ='';
  $array=array();
  if ($_SESSION['sort'] ==='higher'){
      $order_by ='ORDER BY capacity DESC';

  } else if ($_SESSION['sort'] ==='lower'){
      $order_by ='ORDER BY capacity';

  } else {
      $order_by ='ORDER BY events.create_datetime DESC';
  }  

  $sql = "
    SELECT
      events.event_id,
      events.event_name,
      events.date,
      events.capacity,
      location.location
    FROM
      events LEFT OUTER JOIN location location ON events.location_id = location.location_id  
      {$order_by}
    ";
            
  return fetch_all_query($db, $sql);
}

// 入力された値がそれぞれ適切な値かを確認する
function validate_event($event_name, $date, $time, $location, $address, $event_info, $capacity){
  $is_valid_event_name = is_valid_event_name($event_name);
  $is_valid_date = is_valid_date($date);
  $is_valid_time = is_valid_time($time);
  $is_valid_location = is_valid_location($location);
  $is_valid_address = is_valid_address($address);
  $is_valid_capacity = is_valid_capacity($capacity);
  $is_valid_event_info = is_valid_event_info($event_info);

  return $is_valid_event_name
    && $is_valid_date
    && $is_valid_time
    && $is_valid_location
    && $is_valid_address
    && $is_valid_capacity
    && $is_valid_event_info;

}

// 題名をチェック。1文字〜30文字以内。
function is_valid_event_name($event_name){
  $is_valid = true;
  if(is_valid_length($event_name, EVENT_NAME_LENGTH_MIN, EVENT_NAME_LENGTH_MAX) === false){
    set_error('題名は'. EVENT_NAME_LENGTH_MIN . '文字以上、' . EVENT_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

// 日にちの入力チェックをする
function is_valid_date($date){
  $is_valid = true;
  if($date === ''){
    $is_valid = false;
    set_error('開催日を入力してください');
  }
  return $is_valid;
}

// 時間の入力チェックをする
function is_valid_time($time){
  $is_valid = true;
  if($time === ''){
    $is_valid = false;
    set_error('開催時間を入力してください');
  }
  return $is_valid;
}

// locationの文字数と文字列をチェックし結果をtrueかfalseで返す
function is_valid_location($location) {
  $is_valid = true;
  if(is_valid_length($location, EVENT_NAME_LENGTH_MIN, EVENT_NAME_LENGTH_MAX) === false){
    set_error('開催場所は'. EVENT_NAME_LENGTH_MIN . '文字以上、' . EVENT_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

// 住所の文字数と文字列をチェックし結果をtrueかfalseで返す
function is_valid_address($address) {
  $is_valid = true;
  if(is_valid_length($address, USER_NAME_LENGTH_MIN, USER_NAME_LENGTH_MAX) === false){
    set_error('住所は'. USER_NAME_LENGTH_MIN . '文字以上、' . USER_NAME_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}

// 定員の文字数と文字列をチェックし結果をtrueかfalseで返す
function is_valid_capacity($capacity) {
  $is_valid = true;
  if(is_valid_length($capacity, REGEXP_POSITIVE_INTEGER) === false){
    set_error('定員は0以上の整数で入力してください');
    $is_valid = false;
  }
  return $is_valid;
}

// イベントの情報の文字数と文字列をチェックし結果をtrueかfalseで返す
function is_valid_event_info($event_info) {
  $is_valid = true;
  if(is_valid_length($event_info, INTRODUCTION_LENGTH_MIN, INTRODUCTION_LENGTH_MAX) === false){
    set_error('イベントの情報は'. INTRODUCTION_LENGTH_MIN. '文字以上、' . INTRODUCTION_LENGTH_MAX . '文字以内にしてください。');
    $is_valid = false;
  }
  return $is_valid;
}