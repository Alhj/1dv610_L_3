<?php


class LayoutView {

  $UserName = "RegisterView::UserName";
  $passWord = "RegisterView::Password";
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv) {
    if(isset($_GET["get"])){
      echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <a href="index.php">back</a>
          <div class="container">
          <h2>Register new user</h2>
           
          </div>
          </body>
       </html>'
          
          ;
    } else {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          <a href="index.php?get">Register a new user</a>
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
}
