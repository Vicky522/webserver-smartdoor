
<?php
require_once('configs/database.config.php');
class User extends BaseModel
{
	public $user_id;
	public $first_name;
	public $last_name;
	public $email;
	public $username;
	public $password;
	public $birthday;
	public $sex;

	function __construct($user_id=NULL, $first_name, $last_name, $email, $username, $birthday=NULL, $sex=NULL)
	{
		$this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->email = $email;
		$this->username = $username;
		$this->birthday = $birthday;
		$this->sex = $sex;
	}
	
	// static function login()
	// {
	// 	$list = [];
	// 	$db = DB::getInstance();
	// 	$req = $db->query('SELECT * FROM device');
	// 	foreach ($req->fetchAll() as $item) {
	// 	$list[] = new Device( $item['device_id'], $item['name'], $item['chip_id'], $item['description'], $item['read_api_key'], $item['write_api_key']);
	// 	}
	// 	return $list;
	// }

	static function find($username, $password)
	{
		$db = DB::getInstance();
		$req = $db->prepare('SELECT * FROM user WHERE username =:user and password =:pass');
		$req->execute(array('user' => $username, 'pass' => $password));
		$item = $req->fetch();

		if ( isset($item['user_id'])) {
			return $item['user_id'];
			// return new Device(  $item['device_id'], $item['name'], $item['chip_id'], $item['description']);
		}
		return False;
	}

	static function create($username ,$password, $first_name, $last_name, $email)
	{
		$db = DB::getInstance();
		$req = $db->query("INSERT INTO `user` ( `username`, `first_name`, `last_name`, `email`, `password`) VALUES ('" .  $username . "','" . $first_name . "',' " . $last_name . "', '" . $email . "', '" . $password ."')");
		if($req)
			return True;
	    return False;
	}
	// static function update($name, $chip_id, $description, $device_id)
	// {
	// 	$db = DB::getInstance();
	// 	$req = $db->query("UPDATE `device` SET `name` = '".$name."', `chip_id` = '".$chip_id."', `description` = '".$description."' WHERE `device`.`device_id` = " . $device_id .";");
	// 	if(!$req)
	// 		echo "Mission fail!!";
	// }
	// static function delete( $device_id)
	// {
	// 	$db = DB::getInstance();
	// 	$req = $db->query("DELETE FROM `device` WHERE `device`.`device_id` =" . $device_id);
	// 	if(!$req)
	// 		echo "Mission fail!!";
	// }
	
	
}