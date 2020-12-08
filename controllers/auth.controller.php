<?php
require_once('models/user.model.php');
session_start();
class AuthController extends BaseController {
	public function signin() {
		if( isset($_POST["UserName"]) && isset($_POST["FirstName"]) &&  isset($_POST["LastName"]) && isset($_POST["Email"]) && isset($_POST["Password"]))
		{
			$first_name = $_POST["FirstName"];
			$last_name = $_POST["LastName"];
			$email = $_POST["Email"];
			$password = $_POST["Password"];
            $username = $_POST["UserName"];
			$status = User::create($username, $password, $first_name, $last_name, $email);
			if($status){
				$this->redirect("http://localhost:8080/login");	
			}else 
				return $this->view('error');

		}
		else 
			return $this->view('error');
	}
	
	public function signin_view() {
        return $this->view("signin", array(), True);
    }
	
	public function login_view() {
        return $this->view("login",array(), True);
	}
	
	public function login() {
		if( isset($_POST["UserName"]) && isset($_POST["Password"]))
		{
			$password = $_POST["Password"];
			$username = $_POST["UserName"];
			$resutl = User::find($username, $password);
			if(!$resutl)
				return $this->view('error');

			$salt = substr (md5($password), 0, 2);
			$cookie = base64_encode ("$username:" . md5 ($password, $salt));
			$_SESSION[$username] = $cookie;
			setcookie("token", $cookie, time() +3600 );

			$this->redirect("http://localhost:8080");
		}
		else 
			return $this->view('error');
	}

    public function error()
    {
      $this->view('error');
    }

}