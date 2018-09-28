<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $logginMessage = "";

	private $userName = "";

	

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

	public function registerUserFormHTML() {

		$message = "RegisterView::Message";
		  $sumbit = "submit";
		  return'
		<form method="post">
		<fieldset>
		  <legend>Register a new user - Write username and password</legend>
		  <p id = "' . $message .'">'. $this->logginMessage .'</p>

		  <label for = "RegisterView::UserName">Username:</label>
		  <input id = "RegisterView::UserName"  type = "text">
		  <br>
		  <label for = "RegisterView::Password">Password:</label>
		  <input id = "RegisterView::Password" type="password">
		  <br>
		  <label for = "RegisterView::PasswordRepeat">Repeat password:</label>
		  <input id = "RegisterView::PasswordRepeat" type="password">
			
			<br>
		  <input id= "'. $sumbit. '" name="Register" type="submit" value="Register">
		</fieldset>
	 </form>';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//RETURN REQUEST VARIABLE: USERNAME
	}
	
	public function getLoggin($text){
		$this->logginMessage = "$text";
	}
	public function setUsername ($theName) {
		$this->userName = "$theName";
	}
}