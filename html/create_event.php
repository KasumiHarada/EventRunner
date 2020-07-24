<?php
require_once '../conf/const.php';
require_once '../model/db.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/event.php';

session_start();

// ログイン済みか確認し、falseならloginページへリダイレクト
if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

// DBに接続する
$db = get_db_connect();

// login済みのユーザーIDとパスワードをセッションから取得して返す
$user = get_login_user($db);
// user_idを取得する
$user_id = $user['user_id'];

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
        $capacity   = get_post('capacity');

        // validate_event($event_name);

        
        // eventsテーブルとlocationテーブルにデータをinsertする
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
            
            //execute_query($db, $sql, array($location, $address));
            $stmt=$db->prepare($sql);
            $stmt->bindValue(':location', $location, PDO::PARAM_STR);
            $stmt->bindValue(':address', $address, PDO::PARAM_STR);
            $stmt->execute();

            $location_id = $db->lastInsertId('location_id');

            $sql = "
            INSERT INTO
                events(
                user_id,
                location_id,
                event_name,
                introduction,
                capacity,
                date,
                time
                )
            VALUES(:user_id, :location_id, :event_name, :introduction, :capacity, :date, :time)    
            ";

            //execute_query($db, $sql, array($user_id, $location_id, $event_name, $introduction, $date, $time));
            $stmt=$db->prepare($sql);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':location_id', $location_id, PDO::PARAM_INT);
            $stmt->bindValue(':event_name', $event_name, PDO::PARAM_STR);
            $stmt->bindValue(':introduction', $introduction, PDO::PARAM_STR);
            $stmt->bindValue(':capacity', $capacity, PDO::PARAM_INT);        
            $stmt->bindValue(':date', $date, PDO::PARAM_STR);
            $stmt->bindValue(':time', $time, PDO::PARAM_STR);          
            $stmt->execute();

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
        