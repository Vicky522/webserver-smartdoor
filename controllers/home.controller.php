<?php
require_once('models/device.model.php');

class HomeController extends BaseController {

    public function index() {
		$device = Device::read();
		$data = array('devices' => $device);
        return $this->view("index", $data);
	}
	
	public function create_view() {
        return $this->view("create");
    }
	
	public function create() {
		
		if( isset($_POST["name"])  ){
			$name = $_POST["name"];
			
			Device::create($name);

			// $device = Device::read();
			// $data = array('devices' => $device);
			// return $this->view("index", $data);
		}
		// else 
		// 	return $this->view('error');
    }

	public function edit_view() {
		if( isset($_GET["id"])){
			$ID = $_GET["id"];
			$device = Device::find($ID);
			$data = array('device' => $device);
			$this->view("edit", $data);
		}
		else 
        	return $this->view("error");
	}

	public function edit() {
		if( isset($_POST["DeviceId"]) && isset($_POST["Name"]) &&  isset($_POST["ChipId"]) && isset($_POST["Description"]) ){
			$name = $_POST["Name"];
			$chip_id = $_POST["ChipId"];
			$description = $_POST["Description"];
			$device_id = $_POST["DeviceId"];
			Device::update($name, $chip_id, $description, $device_id);
			$device = Device::read();
			$data = array('devices' => $device);
			return $this->view("index", $data);
		}
		else 
			return $this->view('error');

    }

	public function delete() {
		if( isset($_GET["id"])){
			$ID = $_GET["id"];
			Device::delete($ID);
			$device = Device::read();
			$data = array('devices' => $device);
			return $this->view("index", $data);
		}
		else 
        	return $this->view("error");
	}

	public function detail() {
		if( isset($_GET["id"])){

			$ID = $_GET["id"];
			if(isset($_SESSION[session_id()])){
				$seen = $_SESSION[session_id()];
				array_push($seen, $ID);
				$_SESSION[session_id()] = $seen;
			}
			else
				$_SESSION[session_id()] = array($ID);

			if(isset($_COOKIE["token"])){
				$token = $_COOKIE["token"];
				$content = base64_decode($token);
				list($username, $hashed_password) = explode (':', $content);
				if(isset($_SESSION[$username])){
					if($_SESSION[$username] == $token)
						Seen::create($ID);
				}
			}

			$device = Device::find($ID);
			$data = array('device' => $device);
			$this->view("detail", $data);
		}
		else 
        	return $this->view("error");
	}
	
    public function error()
    {
      $this->view('error');
    }

}