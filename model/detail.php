<?php
// 参加者を取り出す
function get_paticipants($db, $event_id){
    
    $sql ="
      SELECT 
        events.event_id,
        paticipants.user_id,
        users.name
      FROM events LEFT OUTER JOIN paticipants ON events.event_id = paticipants.event_id
      JOIN users ON paticipants.user_id = users.user_id
      WHERE events.event_id =:event_id;
      ";
    
    return fetch_all_query($db, $sql, array($event_id));
}  

// DBからイベント情報（詳細）を取り出す●
function get_event_info_detail($db, $event_id){

    $sql ="
      SELECT
        events.event_id,
        events.event_name,
        events.date,
        events.time,
        events.introduction,
        location.location,
        location.address
      FROM
        events LEFT OUTER JOIN location location ON events.location_id = location.location_id  
      WHERE
        event_id = :event_id
      ";
  
    return fetch_query($db, $sql, array($event_id));
}  