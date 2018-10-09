<?php

class LoginView {
	private static $login;
	private static $logout;
	private static $name;
	private static $password;
	private static $cookieName;
	private static $cookiePassword;
	private static $keep;
	private static $messageId;

	private $logginMessage = "";

	private $userName = "";

	public function __construct()
	{
		self::$login = get_class($this) . "::" . "Login";
		self::$logout = get_class($this) . "::" . "Logout";
		self::$name = get_class($this) . "::" . "UserName";
		self::$password = get_class($this) . "::" . "Password";
		self::$cookieName = get_class($this) . "::" . "CookieName";
		self::$cookiePassword = get_class($this) . "::" . "CookiePassword";
		self::$keep = get_class($this) . "::" . "KeepMeLoggedIn";
		self::$messageId = get_class($this) . "::" . "Message";
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = "$this->logginMessage";
		
		if(isset($_SESSION["loggin"])){
			if($_SESSION["loggin"] === "loggin"){
				$response = $this->generateLogoutButtonHTML($message);
			} else {
				$response = $this->generateLoginFormHTML($message);
			}
			
		}else {
			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}


	public function registerUserFormHTML() {
		$message = "RegisterView::Message";
		$sumbit = "submit";
		$newUserName = "RegisterView::UserName";
		$newPassword = "RegisterView::Password";
		$repaetPassword = "RegisterView::PasswordRepeat" ;

		  return'
		<form method="post">
		<fieldset>
		  <legend>Register a new user - Write username and password</legend>
		  <p id = "' . $message .'">'. $this->logginMessage .'</p>

		  <label for = "'. $newUserName .'">Username:</label>
		  <input id = "'. $newUserName .'" name = "'. $newUserName .'"  type = "text" value = "' . $this->userName .'">
		  <br>
		  <label for = "'. $newPassword .'">Password:</label>
		  <input id = "'. $newPassword .'" name ="'. $newPassword .'" type="password">
		  <br>
		  <label for = "'. $repaetPassword .'">Repeat password:</label>
		  <input id = "'. $repaetPassword .'" name = "'. $repaetPassword .'" type="password">
			
			<br>
		  <input id= "'. $sumbit. '" name="RegisterView::Register" type="submit" value="Register">
		</fieldset>
	 </form>';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post"> 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '"value="' .$this->userName .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function setMessage($text){
		$this->logginMessage = "$text";
	}
	public function setUsername ($theName) {
		$this->userName = "$theName";
	}

	public function getUserName () {
		if(isset($_POST[self::$name])) {
			return $_POST[self::$name];
		} else {
			return "";
		}
	}

	public function getPassword() {
		if(isset($_POST[self::$password])) {
			return $_POST[self::$password] ; 
		}else {
			return "";
		}		
	}

	public function withPost() {
		if(isset($_POST[self::$login])){
			echo"loggin";
			return "loggin";
		}
		if(isset($_Post[self::$logout])){
			echo "loggout";
			return "loggout";
		}
		echo "no";
		return "";
	}
}