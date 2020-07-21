<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';

session_start();

// DBに接続する
$db = get_db_connect();

// それぞれの入力項目のチェック


// post送信された時の処理
if ($_SERVER['REQUEST_METHOD'] ==='POST'){
    // ログアウトの処理
        
        // post送信されたデータをそれぞれ変数に格納
        $event_name = get_post('event_name');
        $name       = get_post('name');
        $email      = get_post('email');
        $date       = get_post('date');
        $time       = get_post('time');
        $location   = get_post('location');
        $address    = get_post('address');
        $introduction = get_post('introduction');

        $db->beginTransaction();
        try{     

            $sql = "
            INSERT INTO
                location(
                location,
                address
                )
            VALUES (:location, :address)
            ";
            
            execute_query($db, $sql, array($location, $address));

            $location_id = $db->lastInsertId('location_id');

            $sql = "
            INSERT INTO
                events(
                location_id,
                event_name,
                introduction,
                date,
                time
                )
            VALUES(:location_id, :event_name, :introduction, :date, :time)    
            ";

            execute_query($db, $sql, array($location_id, $event_name, $introduction, $date, $time));
        
            $db->commit();

        } catch (PDOException $e){
            print 'できない'.$e->getMessage();
            // ロールバック処理
            $db->rollback();
            // 例外をスロー
            throw $e;
        }
        
        set_message('イベントを登録しました。');
     
    // それぞれバリデーションが必要
    
}    

include_once('../view/create_event_view.php');  
        