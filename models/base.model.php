<?php
require_once('configs/database.config.php');

abstract class BaseModel{
    public function __construct () {
    }
    static function getCurrentUser(){
        $token = $_COOKIE["token"];
        $content = base64_decode($token);
		list($username, $hashed_password) = explode (':', $content);
		$db = DB::getInstance();
		$req = $db->prepare('SELECT user_id FROM user WHERE username = :user');
		$req->execute(array('user' => $username));
		$created_by = $req->fetch()[0];
        return $created_by;
    }
}
