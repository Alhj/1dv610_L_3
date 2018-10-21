<?php

namespace view;

class LoginView
{
	private static $login;
	private static $logout;
	private static $name;
	private static $password;
	private static $cookieName;
	private static $cookiePassword;
	private static $keep;
	private static $messageId;

	private static $className = "LoginView";

	private $logginMessage = "";

	private $userName = "";

	public function __construct()
	{
		self::$login = self::$className . "::" . "Login";
		self::$logout = self::$className . "::" . "Logout";
		self::$name = self::$className . "::" . "UserName";
		self::$password = self::$className . "::" . "Password";
		self::$cookieName = "cookieUserName";
		self::$cookiePassword = "CookiePassword";
		self::$keep = self::$className . "::" . "KeepMeLoggedIn";
		self::$messageId = self::$className . "::" . "Message";
	}

	public function errorMessange($error)
	{
		switch($error)
		{
			case "userName":
				$this->setMessage("Username is missing");
			break;

			case "password":
				$this->setMessage("Password is missing");
			break;

			case "fildLoggin":
				$this->setMessage("Wrong name or password");
			break;
		}
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response()
	{
		$message = "$this->logginMessage";

		if (isset($_SESSION["loggin"])) {

			$response = $this->generateLogoutButtonHTML($message);

		} else {
			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}

	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	private function generateLogoutButtonHTML($message)
	{
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message . '</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	private function generateLoginFormHTML($message)
	{
		return '
			<form method="post"> 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '"value="' . $this->userName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	public function setMessage($text)
	{
		$this->logginMessage = "$text";
	}
	public function setUsername($theName)
	{
		$this->userName = "$theName";
	}

	public function getUserName()
	{
		if (isset($_POST[self::$name])) {
			return $_POST[self::$name];
		} else {
			return "";
		}
	}

	public function getPassword()
	{
		if (isset($_POST[self::$password])) {
			return $_POST[self::$password];
		} else {
			return "";
		}
	}

	public function withPost()
	{
		if (isset($_POST[self::$login])) {
			return "loggin";
		}
		if (isset($_POST[self::$logout])) {
			return "loggout";
		}
		return "";
	}

	public function doWeSetCookie()
	{
		return isset($_POST[self::$keep]);
	}

	public function getCookieUserName()
	{
		if (isset($_COOKIE[self::$cookieName])) {
			return $_COOKIE[self::$cookieName];
		}
		return "";
	}
	public function getCookiePassword()
	{
		if (isset($_COOKIE[self::$cookiePassword])) {
			return $_COOKIE[self::$cookiePassword];
		}
		return "";
	}

	public function removeCookies()
	{
		setCookie(self::$cookieName, $this->getUserName(), time() - 3600);
		setCookie(self::$cookiePassword, $this->randomString(), time() - 3600);
	}

	public function setCookie()
	{
		setCookie(self::$cookieName, $this->getUserName(), time() + 60 * 60 * 24 * 30);
		setCookie(self::$cookiePassword, $this->randomString(), time() + 60 * 60 * 24 * 30);
	}
	
	private function randomString()
	{
		$getFromThisString = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$stringLength = strlen($getFromThisString);
		$length = 50;
		$randomString = '';
		for ($time = 0; $time < $length; $time++) {
			$randomString .= $getFromThisString[rand(0, $stringLength - 1)];
		}
		return $randomString;
	}
}