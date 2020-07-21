<?php 
// 開催場所と住所をDBへ登録する
function insert_location($db,$sql,$location,$address){

    $sql = "
    INSERT INTO
        location(
        location,
        address
        )
    VALUES (:location, :address)
    ";
    
    execute_query($db, $sql, array($location, $address));

}