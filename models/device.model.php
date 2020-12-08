
<?php
require_once('configs/database.config.php');
require_once("./models/base.model.php");
class Device {
	public $log_id;
	public $name;
	public $time;


	function __construct($log_id, $name, $time)	{
		$this->log_id = $log_id;
		$this->name = $name;
		$this->time = $time;
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
	static function RandomString()    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring =  $randstring .  $characters[rand(0, strlen($characters)-1)];
        }
        return $randstring;
    }

	static function read()	{
		$list = [];
		$db = DB::getInstance();
		$req = $db->query('SELECT * FROM log');
		foreach ($req->fetchAll() as $item) {
		$list[] = new Device( $item['log_id'], $item['name'], $item['time']);
		}
		// echo json_encode($list);
		return $list;
	}
	static function create($name)	{
		$db = DB::getInstance();
	
	
		$req = $db->query("INSERT INTO `log` ( `name`) VALUES ('" .  $name  ."')");
		// echo "INSERT INTO `log` ( `name`) VALUES ('" .  $name  ."')";

		if(!$req)
			echo "Mission fail!!";
	}
	static function update($name, $chip_id, $description, $device_id)
	{
		$db = DB::getInstance();
		$created_by =Device::getCurrentUser();
		$req = $db->query("UPDATE `device` SET `name` = '".$name."', `chip_id` = '".$chip_id."', `description` = '".$description."' WHERE `device`.`device_id` = " . $device_id ." AND `device`.`created_by` = " . $created_by .";");

		if($req->rowCount()==0)
			echo "Mission fail!!";
	}
	static function delete( $device_id)
	{

		$db = DB::getInstance();
		$req = $db->query("DELETE FROM `device` WHERE `device`.`device_id` =" . $device_id  );
		if(!$req)
			echo "Mission fail!!";
	}
	static function find($id)
	{
		$db = DB::getInstance();
		$req = $db->prepare('SELECT * FROM device WHERE device_id = :id');
		$req->execute(array('id' => $id));

		$item = $req->fetch();
		if (isset($item['device_id'])) {
			return new Device(  $item['device_id'], $item['name'], $item['chip_id'], $item['description']);
		}
		return null;
	}
	
	static function seen($list_id)
	{
		$db = DB::getInstance();
		$ids="(";
		foreach($list_id as $id)
			$ids = $ids . $id . ",";
		$ids = substr($ids, 0, -1) . ")";
		
		$req = $db->query('SELECT * FROM device WHERE device_id IN ' . $ids);
		if(!$req)
			return [];
		foreach ($req->fetchAll() as $item) {
			$list[] = new Device( $item['device_id'], $item['name'], $item['chip_id'], $item['description'], $item['read_api_key'], $item['write_api_key']);
		}
		return $list;

	}
	
}