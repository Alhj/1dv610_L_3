<?php

namespace view;

class LoginView
{
	private $className = "LoginView";
	private $login;
	private $logout;
	private $name;
	private $password;
	private $cookieName;
	private $keep;
	private $messageId;

	private $logginMessage = "";

	private $loggin = "loggin";

	private $userName = "";

	public function __construct()
	{
		$this->className = "LoginView";
		$this->login = $this->className . "::" . "Login";
		$this->logout = $this->className . "::" . "Logout";
		$this->name = $this->className . "::" . "UserName";
		$this->password = $this->className . "::" . "Password";
		$this->cookieName = "cookieUserName";
		$this->keep = $this->className . "::" . "KeepMeLoggedIn";
		$this->messageId = $this->className . "::" . "Message";
	}

	public function errorMessange($error)
	{
		switch ($error) {
			case $error instanceof \userNameMissing:
				$this->setMessage("Username is missing");
				break;

			case $error instanceof \PasswordMissing:
				$this->setMessage("Password is missing");
				break;

			case $error instanceof \LogginField:
				$this->setMessage("Wrong name or password");
				break;
		}
	}

	public function byeMessage()
	{
		$this->logginMessage = "Bye bye!";
	}

	public function response($isUserLoggin)
	{
		$message = "$this->logginMessage";

		if ($isUserLoggin) {

			$response = $this->generateLogoutButtonHTML($message);

		} else {
			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}


	private function generateLogoutButtonHTML($message)
	{
		return '
			<form  method="post" >
				<p id="' . $this->messageId . '">' . $message . '</p>
				<input type="submit" name="' . $this->logout . '" value="logout"/>
			</form>
		';
	}


	private function generateLoginFormHTML($message)
	{
		return '
			<h3>what you can do on the side:</h3>

			<p> when you are loggin you can make code snippet and remove code snippet you have make.
			
			<br> But you can always watch others persons code snippet</p>
			<form method="post"> 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . $this->messageId . '">' . $message . '</p>
					
					<label for="' . $this->name . '">Username :</label>
					<input type="text" id="' . $this->name . '" name="' . $this->name . '"value="' . $this->userName . '" />

					<label for="' . $this->password . '">Password :</label>
					<input type="password" id="' . $this->password . '" name="' . $this->password . '" />

					<label for="' . $this->keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . $this->keep . '" name="' . $this->keep . '" />
					
					<input type="submit" name="' . $this->login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	public function setMessage($text)
	{
		$this->logginMessage = $text;
	}
	public function setUsername($theName)
	{
		$this->userName = "$theName";
	}

	public function getUserName()
	{
		if (isset($_POST[$this->name])) {
			return $_POST[$this->name];
		} else {
			return "";
		}
	}

	public function getPassword()
	{
		if (isset($_POST[$this->password])) {
			return $_POST[$this->password];
		} else {
			return "";
		}
	}

	public function withPost()
	{
		if (isset($_POST[$this->login])) {
			return "loggin";
		}
		if (isset($_POST[$this->logout])) {
			return "loggout";
		}
		return "";
	}

	public function doWeSetCookie()
	{
		return isset($_POST[$this->keep]);
	}

	public function logginMessage($withMessage)
	{
		if ($withMessage) {
			$this->setMessage("Welcome and you will be remembered");
		} else {
			$this->setMessage("Welcome");
		}
	}

	public function removeCookies()
	{
		setCookie($this->cookieName, $this->getUserName(), time() - 3600);
	}

	public function setCookie()
	{
		setCookie($this->cookieName, $this->getUserName(), time() + 60 * 60 * 24 * 30);
	}
}