<?php

class RegisterView
{
    private $name;

    private $password;

    private $repaetPassword;

    private $message;

    private $Register;

    private $userName;

    private $feedBackMessage = "";

    public function __construct()
    {
        $this->name = get_class($this) . "::" . "UserName";
        $this->password = get_class($this) . "::" . "Password";
        $this->repaetPassword = get_class($this) . "::" . "PasswordRepeat";
        $this->message = get_class($this) . "::" . "Message";
        $this->Register = get_class($this) . "::" . "Register";

    }

    public function response()
    {
        return '
		<form method="post">
		<fieldset>
		  <legend>Register a new user - Write username and password</legend>
		  <p id = "' . $this->message . '">' . $this->feedBackMessage . '</p>

		  <label for = "' . $this->name . '">Username:</label>
		  <input id = "' . $this->name . '" name = "' . $this->name . '"  type = "text" value = "' . $this->userName . '">
		  <br>
		  <label for = "' . $this->password . '">Password:</label>
		  <input id = "' . $this->password . '" name ="' . $this->password . '" type="password">
		  <br>
		  <label for = "' . $this->repaetPassword . '">Repeat password:</label>
		  <input id = "' . $this->repaetPassword . '" name = "' . $this->repaetPassword . '" type="password">
			
			<br>
		  <input id= "submit" name="' . $this->Register . '" type="submit" value="Register">
		</fieldset>
	 </form>';
    }

    public function getUserName()
    {
        if (isset($_POST[$this->name])) {
            return $_POST[$this->name];
        }
        return "";
    }

    public function setUsername($name)
    {
        $this->userName = $name;
    }

    public function getPassword()
    {
        if (isset($_POST[$this->password])) {
            return $_POST[$this->password];
        }
        return "";
    }

    public function getRepeatPassword()
    {
        if (isset($_POST[$this->repaetPassword])) {
            return $_POST[$this->repaetPassword];
        }
        return "";
    }
    public function setMessage($message)
    {
        $this->feedBackMessage = $message;
    }
    public function haveYouPost()
    {
        return isset($_POST[$this->Register]);
    }
}