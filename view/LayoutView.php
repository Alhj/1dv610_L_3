<?php


class LayoutView {

  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv) {
    if(isset($_GET["register"])){

      $userName = "RegisterView::UserName";
      $passWord = "RegisterView::Password";
      $conPassWord = "RegisterView::PasswordRepeat";
      $message = "RegisterView::Message";
      $sumbit = "submit";

      echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
            <a href="index.php">back</a> '
           . $this->renderIsLoggedIn($isLoggedIn) . '
          <div class="container">
            <h2>Register new user</h2>
              <form action ="">
                <fieldset>
                  <legend>Register a new user - Write username and password</legend>
                  <p id = "'. $message .'"> </p>

                  <label id = " '. $userName . '">Username:</label>
                  <input id = " '. $userName . '"  type = "text">
                  <br>
                  <label id = " '. $passWord . '">Password:</label>
                  <input id = " '. $passWord . '" type="password">
                  <br>
                  <label id = " '. $conPassWord . '">Repeat password:</label>
                  <input id = " '. $conPassWord . '" type="password">
                  <br>
                  <input id= " '. $sumbit. ' "  type="submit" value="Register">
                </fieldset>
             </form>
             ' . $dtv->show() . '
            </div>
          </body>
       </html>';
    } else {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->link($isLoggedIn) . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <div class="container">
              ' . $v->response() . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
    }
  }
  

  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }

  private function link ($isLoggedIn) {
    if($isLoggedIn) {
      return '';
    } else {
      return '<a href="index.php?register">Register a new user</a>';
    }
  }
}
