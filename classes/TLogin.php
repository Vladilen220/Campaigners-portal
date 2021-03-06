<?php

class TLogin{
public static function isLoggedIn() {

        if(isset($_COOKIE['TCampaigners_ID'])){
            if(DB::query('SELECT user_id FROM trainee_login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TCampaigners_ID'])))){
                    $userid = DB::query('SELECT user_id FROM trainee_login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TCampaigners_ID'])))[0]['user_id'];
                    if(isset($_COOKIE['TCampaigners_ID_'])){
                        return $userid;
                    }else{
                        $cstrong = True;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                        $timeNow = date('Y-m-d H:i:s');
                        DB::query('INSERT INTO trainee_login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
                        DB::query('DELETE FROM trainee_login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TCampaigners_ID'])));
                        setcookie("TCampaigners_ID", $token, time() + 60 * 60 * 1, '/', NULL, NULL, TRUE); //setting cookie to 1 hour
                        setcookie("TCampaigners_ID_", '1', time() + 60 * 30, '/', NULL, NULL, TRUE); //setting (rest) cookie to 30 minutes
                        return $userid;
                    }
            }
        }else{
          if (session_status() == PHP_SESSION_NONE) {
              session_start();
          }
          if(isset($_SESSION["loginToken"]))
            if(DB::query('SELECT user_id FROM trainee_login_tokens WHERE token=:token', array(':token'=>sha1($_SESSION['loginToken'])))){
              $userid = DB::query('SELECT user_id FROM trainee_login_tokens WHERE token=:token', array(':token'=>sha1($_SESSION['loginToken'])))[0]['user_id'];
              return $userid;
            }
        }
          return false;
    }

}

?>
